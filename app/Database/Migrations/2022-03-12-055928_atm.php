<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Atm extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'kode_atm'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'nama_atm'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 50,
			],
			'alamat'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 255,
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'     => true
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'     => true
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('atm');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('atm');
	}
}
