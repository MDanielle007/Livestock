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
