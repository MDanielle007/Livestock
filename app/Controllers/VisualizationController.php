<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\FarmerLivestocksModel;
use App\Models\LivestocksModel;
use App\Models\LivestockMortalitiesModel;

class VisualizationController extends ResourceController
{
    private $livestocks;
    private $farmerLivestocks;
    private $livestockMortalities;

    public function __construct() {
        $this->livestocks = new LivestocksModel();
        $this->farmerLivestocks = new FarmerLivestocksModel();
        $this->livestockMortalities = new LivestockMortalitiesModel();
    }

    public function getLivestockPopulationProgression() {
        try {
            $livestockCounts = $this->livestocks
                ->select("DATE_FORMAT(Date_Of_Birth, '%Y-%m') as month, COUNT(*) as count")
                ->groupBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m')")
                ->findAll();

            if ($livestockCounts) {
                
                $labels = []; 
                $data = []; 

                foreach ($livestockCounts as $count) {
                    $labels[] = $count['month'];
                    $data[] = $count['count'];
                }

                $chartData = [
                    'labels' => $labels,
                    'data' => $data,
                ];

                return $this->respond($chartData, 200);
            } else {
                return $this->respond(['error' => 'No data found.'], 404);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function getLivestockTypePopulationProgression() {
        try {
            $farmerID = $this->request->getVar('Farmer_ID');
            $livestockType = $this->request->getVar('Livestock_Type');


            $livestockCounts = $this->livestocks
                ->select("DATE_FORMAT(Date_Of_Birth, '%Y-%m') as month, COUNT(*) as count")
                ->groupBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m')")
                ->where("Livestock_Type",$livestockType)
                ->findAll();

            if ($livestockCounts) {
                
                $labels = []; 
                $data = []; 

                foreach ($livestockCounts as $count) {
                    $labels[] = $count['month'];
                    $data[] = $count['count'];
                }

                $chartData = [
                    'labels' => $labels,
                    'data' => $data,
                ];

                return $this->respond($chartData, 200);
            } else {
                return $this->respond(['error' => 'No data found.'], 404);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function getFarmerLivestockPopulationProgression() {
        try {
            $farmerID = $this->request->getVar('Farmer_ID');

            $livestockCounts = $this->livestocks
                ->select("DATE_FORMAT(livestocks.Date_Of_Birth, '%Y-%m') as month, COUNT(*) as count")
                ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
                ->where('farmerlivestocks.Farmer_ID', $farmerID)
                ->groupBy("DATE_FORMAT(livestocks.Date_Of_Birth, '%Y-%m')")
                ->findAll();

            if ($livestockCounts) {
                
                $labels = []; 
                $data = []; 

                foreach ($livestockCounts as $count) {
                    $labels[] = $count['month'];
                    $data[] = $count['count'];
                }

                $chartData = [
                    'labels' => $labels,
                    'data' => $data,
                ];

                return $this->respond($chartData, 200);
            } else {
                return $this->respond(['error' => 'No data found.'], 404);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function getFarmerLivestockTypePopulationProgression() {
        try {
            $farmerID = $this->request->getVar('Farmer_ID');
            $livestockType = $this->request->getVar('Livestock_Type');

            $whereClause = [
                'farmerlivestocks.Farmer_ID' => $farmerID,
                'livestocks.Livestock_Type' => $livestockType
            ];

            $livestockCounts = $this->livestocks
                ->select("DATE_FORMAT(livestocks.Date_Of_Birth, '%Y-%m') as month, COUNT(*) as count")
                ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
                ->where($whereClause)
                ->groupBy("DATE_FORMAT(livestocks.Date_Of_Birth, '%Y-%m')")
                ->findAll();

            if ($livestockCounts) {
                
                $labels = []; 
                $data = []; 

                foreach ($livestockCounts as $count) {
                    $labels[] = $count['month'];
                    $data[] = $count['count'];
                }

                $chartData = [
                    'labels' => $labels,
                    'data' => $data,
                ];

                return $this->respond($chartData, 200);
            } else {
                return $this->respond(['error' => 'No data found.'], 404);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function getLivestockMortality() {
        try {
            $livestockCounts = $this->livestockMortalities
                ->select("DATE_FORMAT(Date_Of_Death, '%Y-%m') as month, COUNT(*) as count")
                ->groupBy("DATE_FORMAT(Date_Of_Death, '%Y-%m')")
                ->findAll();

            if ($livestockCounts) {
                
                $labels = []; 
                $data = []; 

                foreach ($livestockCounts as $count) {
                    $labels[] = $count['month'];
                    $data[] = $count['count'];
                }

                $chartData = [
                    'labels' => $labels,
                    'data' => $data,
                ];

                return $this->respond($chartData, 200);
            } else {
                return $this->respond(['error' => 'No data found.'], 404);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function getFarmerLivestockMortality() {
        try {
            $farmerID = $this->request->getVar('farmerID');

            $livestockCounts = $this->livestockMortalities
                ->select("DATE_FORMAT(Date_Of_Death, '%Y-%m') as month, COUNT(*) as count")
                ->groupBy("DATE_FORMAT(Date_Of_Death, '%Y-%m')")
                ->where('Farmer_ID',$farmerID)
                ->findAll();

            if ($livestockCounts) {
                
                $labels = []; 
                $data = []; 

                foreach ($livestockCounts as $count) {
                    $labels[] = $count['month'];
                    $data[] = $count['count'];
                }

                $chartData = [
                    'labels' => $labels,
                    'data' => $data,
                ];

                return $this->respond($chartData, 200);
            } else {
                return $this->respond(['error' => 'No data found.'], 404);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    public function getLivestockTypePopulationProgression() {
        $livestockCounts = $this->livestocks
            ->select("DATE_FORMAT(Date_Of_Birth, '%Y-%m') as month, Livestock_Type, COUNT(*) as count")
            ->groupBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m'), Livestock_Type")
            ->findAll();

        if ($livestockCounts) {
            $series = [];
            $livestockTypes = [];

            foreach ($livestockCounts as $count) {
                $month = $count['month'];
                $type = $count['Livestock_Type'];

                if (!in_array($type, $livestockTypes)) {
                    $livestockTypes[] = $type;
                }

                $series[$type]['data'][$month] = $count['count'];
            }

            $chartData = [
                'labels' => array_unique(array_column($livestockCounts, 'month')),
                'series' => array_values($series),
            ];

            return $this->respond($chartData, 200);
        } else {
            return $this->respond(['error' => 'No data found.'], 404);
        }
    }

    public function getFarmerLivestockTypePopulationProgression() {
        $farmerID = $this->request->getVar('farmerID');

        $livestockCounts = $this->livestocks
            ->select("DATE_FORMAT(livestocks.Date_Of_Birth, '%Y-%m') as month, livestocks.Livestock_Type, COUNT(*) as count")
            ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
            ->where('farmerlivestocks.Farmer_ID', $farmerID)
            ->groupBy("DATE_FORMAT(livestocks.Date_Of_Birth, '%Y-%m'), livestocks.Livestock_Type")
            ->findAll();

        if ($livestockCounts) {
            $series = [];
            $livestockTypes = [];

            foreach ($livestockCounts as $count) {
                $month = $count['month'];
                $type = $count['Livestock_Type'];

                if (!in_array($type, $livestockTypes)) {
                    $livestockTypes[] = $type;
                }

                $series[$type]['data'][$month] = $count['count'];
            }

            $chartData = [
                'labels' => array_unique(array_column($livestockCounts, 'month')),
                'series' => array_values($series),
            ];

            return $this->respond($chartData, 200);
        } else {
            return $this->respond(['error' => 'No data found.'], 404);
        }
    }

    public function getLivestockTypeMortality() {
        $livestockCounts = $this->livestockMortalities
            ->select("DATE_FORMAT(livestock_mortalities.Date_Of_Death, '%Y-%m') as month, livestocks.Livestock_Type, COUNT(*) as count")
            ->join('livestocks','livestocks.Livestock_ID = livestock_mortalities.Livestock_ID')
            ->groupBy("DATE_FORMAT(livestock_mortalities.Date_Of_Death, '%Y-%m'), livestocks.Livestock_Type")
            ->findAll();

        if ($livestockCounts) {
            $series = [];
            $livestockTypes = [];

            foreach ($livestockCounts as $count) {
                $month = $count['month'];
                $type = $count['Livestock_Type'];

                if (!in_array($type, $livestockTypes)) {
                    $livestockTypes[] = $type;
                }

                $series[$type]['data'][$month] = $count['count'];
            }

            $chartData = [
                'labels' => array_unique(array_column($livestockCounts, 'month')),
                'series' => array_values($series),
            ];

            return $this->respond($chartData, 200);
        } else {
            return $this->respond(['error' => 'No data found.'], 404);
        }
    }

    public function getFarmerLivestockTypeMortality() {
        $farmerID = $this->request->getVar('farmerID');

        $livestockCounts = $this->livestockMortalities
            ->select("DATE_FORMAT(livestock_mortalities.Date_Of_Death, '%Y-%m') as month, livestocks.Livestock_Type, COUNT(*) as count")
            ->join('livestocks','livestocks.Livestock_ID = livestock_mortalities.Livestock_ID')
            ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
            ->where('farmerlivestocks.Farmer_ID', $farmerID)
            ->groupBy("DATE_FORMAT(livestock_mortalities.Date_Of_Death, '%Y-%m'), livestocks.Livestock_Type")
            ->findAll();

        if ($livestockCounts) {
            $series = [];
            $livestockTypes = [];

            foreach ($livestockCounts as $count) {
                $month = $count['month'];
                $type = $count['Livestock_Type'];

                if (!in_array($type, $livestockTypes)) {
                    $livestockTypes[] = $type;
                }

                $series[$type]['data'][$month] = $count['count'];
            }

            $chartData = [
                'labels' => array_unique(array_column($livestockCounts, 'month')),
                'series' => array_values($series),
            ];

            return $this->respond($chartData, 200);
        } else {
            return $this->respond(['error' => 'No data found.'], 404);
        }
    }
}
