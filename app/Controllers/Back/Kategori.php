<?php 

namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Models\Back\KategoriModel;
use App\Controllers\BaseController;

class Kategori extends BaseController
{

	public function __construct()
	{
		$this->kategori = new KategoriModel();
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
		$data['items'] = $this->kategori->orderBy('jenis_kategori DESC, kategori ASC')->findAll();
		return view('Back/v_kategori', $data);
	}

	public function saveKategori()
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		$this->kategori->save([
			'kategori' 			=> $this->request->getVar('kategori'),
			'jenis_kategori' 	=>$this->request->getVar('jenis_kategori'),
			'created_people'	=> $_SESSION['username'],
			'updated_people'	=> $_SESSION['username']
		]);
		return redirect()->to('/admin/kategori');
	}

	public function updateKategori()
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		$id_kategori 	= $this->request->getPost('id_kategori');
		$data			= [
				'kategori' 			=> $this->request->getPost('kategori'),
				'jenis_kategori'	=> $this->request->getPost('jenis_kategori'),
				'updated_people'	=> $_SESSION['username']
		];
		$this->kategori->update($id_kategori, $data);
		return redirect()->to('/admin/kategori');
	}

	public function deleteKategori()
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		$id_kategori	= $this->request->getPost('id_kategori');
		$this->kategori->delete($id_kategori);
		return redirect()->to('/admin/kategori');
	}

}