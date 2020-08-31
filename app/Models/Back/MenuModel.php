<?php namespace App\Models\Back;

use CodeIgniter\Model;


class MenuModel extends Model
{

    protected $table        = 'daftar_menu';
    protected $primaryKey   = 'id_menu';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_menu', 'harga_menu', 'gambar_menu', 'id_kategori', 'is_active','created_people','updated_people'];

    public function getMenu($jenis_kategori,$id_menu = false)
    {
        if ($id_menu == false) {
            $builder = $this->join('kategori', 'kategori.id_kategori = daftar_menu.id_kategori', 'left')->where(['jenis_kategori'=> $jenis_kategori])->findAll();
            return $builder;
        } 
        
        $builder = $this->join('kategori', 'kategori.id_kategori = daftar_menu.id_kategori', 'left')->where(['id_menu' => $id_menu])->first();
        return $builder;
        
    }

    // public function updateMenu($id_menu, $data)
    // {
    //     $builder = $this->db->table($this->table)->where(['id_menu'=>$id_menu])->update($data);
    //     return $builder;
    // }

    public function deleteMenu($id_menu)
    {
        $builder = $this->join('kategori', 'kategori.id_kategori = daftar_menu.id_kategori', 'left')->where(['daftar_menu.id_menu'=>$id_menu])->delete();
        return $builder;
    }

    public function getLaporanMenu($kondisi)
    {
        $this->where($kondisi);
        $this->select('daftar_menu.id_menu, daftar_menu.nama_menu, daftar_menu.id_kategori, order.tanggal_pesan');
        $this->selectSum('quantity');
        $this->selectSum('sub_total');
        $this->join('pesanan', 'pesanan.id_menu = daftar_menu.id_menu', 'left');
        $this->groupBy('daftar_menu.id_menu');
        $this->orderBy('daftar_menu.nama_menu ASC');
        $builder = $this->findAll();
        return $builder;
    }


}