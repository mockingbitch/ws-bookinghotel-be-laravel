<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Dashboard\HotelController;
use App\Http\Controllers\Api\Dashboard\RoomController;
use App\Http\Controllers\Api\Dashboard\AmountController;
use App\Http\Controllers\Api\Dashboard\AvailabilityController;
use App\Http\Controllers\Api\Dashboard\BookingController;
use App\Http\Controllers\Api\Dashboard\BookingDetailController;
use App\Http\Controllers\Api\Dashboard\CityController;
use App\Http\Controllers\Api\Dashboard\UserController;
use App\Http\Controllers\Api\Home\HomeController;
use App\Http\Controllers\Api\CodeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/change-pass', [AuthController::class, 'changePassWord']);

    //ADMIN

    Route::prefix('admin')->group(function (){
        Route::get('/dashboard', [HomeController::class, 'dashboard']);

        // Hotel
        Route::put('/edithotel', [HotelController::class, 'edit']);
        Route::prefix('hotels')->group(function (){   //Chuẩn RESTful API
            Route::get('/', [HotelController::class, 'index']); // api/auth/admin/hotels get: lấy giá trị trả về
            Route::post('/', [HotelController::class, 'create']); //post: phương thức thêm mới
            Route::put('/', [HotelController::class, 'update']); //put ~ post (nhưng dành cho update)
            Route::delete('/', [HotelController::class, 'destroy']); //delete: xoá
        });

        // Room
        Route::prefix('rooms')->group(function (){
            Route::get('/', [RoomController::class, 'index']);
            Route::get('/get', [RoomController::class, 'getRoomByHotel']);
            Route::post('/', [RoomController::class, 'create']);
            Route::put('/', [RoomController::class, 'edit']);
            Route::delete('/', [RoomController::class, 'destroy']);
        });

        //Availability
        Route::prefix('availabilities')->group(function (){
            Route::get('/', [AvailabilityController::class, 'index']);
            Route::post('/', [AvailabilityController::class, 'create']);
            // Route::post('/edit/{id}', [AvailabilityController::class, 'edit']);
        });

        //Amount 
        Route::prefix('amounts')->group(function (){
            Route::get('/', [AmountController::class, 'index']);
            Route::post('/', [AmountController::class, 'create']);
        });

        //User 
        Route::prefix('user')->group(function (){
            Route::get('/', [UserController::class, 'index']);
            Route::get('/search', [UserController::class, 'search']);
            Route::get('/profile', [UserController::class, 'profile']);
            Route::post('/changepassword', [UserController::class, 'changePassword']);
        });

        //Booking
        Route::prefix('booking')->group(function (){
            Route::get('/', [BookingController::class, 'index']);
            Route::post('/', [BookingController::class, 'create']);
            Route::put('/', [BookingController::class, 'edit']);
        });

        //BookingDetail
        Route::prefix('bookingdetail')->group(function (){
            Route::get('/', [BookingDetailController::class, 'getBookingDetail']);
        });
    });

    //============================================================================

    Route::get('/cities', [CityController::class, 'getAll']);

    //HOME
    Route::get('/search', [HomeController::class, 'search']);
    Route::prefix('hotels')->group(function () {
        Route::get('/', [HomeController::class, 'listHotel']);
        Route::get('/{id}', [HomeController::class, 'listRoomByHotel']);
        Route::get('/rooms/{id}', [HomeController::class, 'bookingView']);
        Route::post('/rooms/{id}', [BookingController::class, 'create']);
    });
    Route::get('/thanks', [HomeController::class, 'thank']);
    Route::get('/code', [CodeController::class, 'getAllCode']);
});


