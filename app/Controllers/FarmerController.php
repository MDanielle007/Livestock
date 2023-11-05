<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\FarmerLivestocksModel;
use App\Models\LivestocksModel;
//kung yung Model na kailangan mo di to ay wala idagdag mo na lang

class FarmerController extends ResourceController
{
    private $farmerlivestocks;
    private $livestocks;

    public function __construct() {
        $this->farmerlivestocks = new FarmerLivestocksModel();
        $this->livestocks = new LivestocksModel();
        //gawin mo yung ganito para magamit mo yung model na yung sa ibang function
    }

    public function index()
    {
        
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
            return $this->respond("May mali",404); // mag return ka na lang ng null kung wala kang nakuha
        }
    }
}
