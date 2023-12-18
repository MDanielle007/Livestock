<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserAccountsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'User_ID' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'Username' => [
                'type' => 'TEXT',
            ],
            'Password' => [
                'type' => 'TEXT',
            ],
            'Email' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'Firstname' => [
                'type' => 'TEXT',
            ],
            'Middlename' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'Lastname' => [
                'type' => 'TEXT',
            ],
            'Date_Of_Birth' => [
                'type' => 'DATE',
            ],
            'Gender' => [
                'type' => 'ENUM',
                'constraint' => ['Male', 'Female', 'Other'],
            ],
            'Civil_Status' => [
                'type' => 'TEXT',
            ],
            'Sitio' => [
                'type' => 'TEXT',
            ]
            'Barangay' => [
                'type' => 'TEXT',
            ]
            'City' => [
                'type' => 'TEXT',
            ]
            'Province' => [
                'type' => 'TEXT',
            ]
            'Phone_Number' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => true,
            ]
            'Image' => [
                'type' => 'TEXT',
            ]
            'User_Role' => [
                'type' => 'ENUM',
                'constraint' => ['Farmer', 'DA Personnel'],
            ]
            'User_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Active', 'Inactive',],
            ]
            'Last_Login_Date' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
            'Created_At' => [
                'type' => 'DATETIME',
            ]
            'Record_Status' => [
                'type' => 'ENUM',
                'constraint' => ['Accessible', 'Archive'],
            ]
            // Add other fields following the same pattern...
            'User_Token' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('User_ID', true);
        $this->forge->createTable('user_accounts');
    }

    public function down()
    {
        $this->forge->dropTable('user_accounts');
    }
}
