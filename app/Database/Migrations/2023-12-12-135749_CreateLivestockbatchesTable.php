<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLivestockbatchesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'LB_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Farmer_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Batch_Name' => [
                'type' => 'TEXT',
            ],
            'Livestock_Type' => [
                'type' => 'TEXT',
            ],
            'Record_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Accessible', 'Archive'],
                'default' => 'Accessible',
            ],
        ]);

        $this->forge->addKey('LB_ID', true);
        $this->forge->createTable('livestockbatches');
    }

    public function down()
    {
        $this->forge->dropTable('livestockbatches');
    }
}
