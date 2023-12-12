<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSoldLivestocksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Sold_Livestock_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Sales_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Livestock_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Livestock_Price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);

        $this->forge->addKey('Sold_Livestock_ID', true);
        $this->forge->createTable('sold_livestocks');
    }

    public function down()
    {
        $this->forge->dropTable('sold_livestocks');
    }
}
