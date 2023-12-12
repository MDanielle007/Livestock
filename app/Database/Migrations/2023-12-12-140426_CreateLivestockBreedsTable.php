<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLivestockBreedsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Breed_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Breed_Name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'Breed_Name_Tagalog' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true, // Allow NULL values
            ],
            'Breed_Description' => [
                'type' => 'TEXT',
                'null' => true, // Allow NULL values
            ],
            'LT_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addKey('Breed_ID', true);
        $this->forge->createTable('livestock_breeds');
    }

    public function down()
    {
        $this->forge->dropTable('livestock_breeds');
    }
}
