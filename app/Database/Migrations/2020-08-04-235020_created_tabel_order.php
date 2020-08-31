<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatedTabelOrder extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_order'          	=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11,
				'auto_increment' 		=> TRUE
			],
			'slug_meja'       		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '10',
			],
			'pelanggan'       		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '35',
			],	
			'slug_pelanggan'       	=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '35',
			],		
			'tmp_order'       		=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11,
				'NULL'					=> true,
			],	
			'status_bayar'			=> [
				'type'					=> 'INT',
				'constraint'			=> 11
			],
			'tanggal_pesan'			=> [
				'type'					=> 'VARCHAR',
				'constraint'			=> '15'
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
		$this->forge->addKey('id_order', TRUE);
		$this->forge->createTable('order');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
