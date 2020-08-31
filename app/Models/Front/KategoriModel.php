<?php namespace App\Models\Front;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table        = "kategori";
    protected $primaryKey   = "id_kategori";
    protected $useTimestamps = true;
    protected $allowedFields = ['kategori','jenis_kategori','created_people','updated_people'];

    public function getSidebarKategori($jenis)
    {
        $builder = $this->where('jenis_kategori',$jenis)->findAll();
        return $builder;
    }

    public function getKategori($id)
    {
        $builder = $this->Where('id_kategori',$id)->first();
        return $builder;
    }

}