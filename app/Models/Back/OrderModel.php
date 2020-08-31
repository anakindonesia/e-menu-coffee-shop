<?php namespace App\Models\Back;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table        = "order";
    protected $primaryKey   = "id_order";
    protected $useTimestamps = true;
    protected $allowedFields    = ['slug_meja','pelanggan','slug_pelanggan','tmp_order','status_bayar','tanggal_pesan','created_people','updated_people'];

    public function getOrderSelectedSlugMeja($slug_meja, $tmp_order)
    {
        $builder = $this->where(['slug_meja' => $slug_meja, 'tmp_order' => $tmp_order])->findAll();
        return $builder;
    }

    public function getOrderSelectedIdOrder($id_order, $tmp_order)
    {
        $builder = $this->where(['id_order' => $id_order, 'tmp_order' => $tmp_order])->get()->getRowArray();
        return $builder;
    }

    public function getRekapOrder()
    {
        $this->join('meja', 'meja.slug_meja = order.slug_meja', 'left');
        $this->where(['tmp_order' => 0]);
        $builder = $this->orderBy('id_order DESC')->findAll();
        return $builder;
    }

}