<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoyaltiesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'song_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'musician_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'income_source' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'plays_count' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'total_royalty' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'hash_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('royalties');
    }

    public function down()
    {
        $this->forge->dropTable('royalties');
    }
}