<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFarmerlivestocksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FL_ID' => [
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
            'Acquired_Date' => [
                'type' => 'DATE',
            ],
            'OwnershipStatus' => [
                'type' => 'ENUM',
                'constraint' => ['Owned', 'Sold', 'Deceased', 'Transferred'],
                'default' => 'Owned',
            ],
            'Record_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Accessible', 'Archive'],
                'default' => 'Accessible',
            ],
        ]);

        $this->forge->addKey('FL_ID', true);
        $this->forge->createTable('farmerlivestocks');
    }

    public function down()
    {
        $this->forge->dropTable('farmerlivestocks');
    }
}
