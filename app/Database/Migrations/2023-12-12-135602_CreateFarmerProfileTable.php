<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFarmerProfileTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Farmer_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'User_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Years_Of_Farming' => [
                'type' => 'INT',
                'null' => true, // Allow NULL values
            ],
            'Record_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Accessible', 'Archive'],
                'default' => 'Accessible',
            ],
        ]);

        $this->forge->addKey('Farmer_ID', true);
        $this->forge->createTable('farmer_profile');
    }

    public function down()
    {
        $this->forge->dropTable('farmer_profile');
    }
}
