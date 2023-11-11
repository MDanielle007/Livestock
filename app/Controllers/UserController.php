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
            'User_Role' => $json->User_Role,
        ];

        $result = $this->userAccounts->save($data);

        return $this->respond($result,200);
    }

    public function registerFarmer(){
        helper(['form']);
        $rules = [
            'Username' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'Password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'Email' => ['rules' => 'required|min_length[6]|max_length[255]|valid_email'],
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

        // $validation = \Config\Services::validation();

        // $validation->setRules($rules);

        // return $this->respond($validation,200);
        
        if($this->validate($rules)){
            // Get the input data using the request object
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
                'User_Role' => $this->request->getVar('User_Role'),
            ];

            $this->userAccounts->save($data);

            $userID = $this->getUserLastID();
            $yearsFarming = $this->request->getVar('YearsFarming');

            $this->addFarmerProfile($userID,$yearsFarming);
            
            return $this->respond(['message' => 'Registered Successfully'],200);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->respond($response );
        }
    }

    public function getUserLastID() {
        // Use CodeIgniter Query Builder to get the maximum Livestock_ID.
        $lastUserID = $this->userAccounts->selectMax('User_ID')->get()->getRow();

        // Check if a result is found.
        if ($lastUserID) {
            $lastID = $lastUserID->User_ID;
            return $lastID;
        } else {
            return 0;
        }
    }

    private function addFarmerProfile($userID, $yearsFarming = 0){
        $data = [
            "User_ID" => $userID,
            "Years_Of_Farming" => $yearsFarming,
        ];
        $this->farmerProfiles->save($data);
    }

    public function loginAuth(){
        try {
            //code...
            $session = session();
            $json = $this->request->getJSON();
    
            $username = $json->Username;
            $password = $json->Password;
    
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
        } catch (\Throwable $e) {
            //throw $th;
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
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

    

    //edit user acc
    //kuha ng id tas ilagay mo sa isang variable
    //kuhanin mo rin yung ibang data ilagay mo sya sa isang $data
    // $this->userAccoun->where('User_ID',$id)->update($data)
    //  return $this->respond(['message' => 'Updated Successfully'],200);

    //archiving user
    //kuha ng id tas ilagay mo sa isang variable
    //$data['RecordStatus'] = "Archive"

}
