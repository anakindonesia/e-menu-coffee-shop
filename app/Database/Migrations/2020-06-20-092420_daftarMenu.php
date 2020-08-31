<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DaftarMenu extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_menu'          	=> [
					'type'           	=> 'INT',
					'constraint'     	=> 11,
					'auto_increment' 	=> TRUE
			],
			'nama_menu'       	=> [
					'type'           	=> 'VARCHAR',
					'constraint'     	=> '30',
			],
			'harga_menu' 		=> [
					'type'           	=> 'INT',
					'constraint'     	=> 11
			],
			'gambar_menu' 		=> [
					'type'           	=> 'VARCHAR',
					'constraint'     	=> '40',
			],
			'id_kategori' 		=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11
			],
			'is_active' 		=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11
			],
			'created_at'		=> [
				'type'					=> 'datetime'
			],
			'updated_at'		=> [
				'type'					=> 'datetime'
			],
			'created_people'		=> [
				'type'					=> 'VARCHAR',
				'constraint'			=> '35'
			],
			'updated_people'		=> [
				'type'					=> 'VARCHAR',
				'constraint'			=> '35'
			]
		]);
		$this->forge->addKey('id_menu', TRUE);
		$this->forge->createTable('daftar_menu');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
