<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use \Firebase\JWT\JWT;
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
            'Password' => password_hash($json->Password, PASSWORD_DEFAULT),
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

    public function loginAuth(){
        $session = session();
        $json = $this->request->getJSON();

        $username = $json->username;
        $password = $json->password;

        $user = $this->userAccounts->where('Username', $username)->first();

        if(is_null($user)) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }

        $pwd_verify = password_verify($password, $user['Password']);

        if(!$pwd_verify) {
            return $this->respond(['error' => 'Invalid username or password.'], 401);
        }

        $key = getenv('JWT_SECRET');
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;

        $payload = array(
            "iss" => "Livestock Outlook",
            "aud" => $user['User_Role'],
            "sub" => "Livestock Monitoring System",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $user['Email'],
        );
        
        $token = JWT::encode($payload, $key, 'HS256');

        $response = [
            'message' => 'Login Succesful',
            'token' => $token
        ];
        
        return $this->respond($response, 200);
    }
}
