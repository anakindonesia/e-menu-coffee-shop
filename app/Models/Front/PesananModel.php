<?php namespace App\Models\Front;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table        = "pesanan";
    protected $primaryKey   = "id_pesanan";
    protected $useTimestamps = true;
    protected $allowedFields = ['id_order','id_menu', 'quantity','sub_total','tmp_menu','status_menu','created_people','updated_people'];

    public function getPesanan($id_order, $tmp_menu = 0)
    {
        if($tmp_menu != NULL){
            $this->join('daftar_menu', 'daftar_menu.id_menu = pesanan.id_menu', 'left');
            $this->where(['id_order'=> $id_order, 'tmp_menu'=>$tmp_menu]);
            $builder = $this->findAll();
            return $builder;
        }

        $this->join('daftar_menu', 'daftar_menu.id_menu = pesanan.id_menu', 'left');
        $this->where(['id_order'=> $id_order]);
        $builder = $this->findAll();
        return $builder;

    }

    public function existPesanan($id,$id_order)
    {
        $builder = $this->where(['id_menu'=> $id, 'id_order'=>$id_order, 'tmp_menu'=>0])->get()->getRowArray();
        return $builder;
    }

    public function getPesananSelected($id_pesanan)
    {
        $builder = $this->join('daftar_menu', 'daftar_menu.id_menu = pesanan.id_menu', 'left')->where(['id_pesanan'=> $id_pesanan])->findAll();
        return $builder;
    }

    public function getCetakPesanan($id_order)
    {
        $this->select('order.*,pesanan.*,daftar_menu.*,order.updated_people');
        $this->join('order','order.id_order = pesanan.id_order','left');
        $this->join('daftar_menu','daftar_menu.id_menu = pesanan.id_menu','left');
        $this->where(['order.id_order' => $id_order]);
        $builder = $this->findAll();
        return $builder;
    }

    public function updateTmpPesanan($id_order, $data)
    {
        $query = $this->db->table($this->table)->where(['id_order'=>$id_order, 'tmp_menu'=>0])->update($data);
        return $query;
    }

}