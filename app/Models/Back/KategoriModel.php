<?php namespace App\Models\Back;

use CodeIgniter\Model;


class KategoriModel extends Model
{
    protected $table        = "kategori";
    protected $primaryKey   = "id_kategori";
    protected $useTimestamps = true;
    protected $allowedFields = ['kategori','jenis_kategori','created_people','updated_people'];
    
    public function getKategori($id_kategori = false, $jenis_Kategori = false)
    {
        if($id_kategori == false){
            $builder = $this->where('jenis_kategori',$jenis_Kategori)->findAll();
            return $builder;
        }
        $builder = $this->where('id_kategori',$id_kategori)->get()->getRowArray();
        return $builder;
    }
    


}