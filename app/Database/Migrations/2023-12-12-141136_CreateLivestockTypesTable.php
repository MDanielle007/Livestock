<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLivestockTypesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'LT_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Type_Name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'Livestock_Uses' => [
                'type' => 'TEXT',
                'null' => true, // Allow NULL values
            ],
        ]);

        $this->forge->addKey('LT_ID', true);
        $this->forge->createTable('livestock_types');
    }

    public function down()
    {
        $this->forge->dropTable('livestock_types');
    }
}
