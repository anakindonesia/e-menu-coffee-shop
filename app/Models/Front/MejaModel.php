<?php namespace App\Models\Front;

use CodeIgniter\Model;

class MejaModel extends Model
{
    protected $table        = "meja";
    protected $primaryKey   = "id_meja";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_meja', 'sandi_meja', 'slug_meja','qrcode', 'j_pelanggan', 'j_pesanan','created_people','updated_people'];

    public function getMeja($slug)
    {
        $builder = $this->db->table($this->table)->where(['slug_meja'=>$slug])->get()->getRowArray();
        return $builder;
    }

    public function loginMeja($slug,$sandi)
    {
        $builder = $this->db->table($this->table)->where(['slug_meja' => $slug, 'sandi_meja' => $sandi])->get()->getRowArray();
        return $builder;
    }

    public function updateDataMeja($slug,$dataMeja)
    {
        $builder = $this->db->table($this->table)->where(['slug_meja'=>$slug])->update($dataMeja);
    }

}