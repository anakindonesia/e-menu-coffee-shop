<?php namespace App\Database\Seeds;

class daftarMenu extends \CodeIgniter\Database\Seeder
{
        public function run()
        {
                $data = [ 
                        'nama_menu'     => 'Capucino',
                        'harga_menu'    => '8000',
                        'gambar_menu'   => 'logo.png' 
                ];


                // Using Query Builder
                $this->db->table('daftar_menu')->insert($data);
        }
}