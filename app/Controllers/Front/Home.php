<?php 

namespace App\Controllers\Front;

use CodeIgniter\Controller;
use App\Models\Front\MenuModel;
use App\Models\Front\KategoriModel;
use App\Controllers\BaseController;

class Home extends BaseController
{

	public function __construct()
	{
		helper('text');
		$this->menu = new MenuModel();	
		$this->kategori = new KategoriModel();	
	}

	public function index()
	{
		$session = \Config\Services::session();
        if($session->get('id_meja') == null ) {
			$session->setFlashdata('error', 'Silahkan login terlebih dahulu');
			return redirect()->to(base_url(''));
		}
		
		if($session->get('status_order') == 1){
            return redirect()->to(base_url('selesai'));
        }

		$data['minumans']	= $this->kategori->getSidebarKategori('Minuman');
		$data['makanans']	= $this->kategori->getSidebarKategori('Makanan');
		$data['nama']		= $_SESSION['nama'];
		$data['meja']		= $_SESSION['meja'];
		return view('Front/v_home', $data);
	}

	public function menu($id)
	{
		$session = \Config\Services::session();
        if($session->get('id_meja') == null ) {
			$session->setFlashdata('error', 'Silahkan login terlebih dahulu');
			return redirect()->to(base_url(''));
		}
		
		if($session->get('status_order') == 1){
            return redirect()->to(base_url('selesai'));
        }
		
		$dataKategori 	= $this->kategori->getKategori($id);
		$kategori 		= $dataKategori['kategori'];
		$jenis_kategori	= $dataKategori['jenis_kategori'];

		$data = [
			'items'		=> $this->menu->getMenu($kategori,$jenis_kategori),
			'minumans'	=> $this->kategori->getSidebarKategori('Minuman'),
			'makanans' 	=> $this->kategori->getSidebarKategori('Makanan'),
			'kategori'	=> $kategori,
			'nama'		=> $_SESSION['nama'],
			'meja'		=> $_SESSION['meja']
		];
		// dd($data['items']);
		
		return view('Front/v_menu', $data);
	}
}