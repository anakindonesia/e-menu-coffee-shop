<?php namespace App\Controllers\front;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Front\MenuModel;
use App\Models\Front\PesananModel;
use App\Models\Front\KategoriModel;
use App\Models\Front\MejaModel;
use App\Models\Front\OrderModel;
use Pusher;


class Cart extends BaseController
{

	public function __construct()
	{

		helper('form');
		helper('url');
		$this->menu 	= new MenuModel;
		$this->pesanan 	= new PesananModel;
		$this->kategori	= new KategoriModel;
		$this->meja 	= new MejaModel;
		$this->order 	= new OrderModel;

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
		
		$slug_meja 		= $_SESSION['slug'];
		$slug_pelanggan	= url_title($_SESSION['nama'],'_', true);

		$order			= $this->order->getOrder($slug_pelanggan);
		$pesanan 		= $this->pesanan->getPesanan($order['id_order']);
		
		$totalBayar = 0;
		foreach ($pesanan as $data) {
			$totalBayar += $data['sub_total'];
		}

		$datas = [
			'pesanan'		=> $pesanan,
			'total_bayar'	=> $totalBayar,
			'minumans'		=> $this->kategori->getSidebarKategori('Minuman'),
			'makanans' 		=> $this->kategori->getSidebarKategori('Makanan'),
			'nama'			=> $_SESSION['nama'],
			'meja'			=> $_SESSION['meja']
		];

		echo view('Front/v_cart', $datas);
	}

	public function beli($id)
	{
		$session 		= \Config\Services::session();
		$slug_meja 		= $_SESSION['slug'];
		$slug_pelanggan	= url_title($_SESSION['nama'],'_', true);

		$order			= $this->order->getOrder($slug_pelanggan);
		$menu 			= $this->menu->getMenuCart($id);
		$exist 			= $this->pesanan->existPesanan($id, $order['id_order']);
			
		if ($exist == Null){
			$data = [
				'id_order'		=> $order['id_order'],
				'id_menu'		=> $menu['id_menu'],
				'quantity'		=> 1,
				'sub_total'		=> $menu['harga_menu'],
				'tmp_menu'		=> 0,
				'status_menu'	=> $_SESSION['status_menu'],
				'created_people'=> $_SESSION['nama'],
				'updated_people'=> $_SESSION['nama']
			];
			
			$this->pesanan->save($data);
		} else {
			$existmenu 	= $exist['id_menu'];
			$id_pesanan	= $exist['id_pesanan'];

			if($id == $existmenu) {
				$data = [
					'quantity'		=> $exist['quantity']+1,
					'sub_total'		=> $exist['sub_total'] + $menu['harga_menu']
				];
				
				$this->pesanan->update($id_pesanan, $data);
			} else {
				$data = [
				'id_order'		=> $order['id_order'],
				'id_menu'		=> $menu['id_menu'],
				'quantity'		=> 1,
				'sub_total'		=> $menu['harga_menu'],
				'tmp_menu'		=> 0,
				'status_menu'	=> $_SESSION['status_menu'],
				'created_people'=> $_SESSION['nama'],
				'updated_people'=> $_SESSION['nama']
				];
				
				$this->pesanan->save($data);
			}
		}
		$session->setFlashdata('success', $menu['nama_menu'].' Berhasil di Tambah Ke Keranjang,<br> Silahkan klik <b>Keranjang</b> untuk melanjutkan');
		return redirect()->to('/menu/'.$menu['id_kategori']);
	}

	public function tambah($id_pesanan)
	{
		$query = $this->pesanan->getPesananSelected($id_pesanan);

		$data = [
			'quantity'		=> $query[0]['quantity'] + 1,
			'sub_total'		=> $query[0]['sub_total'] + $query[0]['harga_menu'],
			'updated_people'=> $_SESSION['nama']
		];
		
		$this->pesanan->update($id_pesanan, $data);

		return redirect()->to('/cart');
	}

	public function kurang($id_pesanan)
	{
		$query = $this->pesanan->getPesananSelected($id_pesanan);

		$data = [
			'quantity'		=> $query[0]['quantity'] - 1,
			'sub_total'		=> $query[0]['sub_total'] - $query[0]['harga_menu'],
			'updated_people'=> $_SESSION['nama']
		];
		
		$this->pesanan->update($id_pesanan, $data);

		return redirect()->to('/cart');
	}

	public function proses($id_order)
	{
		$slug			= $_SESSION['slug'];
		$meja			= $this->meja->getMeja($slug);

		$dataPesanan = [
			'tmp_menu'		=> 1,
			'updated_people'=> $_SESSION['nama']
		];

		$dataMeja = [
			'j_pelanggan'			=> $meja['j_pelanggan'] + 1,
			'j_pesanan'				=> $meja['j_pesanan'] + 1
		];

		$dataOrder = [
			'tmp_order'		=> 1,
			'status_bayar'	=> 0,
			'tanggal_pesan'	=> date('d-m-yy'),
		];


		$session = \Config\Services::session();
		$session->set('status_order', 1);

		$this->pesanan->updateTmpPesanan($id_order, $dataPesanan);
		$this->meja->updateDataMeja($slug,$dataMeja);
		$this->order->update($id_order, $dataOrder);
		
		require ROOTPATH. 'app/ThirdParty/vendor/autoload.php';
		$options = array(
			'cluster' => 'ap1',
			'useTLS' => true
		);
		$this->pusher = new Pusher\Pusher(
			'6b6b3e38541cd58e3b08',
			'a38d6c3d864e7ae1c7dc',
			'1035962',
			$options
		);
		$data['meja'] = $this->meja->findAll();
		$data['message'] = 'success';
		$this->pusher->trigger('my-channel', 'my-event', $data);

		return redirect()->to('/home');

	}

	public function hapus($id)
	{
		$this->pesanan->delete($id);
		return redirect()->to(base_url('cart'));
	}

}