<?php 

namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Back\UserModel;

class Login extends BaseController
{

	public function __construct()
	{
		helper('form');
        $this->user = new userModel();
	}

	public function index()
	{
		$session = \Config\Services::session();
		if($session->get('username') =="admin") {
			return redirect()->to(base_url('admin/home'));
		}

		return view('Login/v_loginUser');
    }
    
    public function loginAdmin()
    {  
		$session = \Config\Services::session();
		
		$val = $this->validate([
			'username'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'username harus di isi'
				]
			],
			'password'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'password harus di isi'
				]
			],
        ]);
        
        if(!$val) {
			$data= [
				'error' => 'Username/password harus di isi'
			];
			return view('Login/v_loginUser', $data);
        } else {
			$username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $check_user = $this->user->getUserLogin($username,$password);

            if($check_user){
				$session->set('user_id',$check_user['id_user']);
                $session->set('username',$check_user['username']);
				$session->set('nama',$check_user['nama']);
				$session->set('level',$check_user['level']);
				
				$session->setFlashdata('sukses', 'Anda berhasil login');
				return redirect()->to(base_url('admin/home'))->with('sukses', 'Anda berhasil login');
            }else{
				$data= [
					'error' => 'Username/password salah'
				];
				return view('Login/v_loginUser', $data);
			}
		}
	}
	public function logout()
	{
		$session = \Config\Services::session();
		$session->destroy();
		return redirect()->to(base_url('admin'));
	}
}