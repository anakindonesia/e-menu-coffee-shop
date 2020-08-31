<?php 

namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Models\Back\OrderModel;
use App\Models\Back\PesananModel;
use App\Controllers\BaseController;
use TCPDF;

class Rekap extends BaseController
{

	public function __construct()
	{
        $this->order    = new OrderModel;
        $this->pesanan  = new PesananModel;
	}

	public function index()
	{
        $data = [
            'items' => $this->order->getRekapOrder(),
        ];
        return view('/Back/v_rekapPenjualan', $data);
    }

    public function lihatRekap($id_order)
    {
        $data = [
            'items'     =>  $this->pesanan->getRekapPesanan($id_order),
            'id_order'  =>  $id_order
        ];

        return view('/Back/v_lihatRekapPenjualan',$data);
    }

    public function cetakRekap($id_order)
    {

        $items    = $this->pesanan->getRekapPesanan($id_order);
        
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
		$pdf->Output('struk_'.$items[0]['pelanggan'].date('d-m-yy').'.pdf', 'I');
    }

}