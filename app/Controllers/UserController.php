<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\DAPersonnelsModel;
use App\Models\FarmerProfilesModel;
use App\Models\UserAccountModel;

class UserController extends ResourceController
{
    private $daPersonnels;
    private $userAccounts;
    private $farmerProfiles;


    public function index()
    {
        //
    }

    public function __construct() {
        $this->userAccounts = new UserAccountModel();
        $this->farmerProfiles = new FarmerProfilesModel();
        $this->daPersonnels = new DAPersonnelsModel();
    }

    public function getUserAccounts(){
        $data = $this->userAccounts->select('User_ID, Firstname, Lastname,User_Role,User_Status,Image')->findAll();
        return $this->respond($data,200);
    }

    public function register()
    {
        $json = $this->request->getJSON();
        // Get the input data using the request object
        $data = [
            'Username' => $json->Username,
            'Password' => $json->Password,
            'Email' => $json->Email,
            'Firstname' => $json->Firstname,
            'Middlename' => $json->Middlename,
            'Lastname' => $json->Lastname,
            'Date_Of_Birth' => $json->Date_Of_Birth,
            'Gender' => $json->Gender,
            'Civil_Status' => $json->Civil_Status,
            'Sitio' => $json->Sitio,
            'Barangay' => $json->Barangay,
            'City' => $json->City,
            'Province' => $json->Province,
            'Phone_Number' => $json->Phone_Number,
        ];

        $result = $this->userAccounts->save($data);

        return $this->respond($result,200);
    }
}
