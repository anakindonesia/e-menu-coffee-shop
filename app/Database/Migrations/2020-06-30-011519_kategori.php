<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_kategori'          		=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11,
				'auto_increment' 		=> TRUE
			],
			'kategori'      	 		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '30',
			],
			'jenis_kategori'       		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '10',
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
		$this->forge->addKey('id_kategori', TRUE);
		$this->forge->createTable('kategori');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
