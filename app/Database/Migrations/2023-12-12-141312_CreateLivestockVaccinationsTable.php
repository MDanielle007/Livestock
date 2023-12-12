<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLivestockVaccinationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Vaccination_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'VaccineAdministratorID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Livestock_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Vaccination_Name' => [
                'type' => 'VARCHAR',
                'constraint' => 70,
            ],
            'Vaccination_Description' => [
                'type' => 'TEXT',
                'null' => true, // Allow NULL values
            ],
            'Vaccination_Date' => [
                'type' => 'DATE',
            ],
            'Record_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Archive', 'Accessible'],
                'default' => 'Accessible',
            ],
        ]);

        $this->forge->addKey('Vaccination_ID', true);
        $this->forge->createTable('livestock_vaccinations');
    }

    public function down()
    {
        $this->forge->dropTable('livestock_vaccinations');
    }
}
