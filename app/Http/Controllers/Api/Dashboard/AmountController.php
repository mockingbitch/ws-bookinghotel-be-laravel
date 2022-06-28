<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\AmountRepositoryInterface;
use App\Services\AmountService;
use Session;
use Illuminate\View\View;

class AmountController extends Controller
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
     * @var @amountRepository
     */
    private $amountRepository;

    /**
     * @var @amountService
     */
    private $amountService;

    /**
     * @param RoomRepositoryInterface $roomRepository
     * @param HotelRepositoryInterface $hotelRepository
     * @param AmountRepositoryInterface $amountRepository
     * @param AmountService $amountService
     */
    public function __construct(  //các class được khởi tạo trong construct sẽ được khởi tạo khi class được gọi tới
        RoomRepositoryInterface $roomRepository,
        HotelRepositoryInterface $hotelRepository,
        AmountRepositoryInterface $amountRepository,
        AmountService $amountService
    ) 
    {
        $this->roomRepository = $roomRepository;   //gán
        $this->hotelRepository = $hotelRepository;
        $this->amountRepository = $amountRepository;
        $this->amountService = $amountService;
    }

    /**
     *
     * @param Request $request
     * 
     * @return void
     */
    public function index(Request $request) //lấy ra danh sách amount từ bảng amount
    {
        try {
            $query = $request->query(); //lấy ra query từ request 
            $room = $this->roomRepository->find($query['room']); //tìm room theo id 
            $amounts = $this->amountRepository->findByRoom($room->id); //gọi đến hàm find_by_room_id
            foreach($amounts as $amount) {
                $data[] = [
                    'id' => $amount->id,
                    'room_id' => $amount->room_id,
                    'price' => $amount->price,
                    'date' => date('Y-m-d', $amount->day) //format date
                ];
            }  //đổ data và format data

            return response()->json([
                'message' => 'success',
                'errCode' => 0,
                'amounts' => $data,
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
    public function create(Request $request) //hàm tạo amount 
    {
        $amount = $this->amountService->createAmount($request['room_id'], $request->toArray());

        return response()->json([
            'message' => $amount['msg'],
            'errCode' => $amount['errCode'],
        ], 201);
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