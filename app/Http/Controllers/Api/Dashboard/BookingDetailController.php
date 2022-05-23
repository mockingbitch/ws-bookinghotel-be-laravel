<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\BookingDetailRepositoryInterface;

class BookingDetailController extends Controller
{
    /**
     * @var @bookingDetailRepo
     */
    protected $bookingDetailRepo;

    /**
     * @param BookingDetailRepositoryInterface $bookingDetailRepo
     */
    public function __construct
    (
        BookingDetailRepositoryInterface $bookingDetailRepo
    )
    {
        $this->bookingDetailRepo = $bookingDetailRepo;
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function getBookingDetail(Request $request)
    {
        $query = $request->query();
        $bookingDetail = $this->bookingDetailRepo->getBookingDetail($query['bookingid']);

        return response()->json([
            'errCode' => 0,
            'message' => 'success',
            'bookingDetail' => $bookingDetail
        ]);
    }
}
