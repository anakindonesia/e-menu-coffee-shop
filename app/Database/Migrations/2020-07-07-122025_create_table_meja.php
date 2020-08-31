<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMeja extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_meja'          			=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11,
				'auto_increment' 		=> TRUE
			],
			'nama_meja'      	 		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '10',
			],
			'sandi_meja'		       	=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '15',
			],
			'slug_meja'		       		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '10',
			],
			'qrcode'		       		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '20',
			],
			'lantai'			       	=> [
				'type'           		=> 'INT',
				'constraint'     		=> '11',
			],
			'j_pelanggan'		       	=> [
				'type'           		=> 'INT',
				'constraint'     		=> '11',
			],
			'j_pesanan'		  	     	=> [
				'type'           		=> 'INT',
				'constraint'     		=> '11',
			],
			'created_at'				=> [
				'type'					=> 'datetime'
			],
			'updated_at'				=> [
				'type'					=> 'datetime'
			],
			'created_people'			=> [
				'type'					=> 'VARCHAR',
				'constraint'			=> '35'
			],
			'updated_people'			=> [
				'type'					=> 'VARCHAR',
				'constraint'			=> '35'
			]
		]);
		$this->forge->addKey('id_meja', TRUE);
		$this->forge->createTable('meja');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
