<?php namespace App\Models\Back;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table        = "pesanan";
    protected $primaryKey   = "id_pesanan";
    protected $useTimestamps = true;
    protected $allowedFields = ['id_order','id_menu', 'quantity','sub_total','tmp_menu','status_menu','created_people','updated_people'];

    public function getPesananLast($id_order)
    {
        $builder = $this->where(['id_order' => $id_order])->findAll();
        return $builder;
    }

    public function getPesanan($id_order, $status_menu = NULL)
    {
        if ($status_menu !== NULL){
            $this->join('daftar_menu', 'daftar_menu.id_menu = pesanan.id_menu', 'left');
            $this->join('order', 'order.id_order = pesanan.id_order', 'left');
            $this->where(['pesanan.id_order'=>$id_order, 'status_menu' => $status_menu ]);
            $builder = $this->findAll();
            return $builder;
        }
        $this->join('daftar_menu', 'daftar_menu.id_menu = pesanan.id_menu', 'left');
        $this->join('order', 'order.id_order = pesanan.id_order', 'left');
        $this->where(['pesanan.id_order'=>$id_order]);
        $builder = $this->findAll();
        return $builder; 
    }

    public function getPesananIdPesanan($id_pesanan)
    {
        $builder = $this->where('id_pesanan', $id_pesanan)->first();
        return $builder;
    }

    public function updatePesananBatch($data)
    {
        $builder = $this->db->table($this->table)->updateBatch($data,'id_order');
        return $builder;
    }

    public function getRekapPesanan($id_order)
    {
        $this->select('order.*,pesanan.*,daftar_menu.*,order.updated_people');
        $this->join('order','order.id_order = pesanan.id_order','left');
        $this->join('daftar_menu','daftar_menu.id_menu = pesanan.id_menu','left');
        $this->where(['order.id_order' => $id_order]);
        $builder = $this->findAll();
        return $builder;
    }

    public function getLaporanPenjualan($kondisi)
    {
        $this->where($kondisi);
        $this->select('daftar_menu.id_menu, daftar_menu.nama_menu, daftar_menu.id_kategori, order.tanggal_pesan, kategori.jenis_kategori,');
        $this->selectSum('quantity');
        $this->selectSum('sub_total');
        $this->join('daftar_menu', 'daftar_menu.id_menu = pesanan.id_menu', 'left');
        $this->join('order', 'order.id_order = pesanan.id_order', 'left');
        $this->join('kategori', 'kategori.id_kategori = daftar_menu.id_kategori', 'left');
        $this->groupBy('daftar_menu.id_menu');
        $this->orderBy('daftar_menu.nama_menu ASC');
        $builder = $this->findAll();
        return $builder;
    }

}