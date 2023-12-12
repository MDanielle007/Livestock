<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFarmerDataHistoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FDH_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Farmer_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Livestock_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Action' => [
                'type' => 'ENUM',
                'constraint' => ['Add', 'Edit', 'Delete', 'Archive'],
            ],
            'Title' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'Description' => [
                'type' => 'TEXT',
            ],
            'Type' => [
                'type' => 'ENUM',
                'constraint' => ['Livestock', 'Vaccination', 'Breeding', 'Mortality'],
            ],
            'Timestamp' => [
                'type' => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'Record_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Accessible', 'Archive'],
                'default' => 'Accessible',
            ],
        ]);

        $this->forge->addKey('FDH_ID', true);
        $this->forge->createTable('farmer_data_history');
    }

    public function down()
    {
        $this->forge->dropTable('farmer_data_history');
    }
}
