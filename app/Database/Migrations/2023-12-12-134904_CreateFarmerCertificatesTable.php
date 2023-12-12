<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFarmerCertificatesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'FC_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Farmer_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Certificate_Name' => [
                'type' => 'TEXT',
            ],
            'Certificate_Description' => [
                'type' => 'TEXT',
                'null' => true, // Allow NULL values
            ],
            'Record_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Accessible', 'Archive'],
                'default' => 'Accessible',
            ],
        ]);

        $this->forge->addKey('FC_ID', true);
        $this->forge->createTable('farmer_certificates');
    }

    public function down()
    {
        $this->forge->dropTable('farmer_certificates');
    }
}
