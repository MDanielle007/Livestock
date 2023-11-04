<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAccountModel extends Model
{
    protected $table            = 'user_accounts';
    protected $primaryKey       = 'User_ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Username', 'Password', 'Email','Firstname', 'Middlename', 'Lastname', 'Date_Of_Birth', 'Gender', 'Civil_Status', 'Sitio', 'Barangay', 'City', 'Province', 'Phone_Number', 'Image', 'User_Role', 'User_Status', 'Last_Login_Date', 'Created_At', 'Record_Status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'Created_At';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
