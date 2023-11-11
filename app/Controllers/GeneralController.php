<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\FarmerLivestocksModel;
use App\Models\LivestocksModel;
use App\Models\UserAccountModel;
use App\Models\LivestockMortalitiesModel;
use App\Models\LivestockTypesModel;
use App\Models\LivestockBreedModel;

class GeneralController extends ResourceController
{
    private $farmerlivestocks;
    private $livestocks;
    private $userAccount;
    private $livestockMortalities;
    private $livestockTypes;
    private $livestockBreeds;

    public function __construct() {
        $this->farmerlivestocks = new FarmerLivestocksModel();
        $this->livestocks = new LivestocksModel();
        $this->userAccount = new UserAccountModel();
        $this->livestockMortalities = new LivestockMortalitiesModel();
        $this->livestockTypes = new LivestockTypesModel();
        $this->livestockBreeds = new LivestockBreedModel();
    }

    public function getLivestockTypes(){
        try {
            $livestockTypes = $this->livestockTypes->select('Type_Name')->distinct()->findAll();
            return $this->respond($livestockTypes,200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function getLivestockBreeds($livestockType){
        try {
            $livestockBreeds = $this->livestockBreeds
                ->select('livestock_breeds.Breed_Name')
                ->join('livestock_types','livestock_types.LT_ID = livestock_breeds.LT_ID')
                ->where('livestock_types.Type_Name',$livestockType)
                ->findAll();
            return $this->respond($livestockBreeds,200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }
}
