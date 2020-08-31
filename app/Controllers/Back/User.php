<?php 
namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Models\Back\UserModel;
use App\Controllers\BaseController;

class User extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->user = new UserModel;
    }

    public function index()
    {
        $data['users'] = $this->user->findAll();
        return view('Back/v_user', $data);
    }

    public function tambahUser()
    {
        $data = [
            'validation'		=> \config\Services::validation()
        ];
        return view('Back/v_tambahUser', $data);
    }

    public function saveTambahUser()
    {
        $session = \Config\Services::session();
        if($this->request->getMethod() !== 'post'){
			return redirect()->to('/admin/makanan');
        }
        
        $val = $this->validate([
            'nama'	    => [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'nama harus di isi'
				]
            ],
            'username'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'username harus di isi'
				]
            ],
            'email'	=> [
				'rules'	=> 'required|valid_email',
				'errors'=> [
                    'required' => 'username harus di isi',
                    'valid_email' => 'periksa kembali format e-mail anda'
				]
			],
			'password'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'password harus di isi'
				]
            ],
            'password2'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'konfirmasi password harus di isi'
				]
            ],
            'level'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'level harus di dipilih'
				]
            ],
        ]);
        
        if(!$val){
			$validation = $this->validator;
			return redirect()->to('/admin/user/tambah')->withInput()->with('validation', $validation);
		}else{
            $nama       = $this->request->getVar('nama');
            $username   = $this->request->getVar('username');
            $email      = $this->request->getVar('email'); 
            $password   = $this->request->getVar('password');
            $password2  = $this->request->getVar('password2');
            $level      = $this->request->getVar('level');

            if($password !== $password2){
                $session->setFlashdata('error', 'Password dan Konfirmasi Password tidak sama');
                return redirect()->to('/admin/user/tambah')->withInput();
            }else{
                $data = [
                    'nama'          => $nama,
                    'username'      => $username,
                    'email'         => $email,
                    'password'      => sha1($password),
                    'level'         => $level,
                    'created_people'=> $_SESSION['nama'],
                    'updated_people'=> $_SESSION['nama']
                ];

                $this->user->save($data);
                return redirect()->to('/admin/user');
            }
        }
    }

    public function editUser($id_user)
    {
        $data = [
            'user'              => $this->user->find($id_user),
            'levels'            => ['admin', 'koki', 'kasir', 'pelayan'],
            'validation'		=> \config\Services::validation()
        ];
        return view('Back/v_editUser', $data);
    }

    public function saveEditUser()
    {
        $session = \Config\Services::session();
        if($this->request->getMethod() !== 'post'){
			return redirect()->to('/admin/makanan');
        }
        
        $val = $this->validate([
			'nama'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'nama harus di isi'
				]
            ],
            'username'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'username harus di isi'
				]
            ],
            'email'	=> [
				'rules'	=> 'required|valid_email',
				'errors'=> [
                    'required' => 'username harus di isi',
                    'valid_email' => 'periksa kembali format e-mail anda'
				]
			],
            'level'	=> [
				'rules'	=> 'required',
				'errors'=> [
					'required' => 'level harus di dipilih'
				]
            ],

        ]);
        
        if(!$val){
			$validation = $this->validator;
			return redirect()->to('/admin/user/edit')->withInput()->with('validation', $validation);
		}else{
            $id_user    = $this->request->getVar('id_user');
            $nama       = $this->request->getVar('nama');
            $username   = $this->request->getVar('username');
            $email      = $this->request->getVar('email');
            $level      = $this->request->getVar('level');

            $data   = [
                'nama'          => $nama,
                'username'      => $username,
                'email'         => $email,
                'level'         => $level,
                'updated_people'=> $_SESSION['nama']
            ];

            $this->user->update($id_user, $data);
            return redirect()->to('/admin/user');
        }
    }

    public function resetPassword($id_user)
    {
        $data   = [
            'password'      => sha1(12345),
            'updated_people'=> $_SESSION['nama']
        ];
        $this->user->update($id_user, $data);
        return redirect()->to('/admin/user');
    }

    public function deleteUser()
    {
        $session = \Config\Services::session();
		if($session->get('username') =="") {
			$data= [
				'error' => 'Anda harus login dahulu'
			];
			return view('Login/v_loginUser', $data);
		}
		$id_user	= $this->request->getPost('id_user');
		$this->user->delete($id_user);
		return redirect()->to('/admin/user');
    }

}