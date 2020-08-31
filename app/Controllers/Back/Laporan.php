<?php 

namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Models\Back\MenuModel;
use App\Models\Back\PesananModel;
use App\Models\Back\KategoriModel;
use App\Models\Back\MejaModel;
use App\Controllers\BaseController;
use TCPDF;

class Laporan extends BaseController
{

	public function __construct()
	{
		helper('form');
		helper('url');
		$this->pesanan= new PesananModel;
		$this->menu = new MenuModel;
		$this->kategori = new KategoriModel;
		$this->meja = new MejaModel;
	}

	public function index($jenis)
	{
		$data	= [
			'kategoris'			=> $this->kategori->orderBy('kategori ASC')->findAll(),
		];
		return view('Back/v_laporan',$data);
	}
	
	public function cetakLaporan($jenis)
	{
		if($jenis !== 'meja'){

			$awal 			= $this->request->getPost('awal');
			$akhir 			= $this->request->getPost('akhir');
			$id_kategori 	= $this->request->getPost('kategori');
			$kategori		= $this->kategori->getKategori($id_kategori);
			$jenis			= $jenis;

			if($awal !='' && $akhir!='' && $id_kategori!=''){
				$kondisi 		= ['tanggal_pesan >=' => $awal,'tanggal_pesan <=' => $akhir, 'daftar_menu.id_kategori' => $id_kategori, 'status_bayar' => 1];
				$lists 			= $this->pesanan->getLaporanPenjualan($kondisi);
				$titlePage		= 'Laporan Penjualan '.$jenis.' '.$kategori['kategori'].' dari tanggal '.$awal.' sampai tanggal '.$akhir;
			}elseif($awal !='' && $akhir!='' && $id_kategori ==''){
				$kondisi 		= ['tanggal_pesan >=' => $awal,'tanggal_pesan <=' => $akhir, 'status_bayar' => 1, 'jenis_kategori' => $jenis];
				$lists 			= $this->pesanan->getLaporanPenjualan($kondisi);
				$titlePage		= 'Laporan Penjualan '.$jenis.' dari tanggal '.$awal.' sampai tanggal '.$akhir;
			}elseif($awal !='' && $akhir =='' && $id_kategori !=''){
				$akhir 			= date('d-m-yy');
				$kondisi 		= ['tanggal_pesan >=' => $awal,'tanggal_pesan <=' => $akhir, 'daftar_menu.id_kategori' => $id_kategori, 'status_bayar' => 1];
				$lists 			= $this->pesanan->getLaporanPenjualan($kondisi);
				$titlePage		= 'Laporan Penjualan '.$jenis.' '.$kategori['kategori'].' dari tanggal '.$awal.' sampai tanggal '.$akhir;
			}elseif($awal =='' && $akhir !='' && $id_kategori !=''){
				$awal 			= $akhir;
				$kondisi 		= ['tanggal_pesan >=' => $awal,'tanggal_pesan <=' => $akhir, 'daftar_menu.id_kategori' => $id_kategori, 'status_bayar' => 1];
				$lists 			= $this->pesanan->getLaporanPenjualan($kondisi);
				$titlePage		= 'Laporan Penjualan '.$jenis.' '.$kategori['kategori'].' dari tanggal '.$awal.' sampai tanggal '.$akhir;
			}elseif($awal !='' && $akhir =='' && $id_kategori ==''){
				$akhir 			= date('d-m-yy');
				$kondisi 		= ['tanggal_pesan >=' => $awal,'tanggal_pesan <=' => $akhir, 'status_bayar' => 1, 'jenis_kategori' => $jenis];
				$lists 			= $this->pesanan->getLaporanPenjualan($kondisi);
				$titlePage		= 'Laporan Penjualan '.$jenis.' dari tanggal '.$awal.' sampai tanggal '.$akhir;
			}elseif($awal =='' && $akhir !='' && $id_kategori ==''){
				$awal 			= $akhir;
				$kondisi 		= ['tanggal_pesan >=' => $awal,'tanggal_pesan <=' => $akhir, 'status_bayar' => 1, 'jenis_kategori' => $jenis];
				$lists 			= $this->pesanan->getLaporanPenjualan($kondisi);
				$titlePage		= 'Laporan Penjualan '.$jenis.' dari tanggal '.$awal.' sampai tanggal '.$akhir;
			}elseif($awal =='' && $akhir =='' && $id_kategori !=''){
				$kondisi = ['daftar_menu.id_kategori' => $id_kategori, 'status_bayar' => 1];
				$lists = $this->pesanan->getLaporanPenjualan($kondisi);
				$titlePage		= 'Laporan Penjualan '.$jenis.' '.$kategori['kategori'];
			}else{
				$kondisi = ['status_bayar' => 1, ];
				$lists = $this->pesanan->getLaporanPenjualan($kondisi);
				$titlePage		= 'Laporan Penjualan '.$jenis.' Semua Kategori';
			}
			$image_path = FCPATH . "back/images/logo.png";
			include_once APPPATH . '/ThirdParty/TCPDF/tcpdf.php';

			$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

			$pdf->SetTitle('Laporan Penjualan');
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			$pdf->SetMargins(10,20,10);	
			$pdf->SetAutoPageBreak(true);
			$pdf->SetAuthor('Author');
			$pdf->SetDisplayMode('real', 'default');
			
			// header 
			$pdf->AddPage();
			$pdf->SetFont('','B',25);
			$pdf->MultiCell(190,5,"99's Coffee",0,'C');
			$pdf->SetFont('','B',10);
			$pdf->MultiCell(190,15,"jl. Patimurah No.0 Kecamatan Tanjung Pura",0,'C');
			$pdf->SetFont('','B',12);
			$pdf->MultiCell(190,5,$titlePage,0,'C');
			$pdf->SetAutoPageBreak(true, 0);

			// Add Header table
			$pdf->Ln(10);
			$pdf->SetFont('', 'B', 12);
			$pdf->Cell(10,8, "No", 1, 0, 'C');
			$pdf->Cell(90,8, "Menu", 1, 0, 'C');
			$pdf->Cell(40,8, "Jumlah Terjual", 1, 0, 'C');
			$pdf->Cell(48,8, "Pendapatan", 1, 1, 'C');

			$total = 0;
			foreach($lists as $key => $list){
				$pdf->SetFont('', '', 12);
				$pdf->Cell(10,8, ++$key, 1, 0, 'C');
				$pdf->Cell(90,8, $list['nama_menu'], 1, 0, 'L');
				$pdf->Cell(40,8, $list['quantity'], 1, 0, 'C');
				$pdf->Cell(48,8, 'Rp. '.number_format($list['sub_total'], 0, 0, '.'), 1, 1, 'L');

				// menghitung total pendapatan 
				$total += $list['sub_total'];
			}

			$pdf->SetFont('', 'B', 12);
			$pdf->Cell(10,8, '', 1, 0, 'C');
			$pdf->Cell(90,8, '', 1, 0, 'L');
			$pdf->Cell(40,8, 'Total', 1, 0, 'C');
			$pdf->Cell(48,8, 'Rp. '.number_format($total, 0, 0, '.'), 1, 1, 'L');
			
			$this->response->setHeader('Content-Type', 'application/pdf');
			$pdf->Output('file.pdf', 'I');
		}else{
			$jenis 			= 'Meja';
			$awal 			= $this->request->getPost('awal');
			$akhir 			= $this->request->getPost('akhir');

			if($awal != '' && $akhir != ''){
				$kondisi 	= ['tanggal_pesan >=' => $awal,'tanggal_pesan <=' => $akhir];
				$lists		= $this->meja->getLaporanMeja($kondisi);
				$titlePage	= 'Laporan Banyak Pengunjung Permeja dari '.$awal.' sampai '.$akhir;
			}elseif($awal !='' && $akhir ==''){
				$akhir		= date('d-m-yy');
				$kondisi 	= ['tanggal_pesan >=' => $awal,'tanggal_pesan <=' => $akhir];
				$lists		= $this->meja->getLaporanMeja($kondisi);
				$titlePage	= 'Laporan Banyak Pengunjung Permeja dari '.$awal.' sampai '.$akhir;
			}elseif($awal =='' && $akhir !=''){
				$awal		= $akhir;
				$kondisi 	= ['tanggal_pesan >=' => $awal,'tanggal_pesan <=' => $akhir];
				$lists		= $this->meja->getLaporanMeja($kondisi);
				$titlePage	= 'Laporan Banyak Pengunjung Permeja dari '.$awal.' sampai '.$akhir;
			}else{
				$kondisi 	= [];
				$lists		= $this->meja->getLaporanMeja($kondisi);
				$titlePage	= 'Laporan Banyak Pengunjung Permeja';
			}
		
			include_once APPPATH . '/ThirdParty/TCPDF/tcpdf.php';

			$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

			$pdf->SetTitle('Laporan Penjualan');
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
			$pdf->SetMargins(10,20,10);	
			$pdf->SetAutoPageBreak(true);
			$pdf->SetAuthor('Author');
			$pdf->SetDisplayMode('real', 'default');
			
			// header 
			$pdf->AddPage();
			$pdf->SetFont('','B',25);
			$pdf->MultiCell(190,5,"99's Coffee",0,'C');
			$pdf->SetFont('','B',10);
			$pdf->MultiCell(190,15,"jl. Patimurah No.0 Kecamatan Tanjung Pura",0,'C');
			$pdf->SetFont('','B',12);
			$pdf->MultiCell(190,5,$titlePage,0,'C');
			$pdf->SetAutoPageBreak(true, 0);

			// Add Header table
			$pdf->Ln(10);
			$pdf->SetFont('', 'B', 12);
			$pdf->Cell(10,8, "No", 1, 0, 'C');
			$pdf->Cell(45,8, "Meja", 1, 0, 'C');
			$pdf->Cell(45,8, "Lantai", 1, 0, 'C');
			$pdf->Cell(90,8, "Jumlah Pengunjung", 1, 1, 'C');

			$total = 0;
			foreach($lists as $key => $list){
				$pdf->SetFont('', '', 12);
				$pdf->Cell(10,8, ++$key, 1, 0, 'C');
				$pdf->Cell(45,8, $list['nama_meja'], 1, 0, 'L');
				$pdf->Cell(45,8, $list['lantai'], 1, 0, 'L');
				$pdf->Cell(90,8, $list['pelanggan'].' Pengunjung', 1, 1, 'C');

				// menghitung total pengunjung
				$total += $list['pelanggan'];
			}

			$pdf->SetFont('', 'B', 12);
			$pdf->Cell(10,8, '', 1, 0, 'C');
			$pdf->Cell(90,8, 'Total', 1, 0, 'L');
			$pdf->Cell(90,8, $total.' Pengunjung', 1, 1, 'C');


			$this->response->setHeader('Content-Type', 'application/pdf');
			$pdf->Output('laporan_'.date('d-m-yy').'.pdf', 'I');

		}
	}

}
