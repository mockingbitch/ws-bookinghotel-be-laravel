<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CodeRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\AvailabilityRepositoryInterface;
use App\Services\AvailabilityService;
use Session;

class AvailabilityController extends Controller
{
    /**
     * @var @roomRepository
     */
    private $roomRepository;

    /**
     * @var @hotelRepository
     */
    private $hotelRepository;

    /**
     * @var @codeRepository
     */
    private $codeRepository;

    /**
     * @var @avaiRepo
     */
    private $avaiRepo;

    /**
     * @var @avaiService
     */
    private $avaiService;

    /**
     * @param RoomRepositoryInterface $roomRepository
     * @param HotelRepositoryInterface $hotelRepository
     * @param CodeRepositoryInterface $codeRepository
     * @param AvailabilityRepositoryInterface $avaiRepository
     * @param AvailabilityService $availabilityService
     */
    public function __construct(                    //khởi tạo
        RoomRepositoryInterface $roomRepository,
        HotelRepositoryInterface $hotelRepository,
        CodeRepositoryInterface $codeRepository,
        AvailabilityRepositoryInterface $avaiRepository,
        AvailabilityService $availabilityService
    ) 
    {
        $this->roomRepository = $roomRepository;
        $this->hotelRepository = $hotelRepository;
        $this->codeRepository = $codeRepository;
        $this->avaiRepo = $avaiRepository;
        $this->avaiService = $availabilityService;
    }

    /**
     * @param integer $id
     * 
     * @return void
     */
    public function index(Request $request)
    {
        try {
            $query = $request->query();
            $room = $this->roomRepository->find($query['room']);
            $availabilities = $this->avaiRepo->findByRoom($room->id);
            foreach($availabilities as $availability) {
                $data[] = [
                    'id' => $availability->id,
                    'room_id' => $availability->room_id,
                    'stock' => $availability->stock,
                    'date' => date('Y-m-d', $availability->day)
                ];
            } 
            $msg = 'success';

            return response()->json([
                'message' => $msg,
                'errCode' => 0,
                'availabilities' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed',
                'errCode' => 1,
                'res' => $th
            ]);
        }
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function create(Request $request) 
    {
        $availability = $this->avaiService->createAvailability($request['room_id'], $request->toArray()); //return true || false
        
        if ($availability == false) {
            return response()->json([
                'message' => 'Please check your date range!',
                'errCode' => 1
            ], 200);
        }

        // return response()->json([
        //     'message' => 'success',
        //     'errCode' => 0,
        // ], 201);
        return response()->json([
            'message' => $availability['msg'],
            'errCode' => $availability['errCode']
        ], 200);
    }

     /**
     * @param integer $id
     * @param Request $request
     * 
     * @return void
     */
    public function edit(int $id, Request $request)
    {
        
    }
}