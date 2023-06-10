<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Teknisi extends Migration
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
			'kode_tek'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'kode_user'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'kode_kategori'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
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
		$this->forge->createTable('teknisi');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('teknisi');
	}
}
