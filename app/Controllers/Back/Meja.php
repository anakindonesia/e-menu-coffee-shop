<?php 

namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Models\Back\MejaModel;
use App\Controllers\BaseController;
use DateTime;
use TCPDF;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;

class Meja extends BaseController
{

	public function __construct()
	{
        helper('text');
		$this->meja 	= new MejaModel;
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
		$data['items'] = $this->meja->orderBy('lantai ASC, id_meja ASC')->findAll();
		return view('Back/v_meja',$data);
    }
    
    public function saveMeja()
    {
        $session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
        } 
		
        $jumlah_meja 	= $this->request->getVar('jumlah_meja');
		$kunci_sandi 	= $this->request->getVar('kunci_sandi');
		$lantai 	 	= $this->request->getVar('lantai');
		$meja			= $this->meja->getMejaByLantai($lantai);

		include APPPATH . 'ThirdParty/vendor/autoload.php';
		$qrcode		= new QrCode();

        $data = [];
        for ($i = 1; $i <= $jumlah_meja; $i++)
        {
			$nama_meja 			= "Meja ".$i;
			$nama_slug			= $nama_meja.'_'.$lantai;
			$sandi_meja 		= url_title($kunci_sandi,'_', true).random_string('numeric',3);
			$slug_meja 			= url_title($nama_slug,'_', true);
			$image_name			= $slug_meja.'-'.$lantai.'.png';
			$isi_teks 			=  base_url('/login/'.$slug_meja.'/'.$sandi_meja);

			$qrcode->setText($isi_teks);
			$qrcode->setWriterByName('png');
			$qrcode->setMargin(10);
			$qrcode->setEncoding('UTF-8');
			$qrcode->setErrorCorrectionLevel(new ErrorCorrectionLevel(ErrorCorrectionLevel::HIGH));

			$qrcode->setLogoPath(FCPATH . 'QRCode/logo.png');
			$qrcode->setLogoSize(150, 150);
			$qrcode->setRoundBlockSize(true);
			$qrcode->setValidateResult(false);
			$qrcode->setWriterOptions(['exclude_xml_declaration' => true]);
			$qrcode->writeFile(FCPATH . 'QRCode/'.$image_name);

            $data[] = [
                'nama_meja'     	=> $nama_meja,
				'sandi_meja'    	=> $sandi_meja,
				'slug_meja'			=> $slug_meja,
				'qrcode'			=> $image_name,
				'lantai'			=> $lantai,
				'created_people'	=> $_SESSION['username'],
				'updated_people'	=> $_SESSION['username']
			];
		}
		if($meja !== NULL){
			$this->meja->deleteMeja($lantai);
			$this->meja->insertBatch($data);
		}else{
			$this->meja->insertBatch($data);
		}
        
        return redirect()->to(base_url('admin/meja'));
    }

    public function deleteMeja()
	{
		$session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		$id_meja	= $this->request->getPost('id_meja');
		$this->meja->delete($id_meja);
		return redirect()->to(base_url('admin/meja'));
	}

	public function cetakMeja()
	{
		$mejas = $this->meja->findAll();
		
		include_once APPPATH . '/ThirdParty/TCPDF/tcpdf.php';

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
		$pdf->SetMargins(4,2,2);
		
		$pdf->SetTitle('Daftar Meja');

		$pdf->AddPage();
		$pdf->SetFont('','',10);
		
		foreach ($mejas as $meja) {
		$daftar_meja = 
		'
			<table border="1">
				<tr>
					<td> <img src ="/QRCode/'.$meja['qrcode'].'">  </td>
					<td> <h2 style="text-align: center;"> 
						Silahkan Scan QR Code di samping untuk login atau 
						anda bisa juga login dengan memasukkan nama dan sandi meja dibawah ini
						<br> </h2>
						<h1 style="text-align: center;">
						Lantai =  '. $meja['lantai'] .' <br> <br> 
						Nama Meja =  '. $meja['nama_meja'] .' <br> <br> 
						Sandi Meja = '. $meja['sandi_meja'] .' </h1>
					</td>
				</tr>
			</table>
			<br><br><br><br><br><br><br><br>
			
		' ;
		$pdf->writeHTML($daftar_meja);
		}
		
		$this->response->setHeader('Content-Type', 'application/pdf');

		$nama_file	= 'Daftar_Meja'.date('dmYHis').'.pdf';
		$pdf->Output($nama_file, 'I');
	}

}