<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;
use Session;
use App\Services\HotelService;
use Illuminate\Support\Facades\Auth;


class HotelController extends Controller
{
    /**
     * @var @hotelRepository
     */
    private $hotelRepository;

    /**
     * @var @hotelService
     */
    private $hotelService;

    /**
     * @param HotelRepositoryInterface $hotelRepository
     * @param HotelService $hotelService
     */
    public function __construct( //hàm khởi tạo 
        HotelRepositoryInterface $hotelRepository,  //Dependencies Injection: Giảm thiểu sự phụ thuộc
        HotelService $hotelService      //DI: là 1 design pattern
    ) 
    {
        $this->hotelRepository = $hotelRepository;
        $this->hotelService = $hotelService;
    }

    /**
     * @return void
     */
    public function index() //danh sách hotel
    { 
        $hotels = $this->hotelRepository->getAll(); //lấy ra tất cả hotel trong db

        return response()->json([  //trả về đoạn dữ liệu json
            'errCode' => 0,         //errCode: trả về bên front end để check lỗi
            'message' => 'success', //message: trả về bên front end để thông báo
            'hotels' => $hotels,    //hotels: data trả về bên front end
        ], 200); //200: Http status
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function create(Request $request) 
    {
        $hotel = $this->hotelService->create($request->toArray()); //toArray(): chuyển $request thành mảng 
        $msg = 'Created successfully'; //gán message bằng 1 chuỗi 

        return response()->json([
            'message' => $msg, // 'message' => 'Created successfully'
            'errCode' => 0, //trả về frontend để xác nhận 
            'hotel' => $hotel
        ], 201);
    }

    /**
     * @param integer $id
     * 
     * @return void
     */
    public function show(int $id) //lấy ra hotel theo id
    {
        $hotel = $this->hotelRepository->find($id); //gọi đến hàm find trong hotelRepository 

        return response()->json([
            'hotel' => $hotel,
            'message' => 'success'
        ], 200);
    }

     /**
     * @param Request $request
     * 
     * @return void
     */
    public function edit(Request $request) //hàm sửa
    {
        $hotel = $this->hotelService->update($request['id'], $request); //gọi đến hàm update từ hotelService

        return response()->json([
            'message' => 'success',
            'errCode' => 0,
            'hotel' => $hotel //trả về dữ liệu cho front end
        ], 200);
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function destroy(Request $request) //hàm xoá
    {
        $query = $request->query(); //Lấy ra query từ request
        $hotel = $this->hotelRepository->delete($query['id']); //gọi đến hàm xoá từ hotelRepository

        return response()->json([
            'errCode' => 0,
            'message' => 'success'
        ], 200);
    }
}
