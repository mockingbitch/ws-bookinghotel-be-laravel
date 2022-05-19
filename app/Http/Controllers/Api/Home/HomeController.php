<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;

class HomeController extends Controller
{
    /**
     * @var $hotelRepository
     */
    protected $hotelRepository;

    /**
     * @param HotelRepositoryInterface $hotelRepository
     */
    public function __construct(HotelRepositoryInterface $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function listHotel(Request $request)
    {
        $query = $request->query();
        
        if (isset($query['city'])) {
            try {
                $hotels = $this->hotelRepository->getHotelByCity($query['city']);
                
                return response()->json([
                    'errCode' => 0,
                    'message' => 'success',
                    'hotels' => $hotels
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'errCode' => 1,
                    'message' => 'failed',
                ], 204);
            }
        }
    }
}
