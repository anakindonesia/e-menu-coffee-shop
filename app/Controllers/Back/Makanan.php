<?php 

namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Back\MenuModel;
use App\Models\Back\KategoriModel;

class Makanan extends BaseController
{

	public function __construct()
	{
		helper('form');
		$this->menu = new MenuModel;
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
			$data['makanans']	= $this->menu->getMenu('Makanan');
			
			echo view('Back/v_makanan', $data);
		}
	}

	public function tambahMakanan()
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		$data	= [
			'kategoris'			=> $this->kategori->getKategori(false,'Makanan'),
			'validation'		=> \config\Services::validation(),
		];
		return view('Back/v_tambahMakanan', $data);
	}

	public function saveTambahMakanan()
	{
		if($this->request->getMethod() !== 'post'){
			return redirect()->to('/admin/makanan');
		}


		$val = $this->validate([
			'nama_makanan'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'nama_makanan harus di isi'
				]
			],
			'harga_makanan'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'harga_makanan harus di isi'
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
			return redirect()->to('/admin/makanan/tambah')->withInput()->with('validation', $validation);
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
					return redirect()->to('/admin/makanan/tambah')->withInput();
				} else {
						// $session = \Config\Services::session();
						$nama_makanan 	= $this->request->getVar('nama_makanan');
						$harga_makanan 	= $this->request->getVar('harga_makanan');
						$kategori 		= $this->request->getVar('kategori');
						$avatar 		= $this->request->getFile('upload_gambar');
						
						$newname		= 'makanan_'.url_title($nama_makanan,'-', true).'_'.time().'.'.$avatar->getExtension();
						
						$avatar->move(FCPATH . 'uploads' , $newname);
						
						$data = [
							'nama_menu'		=> $nama_makanan,
							'harga_menu'	=> $harga_makanan,
							'gambar_menu' 	=> $newname,
							'id_kategori'	=> $kategori,
							'is_active'		=> 1,
							'created_people'=> $_SESSION['username'],
							'updated_people'=> $_SESSION['username']
						];

						

					$this->menu->save($data);
					return redirect()->to('/admin/makanan')->with('success', 'upload successfully');
				}
			}
	}

	public function editMakanan($id_menu)
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}

		$data	= [
			'makanan'			=> $this->menu->getMenu(false,$id_menu),
			'kategoris'			=> $this->kategori->getKategori(false,'Makanan'),
			'validation'		=> \config\Services::validation(),
		];
		return view('Back/v_editMakanan', $data);                   
	}

	public function saveEditMakanan()
	{
		if($this->request->getMethod() !== 'post'){
			return redirect()->to('/admin/makanan');
		}

		$id_menu		= $this->request->getPost('id_makanan');
		$gambar_makanan	= $this->request->getPost('gambar_makanan');
		$nama_makanan 	= $this->request->getPost('nama_makanan');
		$harga_makanan 	= $this->request->getPost('harga_makanan');
		$kategori 		= $this->request->getPost('kategori');
		$path			= $_SERVER['DOCUMENT_ROOT']."\uploads/".$gambar_makanan;

		$val = $this->validate([
			'nama_makanan'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'nama_makanan harus di isi'
				]
			],
			'harga_makanan'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'harga_makanan harus di isi'
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
			return redirect()->to('/admin/makanan/edit/'.$id_menu)->withInput()->with('validation', $validation);
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
					return redirect()->to('/admin/makanan/edit/'.$id_menu)->withInput();
				} else {

						$avatar = $this->request->getFile('upload_gambar');

						if($avatar == ""){

							$data = [
								'nama_menu'		=> $nama_makanan,
								'harga_menu'	=> $harga_makanan,
								'gambar_menu' 	=> $gambar_makanan,
								'id_kategori'	=> $kategori,
								'updated_people'=> $_SESSION['username']
							];
						} else {
							unlink($path);
							$newname = 'makanan_'.url_title($nama_makanan,'-', true).'_'.time().'.'.$avatar->getExtension();
							$avatar->move(FCPATH . 'uploads' , $newname);
							$data = [
								'nama_menu'		=> $nama_makanan,
								'harga_menu'	=> $harga_makanan,
								'gambar_menu' 	=> $newname,
								'id_kategori'	=> $kategori,
								'updated_people'=> $_SESSION['username']
							];
						}
						
						$this->menu->update($id_menu, $data);
						return redirect()->to('/admin/makanan');

				}
			}
	}

	public function hapusMakanan()
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		$id_menu 		= $this->request->getVar("id_makanan");
		$gambar_makanan	= $this->request->getVar('gambar_makanan');
		$path			= FCPATH."uploads/".$gambar_makanan;
		unlink($path);
		
		$this->menu->deleteMenu($id_menu);
		return redirect()->to('/admin/makanan');
	}

	public function statusMakanan($id_menu, $status)
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
		// dd($id_menu);
		$this->menu->update($id_menu, $data);
		return redirect()->to('/admin/makanan');
	}

}