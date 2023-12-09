<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use App\Models\FarmerLivestocksModel;
use App\Models\LivestocksModel;
use App\Models\LivestockMortalitiesModel;
use App\Models\LivestockBreedingsModel;
use App\Models\LivestockVaccinationModel;

class VisualizationController extends ResourceController
{
    private $livestocks;
    private $farmerLivestocks;
    private $livestockMortalities;
    private $livestockBreedings;
    private $vaccination;

    public function __construct() {
        $this->livestocks = new LivestocksModel();
        $this->farmerLivestocks = new FarmerLivestocksModel();
        $this->livestockMortalities = new LivestockMortalitiesModel();
        $this->livestockBreedings = new LivestockBreedingsModel();
        $this->vaccination = new LivestockVaccinationModel();
    }

    //nagana and tested
    public function getLivestockPopulationProgression() {
        try {
            $livestockCounts = $this->livestocks
                ->select("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d') as date, COUNT(*) as count")
                ->groupBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d')")
                ->orderBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d') ASC")
                ->findAll();

            if ($livestockCounts) {
                
                $labels = []; 
                $data = []; 

                foreach ($livestockCounts as $count) {
                    $labels[] = $count['date'];
                    $data[] = $count['count'];
                }

                $chartData = [
                    'labels' => $labels,
                    'data' => $data,
                ];

                return $this->respond($chartData, 200);
            } else {
                return $this->respond(['error' => 'No data found.']);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    // nagana and tested
    public function getLivestockVaccinationProgression(){
        try {
            $vaccinationCounts = $this->vaccination
                ->select("DATE_FORMAT(Vaccination_Date, '%Y-%m-%d') as date, COUNT(*) as count")
                ->groupBy("DATE_FORMAT(Vaccination_Date, '%Y-%m-%d')")
                ->orderBy("DATE_FORMAT(Vaccination_Date, '%Y-%m-%d') ASC")
                ->findAll();

            if ($vaccinationCounts) {
                
                $labels = []; 
                $data = []; 

                foreach ($vaccinationCounts as $count) {
                    $labels[] = $count['date'];
                    $data[] = $count['count'];
                }

                $chartData = [
                    'labels' => $labels,
                    'data' => $data,
                ];

                return $this->respond($chartData, 200);
            } else {
                return $this->respond(['error' => 'No data found.']);
            }
        } catch (\Throwable $th) {
            return $this->respond(["message" => "Error: " . $th->getMessage()]);
        }
    }

    // nagana and tested
    public function getLivestockBreedingProgression() {
        try {
            $livestockCounts = $this->livestockBreedings
                ->select("DATE_FORMAT(	BreedDate, '%Y-%m-%d') as date, COUNT(*) as count")
                ->groupBy("DATE_FORMAT(	BreedDate, '%Y-%m-%d')")
                ->orderBy("DATE_FORMAT(	BreedDate, '%Y-%m-%d') ASC")
                ->findAll();

            if ($livestockCounts) {
                
                $labels = []; 
                $data = []; 

                foreach ($livestockCounts as $count) {
                    $labels[] = $count['date'];
                    $data[] = $count['count'];
                }

                $chartData = [
                    'labels' => $labels,
                    'data' => $data,
                ];

                return $this->respond($chartData, 200);
            } else {
                return $this->respond(['error' => 'No data found.']);
            }
        } catch (\Throwable $e) {
            return $this->respond(["message" => "Error: " . $e->getMessage()]);
        }
    }

    // nagana and tested
    public function getLivestockMortality() {
        try {
            $livestockCounts = $this->livestockMortalities
                ->select("DATE_FORMAT(Date_Of_Death, '%Y-%m-%d') as month, COUNT(*) as count")
                ->groupBy("DATE_FORMAT(Date_Of_Death, '%Y-%m-%d')")
                ->orderBy("DATE_FORMAT(	Date_Of_Death, '%Y-%m-%d') ASC")
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

    // Farmer Chart API
    // nagana and tested
    public function getFarmerLivestockPopulationProgression($farmerID) {
        try {

            $livestockCounts = $this->livestocks
                ->select("DATE_FORMAT(livestocks.Date_Of_Birth, '%Y-%m ') as month, COUNT(*) as count")
                ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
                ->where('farmerlivestocks.Farmer_ID', $farmerID)
                ->groupBy("DATE_FORMAT(livestocks.Date_Of_Birth, '%Y-%m ')")
                ->orderBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m ') ASC")
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

    // nagana and tested
    public function getFarmerLivestockPopulationProgressionAgeClass($farmerID){
        try {
            $livestockCounts = $this->livestocks
                ->select('livestocks.Age_Classification, COUNT(*) as LivestockCount')
                ->groupBy('livestocks.Age_Classification')
                ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
                ->where('farmerlivestocks.Farmer_ID', $farmerID)
                ->findAll();


            if($livestockCounts){
                $labels = []; 
                $data = []; 

                foreach ($livestockCounts as $count) {
                    $labels[] = $count['Age_Classification'];
                    $data[] = $count['LivestockCount'];
                }

                $chartData = [
                    'labels' => $labels,
                    'data' => $data,
                ];

                return $this->respond($chartData, 200);
            }else {
                return $this->respond(['error' => 'No data found.'], 404);
            }
        } catch (\Throwable $th) {
            return $this->respond(["message" => "Error: " . $th->getMessage()]);
        }
    }

    // public function getFarmerLivestockTypePopulationProgression() {
    //     try {
    //         $farmerID = $this->request->getVar('Farmer_ID');
    //         $livestockType = $this->request->getVar('Livestock_Type');

    //         $whereClause = [
    //             'farmerlivestocks.Farmer_ID' => $farmerID,
    //             'livestocks.Livestock_Type' => $livestockType
    //         ];

    //         $livestockCounts = $this->livestocks
    //             ->select("DATE_FORMAT(livestocks.Date_Of_Birth, '%Y-%m') as month, COUNT(*) as count")
    //             ->join('farmerlivestocks','farmerlivestocks.Livestock_ID = livestocks.Livestock_ID')
    //             ->where($whereClause)
    //             ->groupBy("DATE_FORMAT(livestocks.Date_Of_Birth, '%Y-%m')")
    //             ->findAll();

    //         if ($livestockCounts) {
                
    //             $labels = []; 
    //             $data = []; 

    //             foreach ($livestockCounts as $count) {
    //                 $labels[] = $count['month'];
    //                 $data[] = $count['count'];
    //             }

    //             $chartData = [
    //                 'labels' => $labels,
    //                 'data' => $data,
    //             ];

    //             return $this->respond($chartData, 200);
    //         } else {
    //             return $this->respond(['error' => 'No data found.'], 404);
    //         }
    //     } catch (\Throwable $e) {
    //         return $this->respond(["message" => "Error: " . $e->getMessage()]);
    //     }
    // }


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

    // public function getLivestockTypePopulationProgression() {
    //     $livestockCounts = $this->livestocks
    //         ->select("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d') as month, Livestock_Type, COUNT(*) as count")
    //         ->groupBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d'), Livestock_Type")
    //         ->orderBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d') ASC")
    //         ->findAll();

    //     if ($livestockCounts) {
    //         $series = [];
    //         $livestockTypes = [];

    //         foreach ($livestockCounts as $count) {
    //             $month = $count['month'];
    //             $type = $count['Livestock_Type'];

    //             if (!in_array($type, $livestockTypes)) {
    //                 $livestockTypes[] = $type;
    //             }

    //             $series[$type]['data'][$month] = $count['count'];
    //         }

    //         $chartData = [
    //             'labels' => array_unique(array_column($livestockCounts, 'month')),
    //             'series' => array_values($series),
    //         ];

    //         return $this->respond($chartData, 200);
    //     } else {
    //         return $this->respond(['error' => 'No data found.'], 404);
    //     }
    // }

    // public function getLivestockTypePopulationProgression1() {
    //     try {
    //         $livestockCounts = $this->livestocks
    //             ->select("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d') as month, Livestock_Type, COUNT(*) as count")
    //             ->groupBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d'), Livestock_Type")
    //             ->orderBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d') ASC")
    //             ->findAll();

    //         if ($livestockCounts) {
                
    //             $labels = []; 
    //             $data = []; 

    //             foreach ($livestockCounts as $count) {
    //                 $labels[] = $count['date'];
    //                 $data[] = $count['count'];
    //             }

    //             $chartData = [
    //                 'labels' => $labels,
    //                 'data' => $data,
    //             ];

    //             return $this->respond($chartData, 200);
    //         } else {
    //             return $this->respond(['error' => 'No data found.']);
    //         }
    //     } catch (\Throwable $e) {
    //         return $this->respond(["message" => "Error: " . $e->getMessage()]);
    //     }
    // }

    public function getLivestockTypePopulationProgression() {
        $livestockCounts = $this->livestocks
            ->select("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d') as date, Livestock_Type, COUNT(*) as count")
            ->groupBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d'), Livestock_Type")
            ->orderBy("DATE_FORMAT(Date_Of_Birth, '%Y-%m-%d') ASC")
            ->findAll();
    
        if ($livestockCounts) {
            $series = [];
    
            foreach ($livestockCounts as $count) {
                $date = $count['date']; // Convert date to Unix timestamp
                $type = $count['Livestock_Type'];
    
                // Initialize the series if not exists
                if (!isset($series[$type])) {
                    $series[$type] = [
                        'name' => $type,
                        'data' => [],
                    ];
                }
    
                // Add data to the series
                $series[$type]['data'][$date] = $count['count'];
            }
    
            $chartData = [
                'labels' => array_values(array_unique(array_column($livestockCounts, 'month'))),
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
