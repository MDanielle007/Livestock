<?php 
namespace App\Libraries;

use CodeIgniter\RESTful\ResourceController;
use App\Models\FarmerDataHistoryModel;

class HistoryLibrary extends ResourceController
{
    private $farmerDataHistory;

    public function __construct() {
        $this->farmerDataHistory = new FarmerDataHistoryModel();
    }

    public function addDataHistory($historyData = null){
        try {

            $this->farmerDataHistory->save($historyData);
            return ['message'=>'Data History Added'];
        } catch (\Throwable $th) {
            return ["error" => "Error: " . $th->getMessage()];
        }
    }

    public function fetchFarmerDataHistory($farmerID){
        try {
            return $this->farmerDataHistory->where('Farmer_ID',$farmerID)->findAll();
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }

    public function fetchAllFarmerDataHistory(){
        try {
            return $this->farmerDataHistory->findAll();
        } catch (\Throwable $th) {
            return $this->respond(["error" => "Error: " . $th->getMessage()]);
        }
    }
} 