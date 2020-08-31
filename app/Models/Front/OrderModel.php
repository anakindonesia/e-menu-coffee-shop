<?php namespace App\Models\Front;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = "order";
    protected $primaryKey       = "id_order";
    protected $useTimestamps    = true;
    protected $allowedFields    = ['slug_meja','pelanggan','slug_pelanggan','tmp_order','status_bayar','tanggal_pesan','created_people','updated_people'];

    public function getOrder($slug_pelanggan, $tmp_order = null)
    {
        $builder = $this->where(['slug_pelanggan' => $slug_pelanggan, 'tmp_order' => $tmp_order])->get()->getRowArray();
        return $builder;
    }

    public function getOrderBySlug($slug_pelanggan)
    {
        $this->where(['slug_pelanggan' => $slug_pelanggan]);
        $this->orderBy('id_order DESC');
        $builder = $this->limit(1)->get()->getRowArray();
        return $builder;
    }

    public function getOrderSelected($id_order)
    {
        $builder = $this->db->table($this->table)->where(['id_order' => $id_order ])->get()->getRowArray();
        return $builder;
    }

}