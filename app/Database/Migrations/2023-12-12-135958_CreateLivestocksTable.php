<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLivestocksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Livestock_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Livestock_TagID' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => true, // Allow NULL values
            ],
            'Livestock_Type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'Breed_Name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true, // Allow NULL values
            ],
            'Age_Classification' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'Age_Days' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'Age_Weeks' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'Age_Months' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'Age_Years' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'Sex' => [
                'type' => 'ENUM',
                'constraint' => ['Male', 'Female'],
            ],
            'Breeding_Eligibility' => [
                'type' => 'ENUM',
                'constraint' => ['Age-Suited', 'Not Age-Suited'],
                'default' => 'Not Age-Suited',
            ],
            'Date_Of_Birth' => [
                'type' => 'DATE',
            ],
            'Livestock_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Alive', 'Dead'],
                'default' => 'Alive',
            ],
            'Record_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Accessible', 'Archive'],
                'default' => 'Accessible',
            ],
        ]);

        $this->forge->addKey('Livestock_ID', true);
        $this->forge->createTable('livestocks');
    }

    public function down()
    {
        $this->forge->dropTable('livestocks');
    }
}
