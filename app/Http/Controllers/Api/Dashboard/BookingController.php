<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\BookingRepositoryInterface;
use App\Services\BookingService;
use Illuminate\Support\Facades\Auth;
use Session;

class BookingController extends Controller
{
    /**
     * @var @bookingRepository
     */
    private $bookingRepository;

    /**
     * @var @bookingService
     */
    private $bookingService; 

    /**
     * @param BookingRepositoryInterface $bookingRepository
     * @param BookingService $bookingService
     */
    public function __construct(
        BookingRepositoryInterface $bookingRepository,
        BookingService $bookingService
    )
    {
        $this->bookingRepository = $bookingRepository;
        $this->bookingService = $bookingService;
    }

    /**
     * @return void
     */
    public function index()
    {
        $bookings = $this->bookingRepository->getAll();

        return response()->json([
            'message' => 'success',
            'errCode' => 0,
            'bookings' => $bookings,
        ]);
    }

    /**
     * @param integer $room_id
     * @param Request $request
     * 
     * @return void
     */
    public function create(Request $request) 
    {
       try {
        $booking = $this->bookingService->create($request['user_id'], $request['room_id'], $request->toArray());

        return response()->json([
            'message' => $booking['msg'],
            'errCode' => $booking['errCode'],
        ]);
        } catch (\Throwable $th) {
           return response()->json([
               'errCode' => 1,
               'message' => 'error',
               'error' => $th
           ]);
        }
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function edit(Request $request)
    {
        try {
            $data = [
                'status' => $request['status'],
                'admin_id' => $request['admin_id']
            ];
            $this->bookingRepository->update($request['booking_id'], $data);

            return response()->json([
                'errCode' => 0,
                'message' => 'success',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errCode' => 1,
                'message' => 'error',
                'error' => $th
            ]);
        }
    }
}