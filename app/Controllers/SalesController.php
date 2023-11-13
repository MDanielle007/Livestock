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
        
    }
}
