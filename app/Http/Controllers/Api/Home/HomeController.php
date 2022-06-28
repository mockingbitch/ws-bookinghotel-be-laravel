<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;

class HomeController extends Controller
{
    /**
     * @var $hotelRepository
     */
    protected $hotelRepository;

    /**
     * @var $roomRepository
     */
    protected $roomRepository;

    /**
     * @param HotelRepositoryInterface $hotelRepository
     */
    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        RoomRepositoryInterface $roomRepository
        )
    {
        $this->hotelRepository = $hotelRepository;
        $this->roomRepository = $roomRepository;
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
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

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function search(Request $request) 
    {   
        $query = $request->query();
        $rooms = $this->roomRepository->searchRoom($query);
        
        return response()->json([
            'errCode' => 0,
            'message' => 'success',
            'rooms' => $rooms
        ]);
    }
}
