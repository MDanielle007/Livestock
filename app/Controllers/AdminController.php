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

class AdminController extends ResourceController
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

    public function addLivestockType(){
        try {
            $data = [
                'Type_Name' => $this->request->getVar('Type_Name'),
                'Livestock_Uses' => $this->request->getVar('Livestock_Uses')
            ];
            $this->livestockTypes->save($data);
    
            return $this->respond(['message' => 'Added Successfully'], 200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function editLivestockType(){
        try {
            $typeID = $this->request->getVar('LT_ID');

            $data = [
                'Type_Name' => $this->request->getVar('Type_Name'),
                'Livestock_Uses' => $this->request->getVar('Livestock_Uses')
            ];

            $this->livestockTypes->where('LT_ID',$typeID)->set($data)->update();
    
            return $this->respond(['message' => 'Update Successfully'], 200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function removeLivestockType(){
        try {
            $typeID = $this->request->getVar('LT_ID');

            $this->livestockTypes->where('LT_ID',$typeID)->delete();
    
            return $this->respond(['message' => 'Removed Successfully'], 200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function addLivestockBreed(){
        try {
            $typeID = $this->request->getVar('LT_ID');

            $data = [
                'Breed_Name' => $this->request->getVar('Breed_Name'),
                'Breed_Name_Tagalog' => $this->request->getVar('Breed_Name_Tagalog'),
                'Breed_Description' => $this->request->getVar('Breed_Description'),
                'LT_ID' => $typeID,
            ];

            $this->livestockBreeds->save($data);
    
            return $this->respond(['message' => 'Added Successfully'], 200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function editLivestockBreed(){
        try {
            $breedID = $this->request->getVar('Breed_ID');

            $data = [
                'Breed_Name' => $this->request->getVar('Breed_Name'),
                'Breed_Name_Tagalog' => $this->request->getVar('Breed_Name_Tagalog'),
                'Breed_Description' => $this->request->getVar('Breed_Description')
            ];

            $this->livestockBreeds->where('Breed_ID',$breedID)->set($data)->update();
    
            return $this->respond(['message' => 'Update Successfully'], 200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function removeLivestockBreed(){
        try {
            $breedID = $this->request->getVar('Breed_ID');

            $this->livestockBreeds->where('Breed_ID',$breedID)->delete();
    
            return $this->respond(['message' => 'Removed Successfully'], 200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }
}
