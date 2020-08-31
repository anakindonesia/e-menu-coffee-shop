<?php 

namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Back\MenuModel;
use App\Models\Back\KategoriModel;

class Minuman extends BaseController
{

	public function __construct()
	{
		helper('form');
		$this->menu 	= new MenuModel;
		$this->kategori = new kategoriModel;
	}

	public function index()
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		if (!$this->validate([]))
		{
			$data['minumans']	= $this->menu->getMenu('Minuman');

			echo view('Back/v_minuman', $data);
		}
	}

	public function tambahMinuman()
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		$data	= [
			'kategoris'			=> $this->kategori->getKategori(false, 'Minuman'),
			'validation'		=> \config\Services::validation(),
		];
		return view('Back/v_tambahMinuman', $data);
	}
	
	public function saveTambahMinuman()
	{
		if($this->request->getMethod() !== 'post'){
			return redirect()->to('/admin/minuman');
		}

		$val = $this->validate([
			'nama_minuman'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'nama_minuman harus di isi'
				]
			],
			'harga_minuman'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'harga_minuman harus di isi'
				]
			],
			'kategori'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'kategori harus di pilih'
				]
			],

		]);

		if(!$val){
			$validation = $this->validator;
			return redirect()->to('/admin/minuman/tambah')->withInput()->with('validation', $validation);
		} else {
				if(!$this->validate([
					'upload_gambar' => [
						'rules'	=> 'uploaded[upload_gambar]|mime_in[upload_gambar,image/jpg,image/jpeg,image/png]|max_size[upload_gambar,5000]',
						'errors'=> [
							'uploaded' 	=> 'Silahkan pilih gambar yang akan di upload',
							'mime_in'	=> 'File Harus Berekstensi jpg, jpeg atau png',
							'max_size'	=> 'File tidak boleh lebih besar dari 5000kb'
						]
					]
				])){
					return redirect()->to('/admin/minuman/tambah')->withInput();
				} else {
	
						$nama_minuman 	= $this->request->getVar('nama_minuman');
						$harga_minuman 	= $this->request->getVar('harga_minuman');
						$kategori 		= $this->request->getVar('kategori');
						$avatar 		= $this->request->getFile('upload_gambar');
						$newname		= 'minuman_'.url_title($nama_minuman,'-', true).'_'.time().'.'.$avatar->getExtension();

						$avatar->move(FCPATH . 'uploads' , $newname);
						$data = [
							'nama_menu'		=> $nama_minuman,
							'harga_menu'	=> $harga_minuman,
							'gambar_menu' 	=> $newname,
							'id_kategori'	=> $kategori,
							'is_active'		=> 1,
							'created_people'=> $_SESSION['username'],
							'updated_people'=> $_SESSION['username']
						];

					$this->menu->save($data);
					return redirect()->to('/admin/minuman')->with('success', 'upload successfully');
				}
			}
	}

	public function editMinuman($id_menu)
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		$coba	= $this->menu->getMenu($id_menu, false);
		$data	= [
			'minuman'			=> $this->menu->getMenu(false,$id_menu),
			'kategoris'			=> $this->kategori->getKategori(false,'Minuman'),
			'validation'		=> \config\Services::validation(),
		];

		return view('Back/v_editMinuman', $data);                   
	}

	public function saveEditMinuman()
	{
		if($this->request->getMethod() !== 'post'){
			return redirect()->to('/admin/minuman');
		}

		$id_menu		= $this->request->getVar('id_minuman');
		$gambar_minuman	= $this->request->getVar('gambar_minuman');
		$nama_minuman 	= $this->request->getVar('nama_minuman');
		$harga_minuman 	= $this->request->getVar('harga_minuman');
		$kategori 		= $this->request->getVar('kategori');
		$path			= FCPATH."uploads/".$gambar_minuman;

		$val = $this->validate([
			'nama_minuman'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'nama_minuman harus di isi'
				]
			],
			'harga_minuman'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'harga_minuman harus di isi'
				]
			],
			'kategori'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'kategori harus di pilih'
				]
			],

		]);

		if(!$val){
			$validation = $this->validator;
			return redirect()->to('/admin/minuman/edit/'.$id_menu)->withInput()->with('validation', $validation);
		} else {
				if(!$this->validate([
					'upload_gambar' => [
						'rules'	=> 'mime_in[upload_gambar,image/jpg,image/jpeg,image/png]|max_size[upload_gambar,5000]',
						'errors'=> [
							'mime_in'	=> 'File Harus Berekstensi jpg, jpeg atau png',
							'max_size'	=> 'File tidak boleh lebih besar dari 5000kb'
						]
					]
				])){
					return redirect()->to('/admin/minuman/edit/'.$id_menu)->withInput();
				} else {

						$avatar = $this->request->getFile('upload_gambar');

						if($avatar == ""){

							$data = [
								'nama_menu'		=> $nama_minuman,
								'harga_menu'	=> $harga_minuman,
								'gambar_menu' 	=> $gambar_minuman,
								'id_kategori'	=> $kategori,
								'updated_people'=> $_SESSION['username']
							];
						} else {
							unlink($path);
							$newname = 'minuman_'.url_title($nama_minuman,'-', true).'_'.time().'.'.$avatar->getExtension();
							$avatar->move(FCPATH . 'uploads' , $newname);
							$data = [
								'nama_menu'		=> $nama_minuman,
								'harga_menu'	=> $harga_minuman,
								'gambar_menu' 	=> $newname,
								'id_kategori'	=> $kategori,
								'updated_people'=> $_SESSION['username']
							];
						}
						
						$this->menu->update($id_menu, $data);
						return redirect()->to('/admin/minuman');

				}
			}
	}

	public function hapusMinuman()
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		$id_menu 		= $this->request->getPost('id_minuman');
		$gambar_minuman	= $this->request->getVar('gambar_minuman');
		$path			= FCPATH."uploads/".$gambar_minuman;
		unlink($path);


		$this->menu->deleteMenu($id_menu);
		return redirect()->to('/admin/minuman');
	}

	public function statusMinuman($id_menu, $status)
	{
		if ($status == 0) {
			$data = [
				'is_active' => 1
			];
		}else{
			$data = [
				'is_active' => 0
			];
		}

		$this->menu->update($id_menu, $data);
		return redirect()->to('/admin/minuman');
	}

}