<?php 

namespace App\Controllers\Front;

use CodeIgniter\Controller;
use App\Models\Front\OrderModel;
use App\Models\Front\PesananModel;
use App\Models\Front\KategoriModel;
use App\Controllers\BaseController;
use DateTime;
use TCPDF;

class SelesaiPesanan extends BaseController
{

	public function __construct()
	{
		helper('form');
		helper('url');
        $this->order 	= new OrderModel;
        $this->pesanan 	= new PesananModel;
        $this->kategori	= new KategoriModel;
	}

    public function index()
    {
        $session = \Config\Services::session();
        if($session->get('id_meja') == null ) {
			$session->setFlashdata('error', 'Silahkan login terlebih dahulu');
			return redirect()->to(base_url(''));
		}
		
		if($session->get('status_order') !== 1){
            return redirect()->to(base_url('home'));
        }

		$data = [
			'minumans'		=> $this->kategori->getSidebarKategori('Minuman'),
			'makanans' 		=> $this->kategori->getSidebarKategori('Makanan'),
			'nama'			=> $_SESSION['nama'],
			'meja'			=> $_SESSION['meja'],
		];

		return view('Front/v_selesaiPesanan', $data);
	}

	public function json()
	{
		$session = \Config\Services::session();

		$slug_meja 		= $_SESSION['slug'];
		$slug_pelanggan	= url_title($_SESSION['nama'],'_', true);
        $tmp_menu       = NULL;
        $order			= $this->order->getOrderBySlug($slug_pelanggan);
		$pesanan 		= $this->pesanan->getPesanan($order['id_order'],$tmp_menu);
		$totalBayar = 0;
		foreach ($pesanan as $data) {
			$totalBayar += $data['sub_total'];
		}

		$data = [
			'pesanans'		=> $pesanan,
			'total_bayar'	=> $totalBayar,
			'minumans'		=> $this->kategori->getSidebarKategori('Minuman'),
			'makanans' 		=> $this->kategori->getSidebarKategori('Makanan'),
			'nama'			=> $_SESSION['nama'],
			'meja'			=> $_SESSION['meja'],
			'id_order'		=> $order['id_order'],
			'tmp_order'		=> $order['tmp_order']
		];

		echo json_encode($data);
	}
	
	public function aksi($id_order)
	{
		$session 		= \Config\Services::session();
		$order			= $this->order->getOrderSelected($id_order);

		if ($order['tmp_order'] == 2) {
			$data = [
				'tmp_order' => null
			];
			$this->order->update($id_order,$data);
			$session->set('status_menu',$_SESSION['status_menu'] + 1);
			$session->set('status_order', 0);
			return redirect()->to('/home');
		}else{
			$session->setFlashdata('error', 'Pesanan anda sebelumnya belum diproses admin, tunggu sesaat lagi');
			return redirect()->to('/selesai');
		}
	}

	public function cetak($id_order)
	{
		$session 		= \Config\Services::session();
		$items    = $this->pesanan->getCetakPesanan($id_order);
        
        include_once APPPATH . '/ThirdParty/TCPDF/tcpdf.php';

        $letterSize = [80,140];
        $pdf = new TCPDF('P', 'mm', $letterSize, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(4,2,2);

        $pdf->SetTitle('Cetak Struk');

        $pdf->AddPage();
		$pdf->SetFont('','',10);
		$pdf->Cell(0,1,'Struk Pembayaran',0,1,'C');
        $pdf->Cell(0,1,'99s Coffee Tanjung Pura',0,1,'C');
        $pdf->Cell(0,1,'Terimakasih ',0,1,'C');
        $pdf->Cell(0,1,'------------------------------------------------------------',0,1,'C');
        $pdf->SetFont('','',8);
		$pdf->Cell(0,1,'   Nama = '.$items[0]['pelanggan'],0,1,'L');
        $pdf->Cell(0,1,'   Tanggal ='.$items[0]['tanggal_pesan'],0,1,'L');
        $pdf->SetFont('','',10);
        $pdf->Cell(0,1,'------------------------------------------------------------',0,1,'C');
        $pdf->SetAutoPageBreak(true, 0);
        
        $pdf->Ln(5);
		$pdf->SetFont('', '', 8);
		$pdf->Cell(30,8, "Menu", 0, 0, 'L');
		$pdf->Cell(15,8, "Jumlah", 0, 0, 'L');
        $pdf->Cell(17,8, "Harga", 0, 0, 'L');
        $pdf->Cell(10,8, "Status", 0, 1, 'L');
        
        $total = 0;
		foreach($items as $item){
			$pdf->SetFont('', '', 8);
			$pdf->Cell(30,8, $item['nama_menu'], 0, 0, 'L');
            $pdf->Cell(15,8, $item['quantity'], 0, 0, 'L');
            $pdf->Cell(17,8, 'Rp. '.number_format($item['sub_total'], 0, 0, '.'), 0, 0, 'L');
            $pdf->Cell(10,8, $item['status_menu'] == 0 ? 'U' : 'T', 0, 1, 'L');

			// menghitung total 
			$total += $item['sub_total'];
		}

		$pdf->SetFont('', 'B', 8);
		$pdf->Cell(30,8, '', 0, 0, 'L');
		$pdf->Cell(15,8, 'Total', 0, 0, 'L');
		$pdf->Cell(17,8, 'Rp. '.number_format($total, 0, 0, '.'), 0, 1, 'L');

		$pdf->SetFont('','',8);
		$pdf->cell(0,1, '-----'.$items[0]['updated_people'].'-----      ',0,1,'R');

        $this->response->setHeader('Content-Type', 'application/pdf');
		$pdf->Output('struk_'.$items[0]['pelanggan'].Date('d-m-yy').'.pdf', 'D');

		$session->destroy();

	}
}