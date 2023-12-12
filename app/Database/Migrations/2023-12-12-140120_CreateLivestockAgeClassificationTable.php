<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLivestockAgeClassificationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Age_Classification_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Age_Classification_Name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'Age_Range' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
            ],
            'LT_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addKey('Age_Classification_ID', true);
        $this->forge->createTable('livestock_age_classification');
    }

    public function down()
    {
        $this->forge->dropTable('livestock_age_classification');
    }
}
