<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\FarmerLivestocksModel;
use App\Models\LivestocksModel;
use App\Models\LivestockVaccinationModel;
use App\Models\LivestockMortalitiesModel;
use App\Models\LivestockTypesModel;
use App\Libraries\HistoryLibrary;
use App\Models\FarmerDataHistoryModel;
use App\Models\LivestockBreedingsModel;

class LivestocksController extends ResourceController
{
    private $livestocks;
    private $vaccination;
    private $mortalityRecords;
    private $livestockTypes;
    private $farmerDataHistory;
    private $dataHistory;
    private $livestockBreedings;

    public function __construct(){
        $this->livestocks = new LivestocksModel(); 
        $this->vaccination = new LivestockVaccinationModel();
        $this->mortalityRecords = new LivestockMortalitiesModel();
        $this->livestockTypes = new LivestockTypesModel();
        $this->farmerDataHistory = new HistoryLibrary();
        $this->dataHistory = new FarmerDataHistoryModel();
        $this->livestockBreedings = new LivestockBreedingsModel();
    }

    public function getAllLivestock(){
        try {
            try {
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
                            livestocks.Livestock_Status,
                            CONCAT(user_accounts.FirstName, " ", user_accounts.LastName) as FarmerName,
                            farmerlivestocks.Acquired_Date,
                            CASE
                                WHEN livestocks.Age_Days > 0 THEN CONCAT(livestocks.Age_Days, " days")
                                WHEN livestocks.Age_Weeks > 0 THEN CONCAT(livestocks.Age_Weeks, " weeks")
                                WHEN livestocks.Age_Months > 0 THEN CONCAT(livestocks.Age_Months, " months")
                                WHEN livestocks.Age_Years > 0 THEN CONCAT(livestocks.Age_Years, " years")
                                ELSE "Unknown Age"
                            END as age')
                    ->join('farmerlivestocks', 'livestocks.Livestock_ID = farmerlivestocks.Livestock_ID')
                    ->join('farmer_profile', 'farmer_profile.Farmer_ID = farmerlivestocks.Farmer_ID')
                    ->join('user_accounts', 'user_accounts.User_ID = farmer_profile.User_ID')
                    ->findAll();
    
                if($livestockRecords){
                    return $this->respond($livestockRecords, 200);
                }else{
                    return $this->respond(null,404);
                }
            } catch (\Throwable $e) {
                return $this->respond(["error" => "Error: " . $e->getMessage()],500);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function administerVaccine(){
        try {
            $farmerID = $this->request->getVar('Farmer_ID');
            $livestockID = $this->request->getVar('livestockID');
            $data = [
                'Livestock_ID' => $livestockID,
                'VaccineAdministratorID' => $farmerID,
                'Vaccination_Name' => $this->request->getVar('vaccinationName'),
                'Vaccination_Description' => $this->request->getVar('vaccinationDescription'),
                'Vaccination_Date' => $this->request->getVar('vaccinationDate'),
            ];
            $this->vaccination->save($data);

            
            $livestockTagID = $this->request->getVar('LivestockTagID');

            $historyData = [
                'Title' => 'Administer Vaccine',
                'Description' => "Adminsiter vaccine to {$livestockTagID}",
                'Farmer_ID' => $farmerID,
                'Livestock_ID' => $livestockID,
                'Type' => 'Vaccination',
                'Action' => 'Add'
            ];
    
            $response = $this->farmerDataHistory->addDataHistory($historyData);
    
            return $this->respond(["message" => "Vaccination Recorded Successfully"]);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function getFarmerVaccinationRecords($userID){
        try {
            $whereClause = [
                'farmer_profile.User_ID' => $userID,
                'livestock_vaccinations.Record_Status' => 'Accessible'
            ];

            $vaccinationRecords = $this->vaccination
                ->select('livestock_vaccinations.Vaccination_ID, livestock_vaccinations.Livestock_ID as livestockID, livestock_vaccinations.Vaccination_Name as vaccinationName, livestock_vaccinations.Vaccination_Description as vaccinationDetails, livestock_vaccinations.Vaccination_Date as vaccinationDate,
                livestocks.Livestock_TagID as LivestockTagID, livestocks.Livestock_Type as LivestockType')
                ->join('livestocks','livestocks.Livestock_ID = livestock_vaccinations.Livestock_ID')
                ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
                ->join('farmer_profile','farmer_profile.Farmer_ID = farmerlivestocks.Farmer_ID')
                ->where($whereClause)
                ->findAll();
            return $this->respond($vaccinationRecords);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function getVaccinationRecords(){
        try {
            $whereClause = [
                'livestock_vaccinations.Record_Status' => 'Accessible'
            ];

            $vaccinationRecords = $this->vaccination
                ->select('livestock_vaccinations.Vaccination_ID,
                        livestock_vaccinations.Vaccination_ID as livestockID,
                        livestock_vaccinations.Vaccination_Name as vaccinationName,
                        livestock_vaccinations.Vaccination_Description as vaccinationDetails,
                        livestock_vaccinations.Vaccination_Date as vaccinationDate,
                        livestock_vaccinations.VaccineAdministratorID,
                        livestocks.Livestock_TagID as LivestockTagID,
                        livestocks.Livestock_Type as LivestockType,
                        CONCAT(user_accounts.FirstName, " ", user_accounts.LastName) as VaccineAdministratorName,')
                ->join('livestocks','livestocks.Livestock_ID = livestock_vaccinations.Livestock_ID')    
                ->join('farmer_profile','farmer_profile.Farmer_ID = livestock_vaccinations.VaccineAdministratorID') 
                ->join('user_accounts','user_accounts.User_ID = farmer_profile.User_ID')  
                ->where($whereClause)
                ->findAll();
            return $this->respond($vaccinationRecords);       
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function updateVaccinationRecord(){
        try {
            $vaxID = $this->request->getVar('Vaccination_ID');
            
            $data = [
                'Vaccination_Name' => $this->request->getVar('vaccinationName'),
                'Vaccination_Description' => $this->request->getVar('vaccinationDetails'),
                'Vaccination_Date' => $this->request->getVar('vaccinationDate'),
            ];

            $this->vaccination->where('Vaccination_ID',$vaxID)->set($data)->update();

            $farmerID = $this->request->getVar('Farmer_ID');
            $livestockTagID = $this->request->getVar('LivestockTagID');
            $livestockID = $this->request->getVar('livestockID');

            $historyData = [
                'Title' => 'Edit Vaccination Record',
                'Description' => "Edited a vaccination record of {$livestockTagID}",
                'Farmer_ID' => $farmerID,
                'Livestock_ID' => $livestockID,
                'Type' => 'Vaccination',
                'Action' => 'Edit'
            ];
    
            $response = $this->farmerDataHistory->addDataHistory($historyData);

            return $this->respond(['message' => 'Record Updated Successfully',$response]);
            
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function archiveVaccinationRecord(){
        try {
            $vaxID = $this->request->getVar('Vaccination_ID');

            $data['Record_Status'] = 'Archive';

            $this->vaccination->where('Vaccination_ID',$vaxID)->set($data)->update();

            $farmerID = $this->request->getVar('Farmer_ID');
            $livestockTagID = $this->request->getVar('LivestockTagID');
            $livestockID = $this->request->getVar('livestockID');

            $historyData = [
                'Title' => 'Archive Vaccination Record',
                'Description' => "Archived the vaccination record of {$livestockTagID}",
                'Farmer_ID' => $farmerID,
                'Livestock_ID' => $livestockID,
                'Type' => 'Vaccination',
                'Action' => 'Archive'
            ];
    
            $response = $this->farmerDataHistory->addDataHistory($historyData);

            return $this->respond(['message' => 'Record Archived Successfully']);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function getFarmerMortalityRecords($userID){
        try {
            $whereClause = [
                'livestock_mortalities.Farmer_ID' => $userID,
                'livestock_mortalities.Record_Status' => 'Accessible'
            ];

            $mortalityRecords = $this->mortalityRecords
                ->select('livestock_mortalities.LM_ID, livestock_mortalities.Livestock_ID as LivestockID, livestock_mortalities.Farmer_ID, livestock_mortalities.Cause_Of_Death as causeOfDeath, livestock_mortalities.Date_Of_Death as dateOfDeath,
                    livestocks.Livestock_TagID as LivestockTagID, livestocks.Livestock_Type as LivestockType')
                ->join('livestocks','livestocks.Livestock_ID = livestock_mortalities.Livestock_ID')
                ->join('farmer_profile','farmer_profile.Farmer_ID = livestock_mortalities.Farmer_ID') 
                ->join('user_accounts','user_accounts.User_ID = farmer_profile.User_ID')  
                ->where($whereClause)
                ->findAll();
            return $this->respond($mortalityRecords);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function getLivestockMortalityRecords(){
        try {
            $mortalityRecords = $this->mortalityRecords 
                ->select('livestock_mortalities.LM_ID,
                    livestock_mortalities.Livestock_ID as LivestockID, 
                    livestock_mortalities.Farmer_ID,
                    livestock_mortalities.Cause_Of_Death as causeOfDeath,
                    livestock_mortalities.Date_Of_Death as dateOfDeath,
                    livestocks.Livestock_TagID as LivestockTagID,
                    livestocks.Livestock_Type as LivestockType,
                    CONCAT(user_accounts.Firstname, " ", user_accounts.LastName) as FarmerName,')
                ->join('livestocks','livestocks.Livestock_ID = livestock_mortalities.Livestock_ID')
                ->join('farmer_profile','farmer_profile.Farmer_ID = livestock_mortalities.Farmer_ID')
                ->join('user_accounts','user_accounts.User_ID = farmer_profile.User_ID')
                ->findAll();
            return $this->respond($mortalityRecords);    
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function updateMortalityRecord(){
        try {
            $lmID = $this->request->getVar('LM_ID');

            $data = [
                'Cause_Of_Death' => $this->request->getVar('causeOfDeath'),
                'Date_Of_Death' => $this->request->getVar('dateOfDeath')
            ];

            $this->mortalityRecords->where('LM_ID',$lmID)->set($data)->update();

            $farmerID = $this->request->getVar('Farmer_ID');
            $livestockTagID = $this->request->getVar('LivestockTagID');
            $livestockID = $this->request->getVar('LivestockID');

            $historyData = [
                'Title' => 'Edit Mortality Record',
                'Description' => "Edited a mortality record of {$livestockTagID}",
                'Farmer_ID' => $farmerID,
                'Livestock_ID' => $livestockID,
                'Type' => 'Mortality',
                'Action' => 'Edit'
            ];
    
            $response = $this->farmerDataHistory->addDataHistory($historyData);

            return $this->respond(['message' => 'Record Updated Successfully']);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function archiveMortalityRecord(){
        try {
            $lmID = $this->request->getVar('LM_ID');

            $data['Record_Status'] = 'Archive';

            $this->mortalityRecords->where('LM_ID',$lmID)->set($data)->update();

            $farmerID = $this->request->getVar('Farmer_ID');
            $livestockTagID = $this->request->getVar('LivestockTagID');
            $livestockID = $this->request->getVar('LivestockID');

            $historyData = [
                'Title' => 'Archive Mortality Record',
                'Description' => "Archived the mortality record of {$livestockTagID}",
                'Farmer_ID' => $farmerID,
                'Livestock_ID' => $livestockID,
                'Type' => 'Mortality',
                'Action' => 'Archive'
            ];
    
            $response = $this->farmerDataHistory->addDataHistory($historyData);

            return $this->respond(['message' => 'Record Archived Successfully']);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function getLivestockTypes(){
        $livestockTypes = $this->livestockTypes->findAll();

        return $this->respond($livestockTypes);
    }

    public function addLivestockType(){
        try {
            $data = [
                'Type_Name' => $this->request->getVar('Type_Name'),
                'Livestock_Uses' => $this->request->getVar('Livestock_Uses'),
            ];
    
            $this->livestockTypes->save($data);
    
            return $this->respond(['message' => 'Record Added Successfully']);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function updateLivestockType(){
        try {
            $livestockTypeID = $this->request->getVar('LT_ID');

            $data = [
                'Type_Name' => $this->request->getVar('Type_Name'),
                'Livestock_Uses' => $this->request->getVar('Livestock_Uses'),
            ];
    
            $this->livestockTypes->where('LT_ID',$livestockTypeID)->set($data)->update();

            return $this->respond(['message' => 'Record Updated Successfully']);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function deleteLivestockType(){
        try {
            $livestockTypeID = $this->request->getVar('LT_ID');

            $this->livestockTypes->delete(['LT_ID' => $livestockTypeID]);

            return $this->respond(['message' => 'Record Deleted Successfully']);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function getLivestockForBreeding($farmerID){
        try {
            $whereClause = [
                'farmerlivestocks.Farmer_ID' => $farmerID,
                'livestocks.Record_Status' => 'Accessible',
                'livestocks.Livestock_Status' => 'Alive',
                // 'livestocks.Breeding_Eligibility' => 'Age-Suited'
            ];
    
            $whereClause['livestocks.Sex'] = 'Male';
            $maleLivestocks = $this->livestocks
                ->select('livestocks.Livestock_ID,livestocks.Livestock_TagID,livestocks.Livestock_Type,Sex')
                ->join('farmerlivestocks', 'farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
                ->where($whereClause)
                ->findAll();
    
            $whereClause['livestocks.Sex'] = 'Female';
            $femaleLivestocks = $this->livestocks
                ->select('livestocks.Livestock_ID,livestocks.Livestock_TagID,livestocks.Livestock_Type,Sex')
                ->where($whereClause)
                ->join('farmerlivestocks','livestocks.Livestock_ID = farmerlivestocks.Livestock_ID')
                ->findAll();
    
            $data = [
                'livestocks' => ['maleLivestocks' => $maleLivestocks, 'femaleLivestocks' => $femaleLivestocks]
            ];
    
            return $this->respond($data);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function recordBreeding(){
        try {
            $farmerID = $this->request->getVar('farmerID');
            $maleLivestock = $this->request->getVar('maleLivestock');
            $maleLivestockID = $this->request->getVar('maleLivestockID');

            $femaleLivestock = $this->request->getVar('femaleLivestock');
            $femaleLivestockID = $this->request->getVar('femaleLivestockID');

            $data = [
                'Farmer_ID' => $farmerID,
                'MaleLivestock' => $maleLivestock,
                'FemaleLivestock' => $femaleLivestock,
                'BreedResults' => $this->request->getVar('breedResult'),
                'BreedNotes' => $this->request->getVar('breedNotes'),
                'BreedDate' => $this->request->getVar('breedDate'),
            ];

            $this->livestockBreedings->save($data);

            $historyData1 = [
                'Title' => 'Breed Livestock',
                'Description' => "Breeding of {$maleLivestock} to {$femaleLivestock}",
                'Farmer_ID' => $farmerID,
                'Livestock_ID' => $maleLivestockID,
                'Type' => 'Breeding',
                'Action' => 'Add'
            ];
    
            $response1 = $this->farmerDataHistory->addDataHistory($historyData1);

            $historyData2 = [
                'Title' => 'Breed Livestock',
                'Description' => "Breeding of {$femaleLivestock} to {$maleLivestock}",
                'Farmer_ID' => $farmerID,
                'Livestock_ID' => $femaleLivestockID,
                'Type' => 'Breeding',
                'Action' => 'Add'
            ];
    
            $response2 = $this->farmerDataHistory->addDataHistory($historyData2);

            return $this->respond(["message" => "Record Added Successfully"]);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function getLivestockBreedingRecords(){
        try {
            $breedingRecords = $this->livestockBreedings
            ->select('livestock_breedings.LB_ID, livestock_breedings.Farmer_ID,
                        livestock_breedings.MaleLivestock, livestock_breedings.FemaleLivestock,
                        livestock_breedings.BreedResults, livestock_breedings.BreedNotes,
                        livestock_breedings.BreedDate,
                        CONCAT(user_accounts.Firstname, " ", user_accounts.LastName) as FarmerName,')
            ->join('farmer_profile','farmer_profile.Farmer_ID = livestock_breedings.Farmer_ID')
            ->join('user_accounts','user_accounts.User_ID = farmer_profile.User_ID')
            ->where(['livestock_breedings.Record_Status' => 'Accessible'])
            ->findAll();

            return $this->respond($breedingRecords);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function editLivestockBreedingRecord(){
        try {
            $LB_ID = $this->request->getVar('LB_ID');

            $data = [
                'MaleLivestock' => $this->request->getVar('MaleLivestock'),
                'FemaleLivestock' => $this->request->getVar('FemaleleLivestock'),
                'BreedResults' => $this->request->getVar('BreedResults'),
                'BreedNotes' => $this->request->getVar('BreedNotes'),
                'BreedData' => $this->request->getVar('BreedData'),
            ];

            $response = $this->livestockBreedings->where('LB_ID', $LB_ID)->set($data)->update();

            return $this->respond(["message" => "Record Updated Succesfully", $response]);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function archiveLivestockBreedingRecord(){
        try{
            $LB_ID = $this->request->getVar('LB_ID');

            $data['Record_Status'] = 'Archive';

            $this->livestockBreedings->where('LB_ID', $LB_ID)->set($data)->update();

            return $this->respond(["message" => "Record Archived Successfully"]);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }
}