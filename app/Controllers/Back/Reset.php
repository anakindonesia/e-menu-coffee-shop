<?php 
namespace App\Controllers\Back;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\Back\UserModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Reset extends BaseController
{

    public function __construct()
    {
        helper('text');
        helper('form');
        $this->user = new UserModel();
    }

    public function send()
    {
        $session        = \Config\Services::session();
        $email          = $this->request->getVar('email');
        $check_email    = $this->user->getUserByEmail($email);

        if($check_email){
            $token = sha1(random_string('numeric',10));
            $data = [
                'token' => $token
            ];
            $this->user->updateUserByEmail($email, $data);

            require ROOTPATH. 'app/ThirdParty/vendor/autoload.php';
            $mail = new PHPMailer(true);
            try{
                $link               = base_url('/admin/reset/password/'.$token);
                $mail->SMTPDebug    = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host         = 'mail.anakesia.com';
                $mail->SMTPAuth     = true;
                $mail->Username     = '99coffee@anakesia.com';
                $mail->Password     = 'NA2021nikah';
                $mail->SMTPSecure   = 'ssl';
                $mail->Port         = 465;

                $mail->setFrom('99coffee@anakesia.com', '99s Coffee');
                $mail->addAddress($email);
                $mail->addReplyTo('99coffee@anakesia.com', '99s Coffee');

                $mail->isHTML(true);
                $mail->Subject      = 'Reset Password';
                $mail->Body         = '<center><h3>Silahkan klik link berikut untuk reset password </h3> <br>'.$link.'</center>';

                $mail->send();
                
                $session->setFlashdata('sukses', 'Cek e-mail anda untuk mereset password');
                return redirect()->to('/admin');
            } catch (Exception $e){
                $session->setFlashdata('error', 'Reset password gagal');
                return redirect()->to('/admin');
            }
        }else{
            $session->setFlashdata('error', 'Maaf e-mail yang anda masukkan tidak terdaftar');
            return redirect()->to('/admin');
        }
    }

    public function checkToken($token)
    {
        $session        = \Config\Services::session();
        $check_token = $this->user->getUserByToken($token);
        
        if($check_token){
            $data   = [
                'validation'    => \config\Services::validation(),
                'token'         => $token
            ];
            return view('/Login/v_resetPassword', $data);
        }else{
            $session->setFlashdata('error', 'Mohon maaf anda tidak memiliki akses reset password');
            return redirect()->to('/admin');
        }
    }

    public function reset()
    {
        $session    = \Config\Services::session();
        $password   = $this->request->getVar('password');
        $password2  = $this->request->getVar('password2');
        $token      = $this->request->getVar('token');
        
        $val = $this->validate([
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
            ]
        ]); 

        if(!$val){
			$validation = $this->validator;
			return redirect()->to('/admin/reset/password/'.$token)->withInput()->with('validation', $validation);
        }else{
            if($password !== $password2){
                $session->setFlashdata('error', 'Password dan Konfirmasi Password tidak sama');
                return redirect()->to('/admin/reset/password/'.$token)->withInput();
            }else{
                $data = [
                    'password'  => sha1($password),
                    'token'     => NULL
                ];
                $this->user->updateUserByToken($token, $data);
                $session->setFlashdata('sukses', 'Password berhasil diganti, Silahkah login');
                return redirect()->to('/admin');
            }
        }
    }
}