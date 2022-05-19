<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;
use App\Services\RoomService;
use Session;

class RoomController extends Controller
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
     * @var @roomService
     */
    private $roomService;

    /**
     * @param RoomRepositoryInterface $roomRepository
     * @param HotelRepositoryInterface $hotelRepository
     * @param RoomService $roomService
     */
    public function __construct(
        RoomRepositoryInterface $roomRepository,
        HotelRepositoryInterface $hotelRepository,
        RoomService $roomService
    ) 
    {
        $this->roomRepository = $roomRepository;
        $this->hotelRepository = $hotelRepository;
        $this->roomService = $roomService;
    }

    /**
     * @return void
     */
    public function index() 
    {
        $rooms = $this->roomRepository->getAll();

        return response()->json([
            'message' => 'success',
            'errCode' => 0,
            'rooms' => $rooms
        ]);
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function getRoomByHotel(Request $request) 
    {
        try {
            $query = $request->query();
        $room = $this->roomRepository->findByHotel($query['hotel']);
        
        return response()->json([
            'errCode' => 0,
            'message' => 'success',
            'room' => $room
        ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errCode' => 1,
                'message' => 'error'
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
        $room = $this->roomService->create($request->toArray());

        return response()->json([
            'message' => 'success',
            'errCode' => 0,
            'room' => $room
        ], 201);
    }

    /**
     * @param integer $id
     * 
     * @return void
     */
    public function show(int $id)
    {
        $room = $this->roomRepository->find($id);

        return response()->json([
            'message' => 'success',
            'errCode' => 0,
            'room' => $room
        ], 200);
    }

     /**
     * @param integer $id
     * @param Request $request
     * 
     * @return void
     */
    public function edit(Request $request)
    {
        $room = $this->roomService->update($request['id'], $request);

        return response()->json([
            'message' => 'success', 
            'errCode' => 0,
            'room' => $room
        ], 200);
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function destroy(Request $request)
    {
        $query = $request->query();
        $this->roomRepository->delete($query['id']);

        return response()->json([
            'errCode' => 0,
            'message' => 'success'
        ], 200);
    }
}