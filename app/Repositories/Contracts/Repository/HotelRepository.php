<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Hotel;
use App\Repositories\Contracts\RepositoryInterface\HotelRepositoryInterface;
use App\Repositories\BaseRepository;

class HotelRepository extends BaseRepository implements HotelRepositoryInterface
{
    public function getModel()
    {
        return Hotel::class;
    }

    /**
     * @param integer $id
     * 
     * @return object
     */
    public function getHotelByCity(int $id) : object
    {
        $hotels = Hotel::where('city_id', $id)->get();   

        return $hotels;
    }
}
