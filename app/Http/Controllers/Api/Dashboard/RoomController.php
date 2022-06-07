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
    public function index()  //danh sách room
    {
        $rooms = $this->roomRepository->getAll(); //lấy ra tất cả các room từ db thông qua hàm getAll của roomRepository

        return response()->json([
            'message' => 'success',
            'errCode' => 0,
            'rooms' => $rooms //data trả về
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
            $query = $request->query(); //lấy ra query param từ request
            $room = $this->roomRepository->findByHotel($query['hotel']);  //lấy ra room theo hotel_id
            
            return response()->json([
                'errCode' => 0, //trường hợp đúng thì trả về errCode = 0
                'message' => 'success',
                'room' => $room
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errCode' => 1, //trường hợp lỗi thì trả về errCode = 1 để xác nhận bên front end
                'message' => 'error'
            ]);
        }
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function create(Request $request) //hàm tạo
    {
        $room = $this->roomService->create($request->toArray()); //gọi đến hàm tạo từ roomService

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
    public function show(int $id) //hàm lấy ra room theo id
    {
        $room = $this->roomRepository->find($id); //find room theo id 

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
    public function edit(Request $request) //hàm sửa
    {
        $room = $this->roomService->update($request['id'], $request); //gọi đến hàm update trong roomService

        return response()->json([
            'message' => 'success', 
            'errCode' => 0, //errCode = 0 => ko có lỗi ; errCode = 1 => có lỗi
            'room' => $room
        ], 200);
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function destroy(Request $request) //hàm xoá
    {
        $query = $request->query(); //lấy ra query từ request
        $this->roomRepository->delete($query['id']); //gọi đến hàm xoá từ roomRepository

        return response()->json([
            'errCode' => 0,
            'message' => 'success'
        ], 200);
    }
}