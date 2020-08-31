<?php 

namespace App\Controllers\Front;

use CodeIgniter\Controller;
use App\Models\Front\MejaModel;
use App\Models\Front\OrderModel;
use App\Controllers\BaseController;

class Login extends BaseController
{

	public function __construct()
	{
        helper('form');
        $this->meja = new MejaModel;
        $this->order = new OrderModel;
	}

	public function index()
	{
        $session = \Config\Services::session();
        if($session->get('id_meja') !== null ) {
			return redirect()->to(base_url('home'));
        }
        
        if($session->get('status_order') == 1){
            return redirect()->to(base_url('selesai'));
        }

            $data['mejas']	= $this->meja->findAll();
			
			return view('Login/v_loginPelanggan', $data);
    }
    
    public function loginPelanggan()
    {
        if($this->request->getMethod() !== 'post'){
			return redirect()->to('/');
        }

        $session = \Config\Services::session();
        $val = $this->validate([
			'slug_meja'	=> 'required',
			'nama'	=> 'required',
			'sandi'	=> 'required',
        ]);

        if(!$val) {
			$data= [
                'mejas' => $this->meja->findAll()
            ];
            $session->setFlashdata('error', 'meja/nama/sandi harus di isi');
            return view('Login/v_loginPelanggan', $data);
        } else {
            $slug = $this->request->getVar('slug_meja');
            $sandi = $this->request->getVar('sandi');
            $nama = $this->request->getVar('nama');

            $check_user = $this->meja->loginMeja($slug,$sandi);

            if($check_user){
                $session->set('nama',$nama);
                $session->set('slug',$slug);
                $session->set('status_order',0);
                $session->set('status_menu', 0);
                $session->set('id_meja',$check_user['id_meja']);
                $session->set('meja',$check_user['nama_meja']);

                $this->order->save([
                    'slug_meja'         => $slug,
                    'pelanggan'         => $nama,
                    'slug_pelanggan'    => url_title($nama,'_', true),
                    'created_people'	=> $nama
                ]);
				
				$session->setFlashdata('sukses', 'Anda berhasil login');
				return redirect()->to(base_url('home'))->with('sukses', 'Anda berhasil login');
            }else{
				$data= [
                    'mejas' => $this->meja->findAll()
                ];
                $session->setFlashdata('error', 'Meja dan sandi tidak cocok');
				return view('Login/v_loginPelanggan', $data);
			}
        }
    }

    public function loginQrcode($slug,$sandi)
    {
        $data = [
            'slug'  => $slug,
            'sandi' => $sandi
        ];

        return view('Login/v_loginQrcode', $data);
    }
}