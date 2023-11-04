<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserAccountsTable extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'User_ID'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true
        ],
        'Username'       => [
            'type'       => 'TEXT',
            'null' => false,
        ],
        'Password'       => [
            'type' => 'TEXT',
            'null' => false,
        ],
        'Email'          => [
            'type' => 'TEXT',
            'null' => true,
        ],
        'Firstname'      => [
            'type'       => 'TEXT',
            'null' => false,
        ],
        'Middlename'     => [
            'type'       => 'TEXT',
            'null' => false,
        ],
        'Lastname'       => [
            'type'       => 'TEXT',
            'null' => false,
        ],
        'Date_Of_Birth' => [
            'type'       => 'DATETIME',
            'null' => false,
        ],
        'Gender' => [
            'type'       => 'ENUM',
            'constraint' => ['Male', 'Female', 'Other'],
            'null' => false,
        ],
        'Civil_Status' => [
            'type'       => 'TEXT',
            'null' => false,
        ],
        'Sitio' => [
            'type'       => 'TEXT',
            'null' => false,
        ],
        'Barangay' => [
            'type'       => 'TEXT',
            'null' => false,
        ],
        'City' => [
            'type'       => 'TEXT',
            'null' => false,
        ],
        'Province' => [
            'type'       => 'TEXT',
            'null' => false,
        ],
        'Phone_Number' => [
            'type'       => 'VARCHAR',
            'constraint' => '11',
            'null' => false,
        ],
        'Image' => [
            'type'       => 'TEXT',
            'null' => false,
        ],
        'User_Role' => [
            'type'       => 'ENUM',
            'constraint' => ['DAP', 'Farmer'],
            'null' => false,
        ],
        'User_Status' => [
            'type'       => 'ENUM',
            'constraint' => ['Active', 'Inactive'],
            'null' => false,
        ],
        'Last_Login_Date' => [
            'type'       => 'DATETIME',
            'null' => false,
        ],
        'Created_At' => [
            'type'       => 'DATETIME',
            'null' => false,
        ],
        'Record_Status' => [
            'type'       => 'ENUM',
            'constraint' => ['Accessible', 'Archive'],
            'null' => false,
        ]
    ]);

    $this->forge->addKey('User_ID', true);
    $this->forge->createTable('user_accounts'); 
}

    public function down()
    {
        $this->forge->dropTable('user_accounts');
    }
}
