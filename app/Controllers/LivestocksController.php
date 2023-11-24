<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\FarmerLivestocksModel;
use App\Models\LivestocksModel;
use App\Models\LivestockVaccinationModel;

class LivestocksController extends ResourceController
{
    private $livestocks;
    private $vaccination;

    public function __construct(){
        $this->livestocks = new LivestocksModel(); 
        $this->vaccination = new LivestockVaccinationModel();
    }

    public function getAllLivestock(){
        try {
            try {
                $livestockRecords = $this->livestocks
                    ->select('Livestock_ID, 
                            Livestock_Type as livestockType, 
                            Breed_Name as breedName, 
                            Age_Classification as ageClass,
                            Age_Days,
                            Age_Weeks,
                            Age_Months,
                            Age_Years,
                            Sex as sex,
                            Date_Of_Birth,
                            CASE
                                WHEN Age_Days > 0 THEN CONCAT(Age_Days, " days")
                                WHEN Age_Weeks > 0 THEN CONCAT(Age_Weeks, " weeks")
                                WHEN Age_Months > 0 THEN CONCAT(Age_Months, " months")
                                WHEN Age_Years > 0 THEN CONCAT(Age_Years, " years")
                                ELSE "Unknown Age"
                            END as age')
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
            $data = [
                'Livestock_ID' => $this->request->getVar('livestockID'),
                'Vaccination_Name' => $this->request->getVar('vaccinationName'),
                'Vaccination_Description' => $this->request->getVar('vaccinationDescription'),
                'Vaccination_Date' => $this->request->getVar('vaccinationDate'),
            ];
            $this->vaccination->save($data);
    
            return $this->respond(["message" => "Vaccination Recorded Successfully"]);
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }
}
