<?php namespace App\Models\Back;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table        = "user_login";
    protected $primaryKey   = "id_user";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama','username', 'password','token','level','email','created_people','updated_people'];

    public function getUserLogin($username,$password)
    {
        $builder = $this->db->table($this->table)->where(['username' => $username, 'Password' => sha1($password)])->get()->getRowArray();
        return $builder;
    }

    public function getUserByEmail($email)
    {
        $builder = $this->where('email', $email)->first();
        return $builder;
    }

    public function getUserByToken($token)
    {
        $builder = $this->where('token', $token)->first();
        return $builder;
    }

    public function updateUserByEmail($email, $data)
    {
        $builder = $this->db->table($this->table)->where('email', $email)->update($data);
        return $builder;
    }

    public function updateUserByToken($token, $data)
    {
        $builder = $this->db->table($this->table)->where('token', $token)->update($data);
        return $builder;
    }
}