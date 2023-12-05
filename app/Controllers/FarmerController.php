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
use App\Libraries\HistoryLibrary;
use App\Models\FarmerDataHistoryModel;

class FarmerController extends ResourceController
{
    private $farmerlivestocks;
    private $livestocks;
    private $userAccount;
    private $livestockMortalities;
    private $livestockTypes;
    private $livestockBreeds;
    private $farmerDataHistory;
    private $dataHistory;

    public function __construct() {
        $this->farmerlivestocks = new FarmerLivestocksModel();
        $this->livestocks = new LivestocksModel();
        $this->userAccount = new UserAccountModel();
        $this->livestockMortalities = new LivestockMortalitiesModel();
        $this->livestockTypes = new LivestockTypesModel();
        $this->livestockBreeds = new LivestockBreedModel();
        $this->farmerDataHistory = new HistoryLibrary();
        $this->dataHistory = new FarmerDataHistoryModel();
    }

    public function addLivestock(){
        try {
            $farmerID = $this->request->getVar('Farmer_ID');
            $acquiredDate = $this->request->getVar('Acquired_Date');
            
            $livestockType = $this->request->getVar('Livestock_Type');
            $data = [
                'Livestock_Type' => $livestockType,
                'Livestock_TagID'=>$this->request->getVar('Livestock_TagID'),
                'Breed_Name' => $this->request->getVar('Breed_Name'),
                'Age_Classification' => $this->request->getVar('Age_Classification'),
                'Age_Days' => $this->request->getVar('Age_Days'),
                'Age_Weeks' => $this->request->getVar('Age_Weeks'),
                'Age_Months' => $this->request->getVar('Age_Months'),
                'Age_Years' => $this->request->getVar('Age_Years'),
                'Sex' => $this->request->getVar('Sex'),
                'Breeding_Eligibility' => $this->request->getVar('Breeding_Eligibility'),
                'Date_Of_Birth' => $this->request->getVar('Date_Of_Birth'),
            ];

            $result = $this->livestocks->save($data);

            if ($result) {
                $lastLivestockID = $this->getLivestockLastID();

                $this->associateLivestock($farmerID, $lastLivestockID, $acquiredDate);

                $livestockType = $this->request->getVar('Livestock_Type');
                
                $historyData = [
                    'Title' => 'Added New Livestock',
                    'Description' => "Added a new {$livestockType}",
                    'Farmer_ID' => $farmerID,
                    'Livestock_ID' => "{$lastLivestockID}",
                    'Type' => 'Livestock',
                    'Action' => 'Add'
                ];

                $response = $this->farmerDataHistory->addDataHistory($historyData);

                return $this->respond(['message' => 'Added Successfully',$historyData, $response], 200);
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

    public function associateLivestock($farmerID,$livestockID,$acquiredDate){
        $data = [
            'Farmer_ID' => $farmerID,
            'Livestock_ID' => $livestockID,
            'Acquired_Date' => $acquiredDate,
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
        $livestockID = $this->request->getVar('Livestock_ID');

        $whereClause = [
            'Livestock_ID' => $livestockID
        ];

        $farmerID = $this->request->getVar('Farmer_ID');
        $livestockTagID = $this->request->getVar('LivestockTagID');

        $data = [
            'Livestock_Type' => $this->request->getVar('livestockType'),
            'Livestock_TagID'=> $livestockTagID,
            'Breed_Name' => $this->request->getVar('breed'),
            'Age_Classification' => $this->request->getVar('ageClass'),
            'Sex' => $this->request->getVar('sex'),
            'Breeding_Eligibility' => $this->request->getVar('Breeding_Eligibility'),
        ];

        $historyData = [
            'Title' => 'Edit Livestock Record',
            'Description' => "Edited a livestock details of {$livestockTagID}",
            'Farmer_ID' => $farmerID,
            'Livestock_ID' => $livestockID,
            'Type' => 'Livestock',
            'Action' => 'Edit'
        ];

        $response = $this->farmerDataHistory->addDataHistory($historyData);

        $this->livestocks->where($whereClause)->set($data)->update();

        return $this->respond(['message' => 'Updated Successfully'],200);
    }


    public function archiveLivestockRecord(){
        $livestockID = $this->request->getVar('Livestock_ID');

        $whereClause = [
            'Livestock_ID' => $livestockID
        ];

        $farmerID = $this->request->getVar('Farmer_ID');
        $livestockTagID = $this->request->getVar('LivestockTagID');

        $historyData = [
            'Title' => 'Archive Livestock Record',
            'Description' => "Archived the livestock record of {$livestockTagID}",
            'Farmer_ID' => $farmerID,
            'Livestock_ID' => $livestockID,
            'Type' => 'Livestock',
            'Action' => 'Archive'
        ];

        $response = $this->farmerDataHistory->addDataHistory($historyData);

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
            $whereClause = [
                'farmerlivestocks.Farmer_ID' => $farmerID,
                'livestocks.Livestock_Status' => 'Alive',
                'livestocks.Record_Status' => 'Accessible'
            ];

            $livestockRecords = $this->livestocks
                ->select('livestocks.Livestock_ID, 
                        livestocks.Livestock_TagID as LivestockTagID, 
                        livestocks.Livestock_Type as livestockType, 
                        livestocks.Breed_Name as breedName, 
                        livestocks.Age_Classification as ageClass,
                        livestocks.Age_Days,
                        livestocks.Age_Weeks,
                        livestocks.Age_Months,
                        livestocks.Age_Years,
                        livestocks.Sex as sex,
                        livestocks.Breeding_Eligibility,
                        livestocks.Date_Of_Birth, 
                        farmerlivestocks.Acquired_Date,
                        CASE
                            WHEN livestocks.Age_Days > 0 THEN CONCAT(livestocks.Age_Days, " days")
                            WHEN livestocks.Age_Weeks > 0 THEN CONCAT(livestocks.Age_Weeks, " weeks")
                            WHEN livestocks.Age_Months > 0 THEN CONCAT(livestocks.Age_Months, " months")
                            WHEN livestocks.Age_Years > 0 THEN CONCAT(livestocks.Age_Years, " years")
                            ELSE "Unknown Age"
                        END as age')
                ->join('farmerlivestocks','livestocks.Livestock_ID = farmerlivestocks.Livestock_ID')
                ->where($whereClause)
                ->findAll();
            if($livestockRecords){
                return $this->respond($livestockRecords, 200);
            }else{
                return $this->respond([]);
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
            $livestockID = $this->request->getVar('livestockID');

            $farmerID = $this->request->getVar('Farmer_ID');
            $data = [
                'Farmer_ID' => $farmerID,
                'Livestock_ID' => $livestockID,
                'Cause_Of_Death' => $this->request->getVar('causeOfDeath'),
                'Date_Of_Death' => $this->request->getVar('dateOfDeath'),
            ];
            $res = $this->updateLivestockHealth($livestockID);
            $this->livestockMortalities->save($data);

            $livestockTagID = $this->request->getVar('LivestockTagID');

            $historyData = [
                'Title' => 'Report Livestock Mortality',
                'Description' => "Report mortality record of {$livestockTagID}",
                'Farmer_ID' => $farmerID,
                'Livestock_ID' => $livestockID,
                'Type' => 'Mortality',
                'Action' => 'Add'
            ];
    
            $response = $this->farmerDataHistory->addDataHistory($historyData);

            return $this->respond(['message' => 'Record Successfully Added',$res],200);
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()],200);
        }
    }

    private function updateLivestockHealth($livestockID){
        try {
            $data['Livestock_Status'] = 'Dead';

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

    public function getFarmerDataHistory($farmerID){
        try {
            $whereNotInClause = ['Delete','Archive'];
            $dataHistory = $this->dataHistory
                ->select('Title,Description,Type,Timestamp')
                ->where('Farmer_ID',$farmerID)
                ->whereNotIn('Action',$whereNotInClause)
                ->findAll();
            
            return $this->respond($dataHistory);
        } catch (\Throwable $th) {
            return $this->respond(["message" => "Error: " . $th->getMessage()]);
        }
    }

  public function getDataHistory(){
    try {
        $dataHistory = $this->dataHistory
            ->select('farmer_data_history.FDH_ID,
            farmer_data_history.Title,
            farmer_data_history.Description,
            farmer_data_history.Type,
            farmer_data_history.Livestock_ID,
            farmer_data_history.Action,
            farmer_data_history.Farmer_ID,
            farmer_data_history.Timestamp,
            livestocks.Livestock_TagID,
            livestocks.Livestock_Type,
            CONCAT(user_accounts.Firstname, " ", user_accounts.Lastname) as FarmerName,')
        ->join('livestocks','livestocks.Livestock_ID = farmer_data_history.Livestock_ID')
        ->join('farmer_profile','farmer_profile.Farmer_ID = farmer_data_history.Farmer_ID')
        ->join('user_accounts','user_accounts.User_ID = farmer_profile.User_ID')
        ->findAll();
        
    return $this->respond($dataHistory);
    } catch (\Throwable $th) {
        return $this->respond(["message" => "Error: " . $th->getMessage()]);
    }
  }  
}