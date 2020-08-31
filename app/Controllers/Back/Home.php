<?php 

namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Models\Back\MejaModel;
use App\Models\Back\PesananModel;
use App\Models\Back\OrderModel;
use App\Controllers\BaseController;
use Pusher;

class Home extends BaseController
{

	public function __construct()
	{
		helper('form');
		$this->meja 	= new MejaModel;
		$this->pesanan 	= new PesananModel;
		$this->order 	= new OrderModel;
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
		return view('Back/v_home');	

	}

	public function getMeja()
	{
		$data['items'] 		= $this->meja->orderBy('lantai ASC, id_meja ASC')->findAll();
		echo json_encode($data);
	}

	public function pesanan($slug_meja)
	{
		$pesanan				= 1;
		$pembayaran				= 2;
		$proses					= 2;
		$meja 					= $this->meja->getMeja($slug_meja);
		$data['pesanans'] 		= $this->order->getOrderSelectedSlugMeja($slug_meja, $pesanan);
		$data['pembayarans'] 	= $this->order->getOrderSelectedSlugMeja($slug_meja, $pembayaran);
		$data['prosess']		= $this->order->getOrderSelectedSlugMeja($slug_meja, $proses);
		$data['nama_meja']		= $meja['nama_meja'];
		$data['slug_meja']		= $slug_meja;
		return view('Back/v_pesanan',$data);
	}

	public function lihatPesanan($id_order)
	{
		$pesanan				= max($this->pesanan->getPesananLast($id_order));
		$data['id_order']		= $id_order;
		$data['items']	 		= $this->pesanan->getPesanan($id_order,$pesanan['status_menu']);;
		// dd($pesanan);
		return view('Back/v_lihatPesanan', $data);	
	}

	public function prosesPesanan($id_order)
	{
		$tmp_order 		= 1;
		$order 			= $this->order->getOrderSelectedIdOrder($id_order,$tmp_order);
		
		$meja			= $this->meja->getMeja($order['slug_meja']);
		$dataMeja = [
			'j_pesanan'	=> $meja['j_pesanan'] - 1,
		];

		$dataOrder = [
			'tmp_order'			=> 2,
			'updated_people'	=> $_SESSION['username']
		];
		$this->meja->updateMeja( $order['slug_meja'], $dataMeja);
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

		$tmp_menu		= 1;
		$data['pesanan'] = $this->pesanan->getPesanan($id_order,$tmp_menu);
		$data['message'] = 'success';
		$this->pusher->trigger('my-channel', 'my-event', $data);

		return redirect()->to('/admin/home');
	}

	public function lihatProsesPesanan($id_order)
	{
		$data['id_order']		= $id_order;
		$data['items']	 		= $this->pesanan->getPesanan($id_order);;
		// dd($pesanan);
		return view('Back/v_lihatProsesPesanan', $data);	
	}

	public function selesaiProsesPesanan($id_pesanan)
	{
		$pesanan		= $this->pesanan->getPesananIdPesanan($id_pesanan);
		$dataPesanan = [
			'tmp_menu'			=> 2,
			'updated_people'	=> $_SESSION['username']
		];

		$this->pesanan->update($id_pesanan, $dataPesanan);

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

		$data['message'] = 'success';
		$this->pusher->trigger('my-channel', 'my-event', $data);

		return redirect()->to('/admin/home/pesanan/'.$pesanan['id_order']);
	}

	public function lihataksiPesanan()
	{
		$session = \Config\Services::session();
		$id_order 	= $this->request->getPost('id');
		$slug_meja 	= $this->request->getPost('slug_meja');

		if ($id_order !== null) {
			foreach ($id_order as $id){
				$pesanan[]			= $this->pesanan->getPesanan($id);
			}
			$data['items']	 		= $pesanan;
			return view('Back/v_aksiPesanan', $data);	
		}else{
			$session->setFlashdata('error', 'pilih minimal satu pesanan');
			return redirect()->to('/admin/home/'.$slug_meja);
		}
	}

	public function bayar()
	{
		$id_order 		= $this->request->getPost('id');
		
		$tmp_order 		= 2;
		foreach($id_order as $id){
			$orders[] 			= $this->order->getOrderSelectedIdOrder($id,$tmp_order);
			
			$dataOrder[] = [
				'id_order' 			=> $id,
				'tmp_order'			=> 0,
				'status_bayar' 		=> 1,
				'updated_people'	=> $_SESSION['nama']
			];
		}

		foreach($orders as $order){
			$mejas[] = $this->meja->getMeja($order['slug_meja']);
			
		}

		foreach($mejas as $meja){
			
			$dataMeja[] = [
				'slug_meja' 	=> $order['slug_meja'],
				'j_pelanggan'	=> $meja['j_pelanggan'] - 1,
			];
		}


		$dataOrder 		= $dataOrder;
		$dataMeja 		= $dataMeja;

		$this->meja->updateBatch($dataMeja, 'slug_meja');
		$this->order->updateBatch($dataOrder, 'id_order');

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

		$data['message'] = 'success';
		$this->pusher->trigger('my-channel', 'my-event', $data);

		return redirect()->to('/admin/rekap');
	}

	public function hapusPesanan($id_pesanan)
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}

		$pesanan		= $this->pesanan->getPesananIdPesanan($id_pesanan);
		$chek_pesanan	= $this->pesanan->getPesananLast($pesanan['id_order']);
		$order			= $this->order->find($pesanan['id_order']);
		$meja			= $this->meja->getMeja($order['slug_meja']);
		$dataMeja 		= [
			'j_pelanggan'	=> $meja['j_pelanggan'] - 1,
		];

		if(count($chek_pesanan) == 1){
			$this->pesanan->delete($id_pesanan);
			$this->order->delete($pesanan['id_order']);
			$this->meja->updateMeja($order['slug_meja'], $dataMeja);
			return redirect()->to('/admin/home');
		}else{
			$this->kategori->delete($id_pesanan);
			return redirect()->to('/admin/home/pesanan/'.$pesanan['id_order']);
		}
	}
}