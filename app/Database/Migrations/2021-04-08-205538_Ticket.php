<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ticket extends Migration
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
			'kode_ticket'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'kode_pemesan' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'tanggal' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'kategori' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'urgency' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'subject' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'deskripsi' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
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
		$this->forge->createTable('ticket');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('ticket');
	}
}
