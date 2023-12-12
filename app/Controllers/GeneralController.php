<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FarmerProfilesModel;
use CodeIgniter\RESTful\ResourceController;
use App\Models\FarmerLivestocksModel;
use App\Models\LivestocksModel;
use App\Models\UserAccountModel;
use App\Models\LivestockMortalitiesModel;
use App\Models\LivestockTypesModel;
use App\Models\LivestockBreedModel;
use App\Models\LivestockAgeClassificationModel;

class GeneralController extends ResourceController
{
    private $farmerlivestocks;
    
    private $livestocks;
    private $userAccount;
    private $livestockMortalities;
    private $livestockTypes;
    private $livestockBreeds;
    private $livestockAgeClassification;

    private $farmerProfiles;

    public function __construct() {
        $this->farmerlivestocks = new FarmerLivestocksModel();
        $this->livestocks = new LivestocksModel();
        $this->userAccount = new UserAccountModel();
        $this->livestockMortalities = new LivestockMortalitiesModel();
        $this->livestockTypes = new LivestockTypesModel();
        $this->livestockBreeds = new LivestockBreedModel();
        $this->livestockAgeClassification = new LivestockAgeClassificationModel();
        $this->farmerProfiles = new FarmerProfilesModel();
    }

    public function getLivestockTypes(){
        try {
            $livestockTypes = $this->livestockTypes
                ->select('Type_Name')
                ->distinct()
                ->get()
                ->getResultArray();

            // Extract the 'Type_Name' values into a simple array
            $typeNames = array_column($livestockTypes, 'Type_Name');

            return $this->respond($typeNames,200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function getLivestockBreed($livestockType){
        try {
            $livestockBreeds = $this->livestockBreeds
                ->select('livestock_breeds.Breed_Name')
                ->join('livestock_types','livestock_types.LT_ID = livestock_breeds.LT_ID')
                ->where('livestock_types.Type_Name',$livestockType)
                ->get()
                ->getResultArray();

            $breeds = array_column($livestockBreeds, 'Breed_Name');

            return $this->respond($breeds,200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function getLivestockAgeClass($livestockType){
        try {
            $livestockAgeClass = $this->livestockAgeClassification
                ->select('livestock_age_classification.Age_Classification_Name')
                ->join('livestock_types','livestock_types.LT_ID = livestock_age_classification.LT_ID')
                ->where('livestock_types.Type_Name',$livestockType)
                ->get()
                ->getResultArray();

            $ageClass = array_column($livestockAgeClass, 'Age_Classification_Name');

            return $this->respond($ageClass,200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function getFarmerNames(){
        try {
            $farmers = $this->farmerProfiles
                ->select('farmer_profile.Farmer_ID as itemID,
                CONCAT(user_accounts.FirstName, " ", user_accounts.LastName) as itemName,')
                ->join('user_accounts', 'user_accounts.User_ID = farmer_profile.User_ID')
                ->findAll();
            return $this->respond($farmers);
        } catch (\Throwable $th) {
            return $this->respond(["message" => "Error: " . $th->getMessage()]);
        }
    }

    public function importCsvToDbLivestock()
    {
        try {
            $farmerID = $this->request->getVar('userId');

            $input = $this->validate([
                'file' => 'uploaded[file]|ext_in[file,csv],'
            ]);
            if (!$input) {
                $data['validation'] = $this->validator;
                return view('index', $data); 
            }else{
                if($file = $this->request->getFile('file')) {
                if ($file->isValid() && ! $file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('../public/csvfile', $newName);
                    $file = fopen("../public/csvfile/".$newName,"r");
                    $i = 0;
                    $csvArr = array();
                    
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        if($i > 0){ 
                            $csvArr[$i]['Livestock_TagID'] = trim($filedata[0]);
                            $csvArr[$i]['Livestock_Type'] = trim($filedata[1]);
                            $csvArr[$i]['Breed_Name'] = trim($filedata[2]);
                            $csvArr[$i]['Age_Classification'] = trim($filedata[3]);
                            $csvArr[$i]['Age_Days'] = trim($filedata[4]);
                            $csvArr[$i]['Age_Weeks'] = trim($filedata[5]);
                            $csvArr[$i]['Age_Months'] = trim($filedata[6]);
                            $csvArr[$i]['Age_Years'] = trim($filedata[7]);
                            $csvArr[$i]['Sex'] = trim($filedata[8]);
                            $csvArr[$i]['Breeding_Eligibility'] = trim($filedata[9]);
                            $csvArr[$i]['Date_Of_Birth'] = trim($filedata[10]);
                            $csvArr[$i]['Livestock_Status'] = trim($filedata[11]);
                            $csvArr[$i]['Record_Status'] = trim($filedata[12]);
                        }
                        $i++;
                    }
                    fclose($file);
                    $count = 0;
                    foreach($csvArr as $livestockData){
                        // $this->livestocks->save($livestockData);
                        $count++;
                    }
    
                    return $this->respond(['message'=>$count.' rows successfully added.',$csvArr,$farmerID]);
                }
                else{
                    return $this->respond(['message'=>' CSV file coud not be imported.']);
                }
                }else{
                    return $this->respond(['message'=>' CSV file coud not be imported.']);
                }
            }
        } catch (\Throwable $th) {
            return $this->respond(['message'=>'error: '.$th->getMessage()]);
        }     
    }
}
