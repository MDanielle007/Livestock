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
}
