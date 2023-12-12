<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLivestockSalesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'Sales_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Farmer_ID' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'Sales_TotalPrice' => [
                'type' => 'DOUBLE',
                'constraint' => '10,2',
            ],
            'PaymentAmount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'ChangeAmount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'Sales_Date' => [
                'type' => 'DATETIME',
            ],
            'Buyer_Name' => [
                'type' => 'TEXT',
            ],
            'Buyer_Type' => [
                'type' => 'ENUM',
                'constraint' => ['Farmer', 'Other'],
            ],
            'Record_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Accessible', 'Archive'],
                'default' => 'Accessible',
            ],
        ]);

        $this->forge->addKey('Sales_ID', true);
        $this->forge->createTable('livestock_sales');
    }

    public function down()
    {
        $this->forge->dropTable('livestock_sales');
    }
}
