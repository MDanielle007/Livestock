<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDaPersonnelsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'DAP_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'User_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Position' => [
                'type' => 'TEXT',
            ],
            'Division' => [
                'type' => 'TEXT',
            ],
            'Record_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Accessible', 'Archive'],
                'default' => 'Accessible',
            ],
        ]);

        $this->forge->addKey('DAP_ID', true);
        $this->forge->createTable('da_personnels');
    }

    public function down()
    {
        $this->forge->dropTable('da_personnels');
    }
}
