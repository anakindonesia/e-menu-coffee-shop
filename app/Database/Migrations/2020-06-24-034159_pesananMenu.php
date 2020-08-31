<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PesananMenu extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_pesanan'          	=> [
					'type'           	=> 'INT',
					'constraint'     	=> 11,
					'auto_increment' 	=> TRUE
			],
			'id_order'       		=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11,
				'null'           		=> TRUE,
			],
			'id_menu'       		=> [
					'type'           	=> 'INT',
					'constraint'     	=> 11
			],
			'quantity' 				=> [
					'type'           	=> 'INT',
					'constraint'     	=> 11
			],
			'sub_total' 			=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11
			],
			'tmp_menu' 				=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11
			],
			'status_menu' 			=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11,
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
		$this->forge->addKey('id_pesanan', TRUE);
		$this->forge->createTable('pesanan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
