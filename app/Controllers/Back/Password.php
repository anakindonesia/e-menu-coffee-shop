<?php 
namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Models\Back\UserModel;
use App\Controllers\BaseController;

class Password extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->user = new UserModel();
    }

    public function index()
    {
        $data = [
            'validation'		=> \config\Services::validation()
        ];
        return view('Back/v_resetPassword', $data);
    }

    public function resetPassword()
    {
        $session = \Config\Services::session();
        $id_user        = $this->request->getVar('id_user');
        $password_lama  = $this->request->getVar('password_lama');
        $password_baru  = $this->request->getVar('password_baru');
        $password_baru2 = $this->request->getVar('password_baru2');

        $user = $this->user->find($id_user);

        $val = $this->validate([
			'password_lama'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'kolom harus di isi'
				]
			],
			'password_baru'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'kolom harus di isi'
				]
            ],
            'password_baru2'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'kolom harus di isi'
				]
            ],
        ]);

        if(!$val){
			$validation = $this->validator;
			return redirect()->to('/admin/password')->withInput()->with('validation', $validation);
		}else{
            
            if(sha1($password_lama) !== $user['password'])
            {
                $session->setFlashdata('error', 'Password lama tidak sesuai');
                return redirect()->to('/admin/password')->withInput();
            } else{
                if($password_baru !== $password_baru2)
                {
                    $session->setFlashdata('error', 'Password baru dan Konfirmasi Password tidak sama');
                    return redirect()->to('/admin/password')->withInput();
                }else{
                    $data = [
                        'password'      => sha1($password_baru),
                        'updated_people'=> $_SESSION['nama']
                    ];
                    $this->user->update($id_user, $data);
                    $session->destroy();
                    return redirect()->to('/admin');
                };
            };
        };
    }
}