<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Hotel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public $bindings = [
        \App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\HotelRepository::class,
          \App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\RoomRepository::class,
          \App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\UserRepository::class,
          \App\Repositories\Contracts\RepositoryInterface\CodeRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\CodeRepository::class,
          \App\Repositories\Contracts\RepositoryInterface\BookingRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\BookingRepository::class,
          \App\Repositories\Contracts\RepositoryInterface\BookingDetailRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\BookingDetailRepository::class,
          \App\Repositories\Contracts\RepositoryInterface\AmountRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\AmountRepository::class,
          \App\Repositories\Contracts\RepositoryInterface\AvailabilityRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\AvailabilityRepository::class,
          \App\Repositories\Contracts\RepositoryInterface\CityRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\CityRepository::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('admin.hotel.list-hotel', function($view) {
        //     $hotels = Hotel::all();
        //     view()->share([
        //         'hotels' => $hotels
        //     ]);
        // });
    }
}
