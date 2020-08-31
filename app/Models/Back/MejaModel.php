<?php namespace App\Models\Back;

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

    public function getMejaByLantai($lantai)
    {
        $builder = $this->db->table($this->table)->where(['lantai'=>$lantai])->get()->getRowArray();
        return $builder;
    }

    public function getLaporanMeja($kondisi)
    {
        $this->where($kondisi);
        $this->select('meja.nama_meja, meja.lantai, pelanggan');
        $this->selectCount('order.pelanggan');
        $this->join('order', 'order.slug_meja = meja.slug_meja', 'left');
        $this->groupBy(['lantai','nama_meja']);
        $this->orderBy('lantai ASC, id_meja ASC');
        $builder = $this->findAll();
        return $builder;
    }


    public function updateMeja($slug_meja, $data)
    {
        $builder = $this->db->table($this->table)->where(['slug_meja'=>$slug_meja])->update($data);
        return $builder;
    }

    public function deleteMeja($lantai)
    {
        $builder = $this->db->table($this->table)->where(['lantai'=>$lantai])->delete();
        return $builder;
    }


}