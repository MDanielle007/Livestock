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

class FarmerController extends ResourceController
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

    public function addLivestock(){
        try {
            $farmerID = $this->request->getVar('Farmer_ID');
            $acquiredDate = $this->request->getVar('Acquired_Date');
            $ownershipStatus = $this->request->getVar('OwnershipStatus');

            $data = [
                'Livestock_Type' => $this->request->getVar('Livestock_Type'),
                'Breed_Name' => $this->request->getVar('Breed_Name'),
                'Age' => $this->request->getVar('Age'),
                'Sex' => $this->request->getVar('Sex'),
                'Date_Of_Birth' => $this->request->getVar('Date_Of_Birth'),
            ];

            $result = $this->livestocks->save($data);
            if ($result) {
                $lastLivestockID = $this->getLivestockLastID();
        
                $this->associateLivestock($farmerID, $lastLivestockID, $acquiredDate, $ownershipStatus);
                return $this->respond(['message' => 'Added Successfully'], 200);
            } else {
                return $this->respond(['error' => 'Failed to add livestock.'], 500);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function getLivestockLastID() {
        $lastLivestockID = $this->livestocks->selectMax('Livestock_ID')->get()->getRow();

        if ($lastLivestockID) {
            $lastID = $lastLivestockID->Livestock_ID;
            return $lastID;
        } else {
            return 0;
        }
    }

    public function associateLivestock($farmerID = null,$livestockID = null,$acquiredDate = null,$ownershipStatus = null){
        $data = [
            'Farmer_ID' => $farmerID,
            'Livestock_ID' => $livestockID,
            'Acquired_Date' => $acquiredDate,
            'OwnershipStatus' => $ownershipStatus
        ];
        $this->farmerlivestocks->save($data);
    }

    public function editLivestockOwnershipStatus(){
        $data['OwnershipStatus'] = $this->request->getVar('OwnershipStatus');

        $whereClause = [
            'Farmer_ID' => $this->request->getVar('FarmerID'),
            'Livestock_ID' => $this->request->getVar('Livestock')
        ];

        $result = $this->farmerlivestocks->where($whereClause)->update($data);
        return $this->respond(['message' => 'Updated Successfully'], 200);
    }

    public function editLivestockDetails(){
        $whereClause = [
            'Livestock_ID' => $this->request->getVar('Livestock')
        ];

        $data = [
            'Livestock_Type' => $this->request->getVar('Livestock_Type'),
            'Breed_Name' => $this->request->getVar('Breed'),
            'Age' => $this->request->getVar('Age'),
            'Sex' => $this->request->getVar('Sex'),
            'Date_Of_Birth' => $this->request->getVar('Date_Of_Birth'),
        ];

        $this->livestocks->where($whereClause)->set($data)->update();

        return $this->respond(['message' => 'Updated Successfully'],200);
    }

    public function archiveLivestockRecord(){
        $whereClause = [
            'Livestock_ID' => $this->request->getVar('Livestock_ID'),
        ];

        $data['Record_Status'] = 'Archive';

        $updatedRows = $this->livestocks->where($whereClause)->set($data)->update();

        if ($updatedRows > 0) {
            return $this->respond(['message' => 'Archived Successfully'], 200);
        } else {
            return $this->respond(['message' => 'No matching records found for archiving.'], 404);
        }
    }

    public function getAllFarmerLivestock($farmerID){
        try {
            $livestockRecords = $this->livestocks
                ->select('livestocks.Livestock_ID, 
                        livestocks.Livestock_Type, 
                        livestocks.Breed_Name, livestocks.Age, 
                        livestocks.Sex,livestocks.Date_Of_Birth, 
                        farmerlivestocks.Acquired_Date')
                ->join('farmerlivestocks','livestocks.Livestock_ID = farmerlivestocks.Livestock_ID')
                ->where('farmerlivestocks.Farmer_ID',$farmerID)
                ->findAll();
            if($livestockRecords){
                return $this->respond($livestockRecords, 200);
            }else{
                return $this->respond(null,404);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function getOneLivestock($livestockID){
        try {
            $livestockRecord = $this->livestocks
                ->select('livestocks.Livestock_ID, 
                        livestocks.Livestock_Type, 
                        livestocks.Breed_Name, livestocks.Age, 
                        livestocks.Sex,livestocks.Date_Of_Birth, 
                        farmerlivestocks.Acquired_Date')
                ->join('farmerlivestocks','livestocks.Livestock_ID = farmerlivestocks.Livestock_ID')
                ->where('livestocks.Livestock_ID',$livestockID)
                ->first();
            
            if($livestockRecord){
                return $this->respond($livestockRecord, 200);
            }else{
                return $this->respond(null,404);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function getFarmerProfile(){
        try {
            $farmerID = $this->request->getVar('Farmer_ID');

            $farmerRecord = $this->userAccount
                ->select('user_accounts.*, 
                        farmer_profile.Years_Of_Farming')
                ->join('farmer_profile','user_accounts.User_ID = farmer_profile.User_ID')
                ->where('farmer_profile.Farmer_ID',$farmerID)
                ->first();

            if($farmerRecord){
                return $this->respond($farmerRecord, 200);
            }else{
                return $this->respond(null,404);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function searchFarmerLivestocks(){
        try {
            $farmerID = $this->request->getVar('Farmer_ID');
            $searchTerm = $this->request->getVar('searchTerm');

            $criteria = [
                'Farmer_ID' => $farmerID,
            ];

            if (!empty($searchTerm)) {
                $this->livestocks->groupStart()
                    ->like('Livestock_Type', $searchTerm) 
                    ->orLike('Breed_Name', $searchTerm)
                    ->orLike('Age', $searchTerm)
                    ->groupEnd();
            }

            $foundRecords = $this->livestocks
                ->select('livestocks.Livestock_ID,livestocks.Livestock_Type,livestocks.Breed_Name,
                            livestocks.Age, livestocks.Sex, livestocks.Date_Of_Birth')
                ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID ')
                ->where('farmerlivestocks.Farmer_ID',$farmerID)
                ->findAll();
            
            if ($foundRecords) {
                return $this->respond($foundRecords, 200);
            } else {
                return $this->respond(['message'=>'walang mahanap'],200);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function getFarmerLivestockTypeCount(){
        try {
            $whereClause = [
                'livestocks.Livestock_Type' => $this->request->getVar('Livestock_Type'),
                'farmerlivestocks.Farmer_ID' => $this->request->getVar('Farmer_ID'),
            ];
    
            $livestockCount = $this->livestocks
                ->join('farmerlivestocks', 'farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
                ->where($whereClause)
                ->countAllResults();
    
            return $this->respond($livestockCount, 200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function getLivestockTypeCount(){
        try {
            $whereClause = [
                'farmer_profile.Farmer_ID' => $this->request->getVar('Farmer_ID'),
            ];

            $livestockCount = $this->livestocks
                ->select('livestocks.Livestock_ID')
                ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
                ->join('farmer_profile','farmerlivestocks.Farmer_ID = farmer_profile.Farmer_ID')
                ->where($whereClause)
                ->countAllResults();

            return $this->respond($livestockCount, 200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],);
        }
    }

    public function addLivestockMortality(){
        try {
            $livestockID = $this->request->getVar('Livestock_ID');

            $data = [
                'Livestock_ID' => $livestockID,
                'Cause_Of_Death' => $this->request->getVar('Cause_Of_Death'),
                'Date_Of_Death' => $this->request->getVar('Date_Of_Death'),
            ];
            $res = $this->updateLivestockHealth($livestockID);
            $this->livestockMortalities->save($data);
            return $this->respond(['message' => 'Record Successfully Added',$res],200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],200);
        }
    }

    private function updateLivestockHealth($livestockID){
        try {
            $data['Health_Status'] = 'Dead';

            $updatedRows = $this->livestocks->where('Livestock_ID',$livestockID)->set($data)->update();

            if ($updatedRows > 0) {
                return ['message' => 'Updated Successfully'];
            } else {
                return ['message' => 'No matching records found for updating.'];
            }
        } catch (\Throwable $e) {
            return ["message" => "Error: " . $e->getMessage()]  ;
        }
    }

    public function fetchFarmerLivestockMortalityRecords($farmerID = 0){
        try {
            // $farmerID = $this->request->getVar('Farmer_ID');

            $mRecords = $this->livestockMortalities
                ->join('livestocks','livestocks.Livestock_ID = livestock_mortalities.Livestock_ID')
                ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
                ->join('farmer_profile','farmer_profile.Farmer_ID = farmer_profile.Farmer_ID')
                ->where('farmer_profile.Farmer_ID',$farmerID)
                ->countAllResults();
            
            return $this->respond($mRecords,200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

}
