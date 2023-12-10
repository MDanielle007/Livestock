<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\LivestockAdvisoriesModel;


class AdvisoryController extends ResourceController
{
    private $advisories;

    public function __construct() {
        $this->advisories = new LivestockAdvisoriesModel();
    }

    public function createAdvisory(){
        try {
            $isGeneral = $this->request->getVar('IsGeneral');
            $targetFarmers = json_decode($this->request->getVar('targetFarmers'), true);


            $data = [
                'Subject' => $this->request->getVar('Subject'),
                'Content' => $this->request->getVar('Content'),
            ];

            $hehe = [];

            if($isGeneral == 'true'){
                $data['Is_General'] = true;
                $this->advisories->insert($data);
            }else{
                foreach ($targetFarmers as $targetFarmer) {
                    $data['Target_Farmer_ID'] = $targetFarmer;
                    $hehe[$targetFarmer] = $data;
                    $this->advisories->insert($data);
                }
            }

            return $this->respond([$data,'isGeneral' => $isGeneral, 'targetFarmer' =>$targetFarmers, 'typeTarger' => gettype($targetFarmers),'hehe' => $hehe]);
        } catch (\Throwable $th) {
            return $this->respond(['message' => 'Error: '.$th->getMessage()]);
        }
    }

    public function getAdvisories(){
        try {
            $livestockAdvisories = $this->advisories
                ->select('Subject,Content,Target_Farmer_ID,Is_General,Date_Published')
                ->where('Record_Status','Accessible')
                ->orderBy('Date_Published','DESC')
                ->findAll();
            
            return $this->respond($livestockAdvisories);
        } catch (\Throwable $th) {
            return $this->respond(["message" => "Error: " . $th->getMessage()]);
        }
    }

    public function getFarmerNotification($userid){
        try {
            $whereClause = [
                'Record_Status' => 'Accessible',
                'Target_Farmer_ID' => $userid,
            ];

            $livestockAdvisories = $this->advisories
                ->select('Subject,Content,Target_Farmer_ID, Is_General, Date_Published')
                ->where($whereClause)
                ->orWhere('Is_General',true)
                ->orderBy('Date_Published','DESC')
                ->findAll();
            
            return $this->respond($livestockAdvisories);
        } catch (\Throwable $th) {
            return $this->respond(["message" => "Error: " . $th->getMessage()]);
        }
    }
}
