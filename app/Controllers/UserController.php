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
        try {
            $data = $this->userAccounts->select('User_ID, Firstname, Lastname, User_Role, User_Status, Image')->findAll();
            $baseUrl = 'http://livestockbackend.test/orminlivestock/livestockbackend/';
    
            foreach ($data as &$account) {
                $account['Image'] = $baseUrl . 'uploads/' . $account['Image'];
                $account['fullname'] = "{$account['Firstname']} {$account['Lastname']}"; // Fix: Change $data to $account
            }
    
            return $this->respond($data, 200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()], 500); // Fix: Add HTTP status code 500 for server error
        }
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
            'User_Role' => $json->User_Role,
        ];

        $result = $this->userAccounts->save($data);

        return $this->respond($result,200);
    }

    public function registerUserAccount(){
        try {
            
            $file = $this->request->getFile('file');
            $newName = $file->getRandomName();

            $rules = [
                'Username' => ['rules' => 'required|min_length[4]|max_length[255]'],
                'Password' => ['rules' => 'required|min_length[8]|max_length[255]'],
                'Email' => ['rules' => 'min_length[6]|max_length[255]|valid_email'],
                'Firstname' => ['rules' => 'required|max_length[255]'],
                'Middlename' => ['rules' => 'max_length[255]'],
                'Lastname' => ['rules' => 'required|max_length[255]'],
                'Date_Of_Birth' => ['rules' => 'valid_date'], // You may need a custom rule for date validation.
                'Gender' => ['rules' => 'required|in_list[Male,Female,Other]'],
                'Civil_Status' => ['rules' => 'required|in_list[Single,Married,Widowed,Divorced]'],
                'Sitio' => ['rules' => 'max_length[255]'],
                'Barangay' => ['rules' => 'required|max_length[255]'],
                'City' => ['rules' => 'required|max_length[255]'],
                'Province' => ['rules' => 'required|max_length[255]'],
                'Phone_Number' => ['rules' => 'max_length[11]'], // Adjust max length as needed.
            ];
            
            if($this->validate($rules)){
                // Get the input data using the request object
                $userRole = $this->request->getVar('User_Role');

                if ($file->isValid() && !$file->hasMoved())
                {
                    if ($file->isValid() && !$file->hasMoved())
                    {
                        $data = [
                            'Username' => $this->request->getVar('Username'),
                            'Password' => password_hash($this->request->getVar('Password'), PASSWORD_DEFAULT),
                            'Email' => $this->request->getVar('Email'),
                            'Firstname' => $this->request->getVar('Firstname'),
                            'Middlename' => $this->request->getVar('Middlename'),
                            'Lastname' => $this->request->getVar('Lastname'),
                            'Date_Of_Birth' => $this->request->getVar('Date_Of_Birth'),
                            'Gender' => $this->request->getVar('Gender'), // 'Male' or 'Female' or 'Other'
                            'Civil_Status' => $this->request->getVar('Civil_Status'), // 'Single','Married','Widowed', or 'Divorced'
                            'Sitio' => $this->request->getVar('Sitio'),
                            'Barangay' => $this->request->getVar('Barangay'),
                            'City' => $this->request->getVar('City'),
                            'Province' => $this->request->getVar('Province'),
                            'Phone_Number' => $this->request->getVar('Phone_Number'),
                            'User_Role' => $userRole,
                            'Image' => $newName
                        ];

                        $key = getenv('JWT_SECRET');
                
                        $payload = array(
                            "iss" => "Livestock Outlook",
                            "aud" => $data['User_Role'],
                            "sub" => "Livestock Monitoring System",
                            "email" => $data['Email'],
                            "username" => $data['Username'],
                            "password" => $data['Password'],
                        );

                        $token = JWT::encode($payload, $key, 'HS256');

                        $data['User_Token'] = $token;

                        $file->move('./uploads', $newName);

                        $this->userAccounts->save($data);

                        $userID = $this->getUserLastID();

                        if($userRole === 'DA Personnel'){
                            $position = $this->request->getVar('Position');
                            $division = $this->request->getVar('Division');
                            $this->addDAPersonnel($userID, $position, $division);
                        }else{
                            $yearsFarming = $this->request->getVar('YearsFarming');
                            $this->addFarmerProfile($userID,$yearsFarming);
                        }
                    
                        return $this->respond(['message' => 'Registered Successfully'],200);
                    } else {
                        return $this->response->setStatusCode(400)->setJSON(['error' => $file->getErrorString()]);
                    }
                    
                }else{
                    $response = [
                        'errors' => $this->validator->getErrors(),
                        'message' => 'Invalid Inputs'
                    ];
                    return $this->respond($response );
                }
            }
        }catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function getUserLastID() {
        $lastUserID = $this->userAccounts->selectMax('User_ID')->get()->getRow();

        if ($lastUserID) {
            $lastID = $lastUserID->User_ID;
            return $lastID;
        } else {
            return 0;
        }
    }

    private function addFarmerProfile($userID, $yearsFarming){
        $data = [
            "User_ID" => $userID,
            "Years_Of_Farming" => $yearsFarming,
        ];
        $this->farmerProfiles->save($data);
    }

    private function addDAPersonnel($userID, $position, $division){
        $data = [
            "User_ID" => $userID,
            "Position" => $position,
            "Division" => $division
        ];

        $this->daPersonnels->save($data);
    }

    public function loginAuth(){
        try {
            $session = session();
    
            $username = $this->request->getVar('Username');
            $password = $this->request->getVar('Password');
    
            $user = $this->userAccounts->where('Username', $username)->first();
            $error = [
                'login' => false,
                'error' => 'Invalid username or password.'
            ];
    
            if(is_null($user)) {
                return $this->respond($error);
            }

            

            $pwd_verify = password_verify($password, $user['Password']);
    
            if(!$pwd_verify) {
                return $this->respond($error);
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
                "userid" => $user['User_ID']
            );
            
            $token = JWT::encode($payload, $key, 'HS256');
    
            $response = [
                'login' => true,
                'message' => 'Login Succesful',
                'token' => $token
            ];
            
            return $this->respond($response, 200);
        } catch (\Throwable $e) {
            //throw $th;
            return $this->respond(["error" => "Error: " . $e->getMessage()],);
        }
    }

    public function editFarmerProfile() {
        try {
            $json = $this->request->getJSON();
    
            $userID = $this->request->getVar('User_ID'); // Assuming you use User_ID to identify the user
            $years = $this->request->getVar('Years_Of_Farming');
        
            $data = [
                'Username' => $this->request->getVar('Username'),
                'Password' => password_hash($this->request->getVar('Password'), PASSWORD_DEFAULT),
                'Email' => $this->request->getVar('Email'),
                'Firstname' => $this->request->getVar('Firstname'),
                'Middlename' => $this->request->getVar('Middlename'),
                'Lastname' => $this->request->getVar('Lastname'),
                'Date_Of_Birth' => $this->request->getVar('Date_Of_Birth'),
                'Gender' => $this->request->getVar('Gender'),
                'Civil_Status' => $this->request->getVar('Civil_Status'),
                'Sitio' => $this->request->getVar('Sitio'),
                'Barangay' => $this->request->getVar('Barangay'),
                'City' => $this->request->getVar('City'),
                'Province' => $this->request->getVar('Province'),
                'Phone_Number' => $this->request->getVar('Phone_Number'),
            ];
        
            $result = $this->editFarmerFarmingYears($userID, $years);
        
            $this->userAccounts->where('User_ID', $userID)->set($data)->update();
        
            return $this->respond(["message" => "Updated Successfully"], 200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }
    
    private function editFarmerFarmingYears($userID, $years) {
        try {
            $this->farmerProfiles->where('User_ID', $userID)->update(['Years_Of_Farming' => $years]);
            return "Success"; // or return a success message
        } catch (\Exception $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);// Handle the exception, return an error message, or log it as needed
        }
    }
    


    public function archiveFarmerprofile(){
        try {
            $whereClause =[
                'Farmer_ID' => $this->request->getVar('Farmer_ID')
            ];
    
            $data['Record_Status'] ='Archive';
    
            $this->farmerProfiles->where($whereClause)->set($data)->update();
    
            return $this->respond(['message' => 'Archived Successfully'],200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function getFarmerAccountData($userID){
        try {
            $userAccountData = $this->userAccounts
            ->select('user_accounts.Username, user_accounts.FirstName,
                        user_accounts.MiddleName, user_accounts.Lastname,
                        user_accounts.Date_Of_Birth,user_accounts.Gender,
                        user_accounts.Civil_Status,user_accounts.Sitio,
                        user_accounts.Barangay,user_accounts.City,
                        user_accounts.Province,user_accounts.Phone_Number,
                        user_accounts.Image,user_accounts.User_Role,
                        farmer_profile.Farmer_ID,farmer_profile.Years_Of_Farming,
                        CONCAT(user_accounts.Sitio, ", ", user_accounts.Barangay, ", ", user_accounts.City, ", ", user_accounts.Province) as Address')
            ->join('farmer_profile','farmer_profile.User_ID = user_accounts.User_ID')
            ->where('user_accounts.User_ID',$userID)
            ->get()->getResultArray();

            $baseUrl = 'http://livestockbackend.test/orminlivestock/livestockbackend/';
            $userAccountData[0]['Image'] = $baseUrl . 'uploads/' . $userAccountData[0]['Image'];

            return $this->respond($userAccountData);
        } catch (\Throwable $th) {
            return $this->respond(["message" => "Error: " . $th->getMessage()],);
        }
    }
}
