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
    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        HotelService $hotelService
    ) 
    {
        $this->hotelRepository = $hotelRepository;
        $this->hotelService = $hotelService;
    }

    /**
     * @return void
     */
    public function index()
    {
        $hotels = $this->hotelRepository->getAll();

        return response()->json([
            'errCode' => 0,
            'message' => 'success',
            'hotels' => $hotels,
        ], 200);
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function create(Request $request) 
    {
        $hotel = $this->hotelService->create($request->toArray());
        $msg = 'Created successfully';

        return response()->json([
            'message' => $msg,
            'errCode' => 0,
            'hotel' => $hotel
        ], 201);
    }

    /**
     * @param integer $id
     * 
     * @return void
     */
    public function show(int $id)
    {
        $hotel = $this->hotelRepository->find($id);
        $msg = 'Get hotel success';

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
    public function edit(Request $request)
    {
        $hotel = $this->hotelService->update($request['id'], $request);
        $msg = 'Updated successfully';

        return response()->json([
            'message' => $msg,
            'errCode' => 0,
            'hotel' => $hotel
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
        $hotel = $this->hotelRepository->delete($query['id']);
        $msg = 'Deleted successfully';

        return response()->json([
            'errCode' => 0,
            'message' => $msg
        ], 200);
    }
}
