<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\CityRepositoryInterface;

class CityController extends Controller
{
    /**
     * @var $cityRepo
     */
    protected $cityRepo; 

    /**
     * @param CityRepositoryInterface $cityRepo
     */
    public function __construct(CityRepositoryInterface $cityRepo) 
    {
        $this->cityRepo = $cityRepo;
    }

    /**
     * @return void
     */
    public function getAll()
    {
        try {
            $cities = $this->cityRepo->getAll();

            return response()->json([
                'errCode' => 0,
                'message' => 'success',
                'cities' => $cities
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errCode' => 1,
                'message' => 'failed'
            ]);
        }
    }
}
