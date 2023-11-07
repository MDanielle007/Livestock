<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\FarmerLivestocksModel;
use App\Models\LivestocksModel;
//kung yung Model na kailangan mo di to ay wala idagdag mo na lang
use App\Models\UserAccountModel;

class FarmerController extends ResourceController
{
    private $farmerlivestocks;
    private $livestocks;
    private $userAccount;

    public function __construct() {
        $this->farmerlivestocks = new FarmerLivestocksModel();
        $this->livestocks = new LivestocksModel();
        //gawin mo yung ganito para magamit mo yung model na yung sa ibang function
        $this->userAccount = new UserAccountModel();
    }

    public function addLivestock(){
        $farmerID = $this->request->getVar('Farmer_ID');
        $acquiredDate = $this->request->getVar('Acquired_Date');
        $ownershipStatus = $this->request->getVar('OwnershipStatus');

        $data = [
            'Livestock_Type' => $this->request->getVar('Livestock_Type'),
            'Breed' => $this->request->getVar('Breed'),
            'Age' => $this->request->getVar('Age'),
            'Sex' => $this->request->getVar('Sex'),
            'Date_Of_Birth' => $this->request->getVar('Date_Of_Birth'),
        ];

        $result = $this->livestocks->save($data);
        if ($result) {
                // Get the last Livestock_ID using the method.
                $lastLivestockID = $this->getLivestockLastID();
        
                // Associate the livestock with the farmer.
                $this->associateLivestock($farmerID, $lastLivestockID, $acquiredDate, $ownershipStatus);
        
                // Return the last Livestock_ID as a response.
                return $this->respond(['Livestock_ID' => $lastLivestockID], 200);
            } else {
                return $this->respond(['error' => 'Failed to add livestock.'], 500);
            }
            return $this->respond($lastLivestockID,200);
    }

    public function getLivestockLastID() {
        // Use CodeIgniter Query Builder to get the maximum Livestock_ID.
        $lastLivestockID = $this->livestocks->selectMax('Livestock_ID')->get()->getRow();

        // Check if a result is found.
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
        return $this->respond($result,200);
    }

    public function editLivestockDetails(){
        $whereClause = [
            'Livestock_ID' => $this->request->getVar('Livestock')
        ];

        // $record = $this->livestocks->where($whereClause)->findAll();

        $data = [
            'Livestock_Type' => $this->request->getVar('Livestock_Type'),
            'Breed' => $this->request->getVar('Breed'),
            'Age' => $this->request->getVar('Age'),
            'Sex' => $this->request->getVar('Sex'),
            'Date_Of_Birth' => $this->request->getVar('Date_Of_Birth'),
        ];

        $this->livestocks->where($whereClause)->set($data)->update();

        return $this->respond(['message' => 'Updated Successfully',$whereClause,$data],200);
    }

    public function archiveLivestockRecord(){
        // Define the where clause to find the specific record to archive.
        $whereClause = [
            'Livestock_ID' => $this->request->getVar('Livestock_ID'),
        ];

        // Define the data to update, setting the Record_Status to 'Archive'.
        $data['Record_Status'] = 'Archive';

        // Use the model's update method with the where clause to update the record.
        $updatedRows = $this->livestocks->where($whereClause)->set($data)->update();

        if ($updatedRows > 0) {
            // Check if any records were updated. If so, consider it a success.
            return $this->respond(['message' => 'Archived Successfully'], 200);
        } else {
            // No records were updated, so return an error message.
            return $this->respond(['message' => 'No matching records found for archiving.'], 404);
        }
    }

    //Gawa ka muna ng Function 
    public function getAllFarmerLivestock($farmerID){
        //kuhanin muna yung mga kailangan na data galing sa Vue

        $livestockRecords = $this->livestocks // gamitin mo yung model para ma-fetch yung mga data sa database
            ->select('livestocks.Livestock_ID, 
                    livestocks.Livestock_Type, 
                    livestocks.Breed, livestocks.Age, 
                    livestocks.Sex,livestocks.Date_Of_Birth, 
                    farmerlivestocks.Acquired_Date') // select mo yung mga kailangan na data mo
            ->join('farmerlivestocks','livestocks.Livestock_ID = farmerlivestocks.Livestock_ID') // join mo yung mga table na kailangan ipag join
            ->where('farmerlivestocks.Farmer_ID',$farmerID) // gawa ka ng where clause para ang makuha data ay specific lang 
            ->findAll(); // fetch mo na yung mga data

        // Check mo kung may mga nakuha kang records
        if($livestockRecords){
            // kung meron, i-return mo yung mga nakuha mong records
            return $this->respond($livestockRecords, 200);
        }else{
            return $this->respond(null,404); // mag return ka na lang ng null kung wala kang nakuha
        }
    }

    public function getOneLivestock($farmerID,$livestockID){
        $livestockRecord = $this->livestocks
            ->select('livestocks.Livestock_ID, 
                    livestocks.Livestock_Type, 
                    livestocks.Breed, livestocks.Age, 
                    livestocks.Sex,livestocks.Date_Of_Birth, 
                    farmerlivestocks.Acquired_Date')
            ->join('farmerlivestocks','livestocks.Livestock_ID = farmerlivestocks.Livestock_ID')
            ->where('farmerlivestocks.Farmer_ID',$farmerID)
            ->where('livestocks.Livestock_ID',$livestockID)
            ->first();
        
        if($livestockRecord){
            return $this->respond($livestockRecord, 200);
        }else{
            return $this->respond(null,404);
        }
    }

    public function getFarmerProfile(){
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
    }

    public function searchLivestocks($farmerID){
        $searchTerm = $this->request->getVar('searchTerm');

        $criteria = [
            'Farmer_ID' => $farmerID,
        ];

        if (!empty($searchTerm)) {
            $this->livestocks->groupStart()
                ->like('Livestock_Type', $searchTerm) 
                ->orLike('Breed', $searchTerm)
                ->orLike('Age', $searchTerm)
                ->groupEnd();
        }

        $foundRecords = $this->livestocks
            ->where($farmerID)
            ->findAll();
        
        if ($livestockRecords) {
            return $this->respond($livestockRecords, 200);
        } else {
            return $this->respond(null, 404);
        }
    }
}
