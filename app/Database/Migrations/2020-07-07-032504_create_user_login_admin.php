<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserLoginAdmin extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_user'          			=> [
				'type'           		=> 'INT',
				'constraint'     		=> 11,
				'auto_increment' 		=> TRUE
			],
			'nama'      	 			=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '35',
			],
			'username'      	 		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '20',
			],
			'password'		       		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '50',
			],	
			'token'			       		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '50',
				'NULL'					=> true,
			],		
			'level'			       		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '10',
			],		
			'email'			       		=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> '50',
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
		$this->forge->addKey('id_user', TRUE);
		$this->forge->createTable('user_login');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
