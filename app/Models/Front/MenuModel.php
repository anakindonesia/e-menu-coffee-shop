<?php namespace App\Models\Front;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table        = "daftar_menu";
    protected $primaryKey   = "id_menu";
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_menu', 'harga_menu', 'gambar_menu', 'id_kategori', 'is_active','created_people','updated_people'];
    
    public function getMenu($kategori,$jenis_kategori)
    {
        $builder = $this->join('kategori', 'kategori.id_kategori = daftar_menu.id_kategori', 'left')->where(['kategori' => $kategori,'jenis_kategori'=>$jenis_kategori])->findAll();
        return $builder;
    }
    
    public function getMenuCart($id)
    {
        $builder =  $this->db->table($this->table)->where('id_menu', $id)->get()->getRowArray();
        return $builder;
    }

}