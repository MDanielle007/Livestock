<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SoldLivestocksModel;
use App\Models\LivestockSalesModel;
use App\Models\FarmerProfilesModel;


class SalesController extends BaseController
{
    private $soldLivestocks;
    private $salesTransaction;
    private $farmer;

    public function __construct(){
        $this->soldLivestocks = new SoldLivestocksModel();
        $this->salesTransaction = new LivestockSalesModel();
        $this->farmer = new FarmerController();
    }

    public function commitSalesTransaction(){
        try{
            $json = $this->request->getJSON();
            $farmerID = $json->Farmer_ID;
            $salesTotal = $json->Sales_Total_Price;
            $amountPaid = $json->PaymentAmount;
            $changeAmount = $json->ChangeAmount;

            date_default_timezone_get('Asia/Manila');
            $salesDate = date('Y-m-d');

            $buyerName = $json->BuyerName;
            $buyerType = $json->BuyerType;

            $data = [
                'Farmer_ID' => $farmerID,
                'Sales_TotalPrice' => $salesTotal,
                'PaymentAmount' => $amountPaid,
                'ChangeAmount' => $changeAmount,
                'Sales_Date' => $salesDate,
                'Buyer_Name' => $buyerName,
                'Buyer_Type' => $buyerType,
            ];

            $salesID =$this->getSalesLastID();
            $response = $this->commitSoldLivestock($salesID, $json->soldLivestocks);

            $this->salesTransaction->save($data);

            $this->response(['message' => 'sales committed successfully'], 200);           
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
        
    }

    public function getSalesLastID() {
        $lastSalesID = $this->salesTransaction->selectMax('Sales_ID')->get()->getRow();

        if ($lastSalesID) {
            $lastID = $lastSalesID->Sales_ID;
            return $lastID;         
        } else {
            return 0;
        }
    }

    private function commitSoldLivestocks($salesID){
        $soldLivestocks = $this->request->getVar('soldLivestocks');
        foreach ($soldLivestocks as $livestock) {
            $data = [
                'Sales_ID' => $salesID,
                'Livestock_ID' => $livestock['Livestock_ID'],
                'Livestock_Price' => $livestock['Livestock_Price'],
            ];

            $this->soldLivestocks->save($data);
        }
    }

    public function getFarmerSales(){
        $farmerID = $this->request-getVar('farmerID');
        
        $whereClause = [
            'Farmer_ID' => $farmerID,
            'Record_Status' => 'Accessible'
        ];

        $salesTransactions = $this->salesTransaction
            ->select('Sales_ID, Sales_TotalPrice,
<<<<<<< Updated upstream
                        PaymentAmount, ChangeAmount,
=======
                        PaymentAmopunt, ChangeAmount,
>>>>>>> Stashed changes
                        Sales_Date, Buyer_Name, Buyer_Type,')
            ->where($whereClause)
            ->findAll();
            return $this->respond($salesTransactions, 200);
    }

    public function getAllSalesTransaction(){
        $salesTransactions = $this->salesTransaction->findAll();
        return $this->respond($salesTransactions, 200);
    }

    public function archiveSalesRecord(){
        try {
            $selectedRecords = $this->request->getVar('selectedRecords');
            
            foreach ($selectedRecords as $salesRecord) {
                $salesID = $salesRecord->Sales_ID;

                $whereClause = [
                    'Sales_ID' => $salesID
                ];

                $data['Record_Status'] = 'Archived';
                
                $this->salesTransaction->where($whereClause)->set($data)->update();
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function unarchiveSalesRecord(){
        try {
            $selectedRecords = $this->request->getVar('selectedRecords');
            
            foreach ($selectedRecords as $salesRecord) {
                $salesID = $salesRecord->Sales_ID;

                $whereClause = [
                    'Sales_ID' => $salesID
                ];

                $data['Record_Status'] = 'Accessible';
                
                $this->salesTransaction->where($whereClause)->set($data)->update();
                
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }
}
