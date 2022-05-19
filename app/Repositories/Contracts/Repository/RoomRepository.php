<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Room;
use App\Repositories\Contracts\RepositoryInterface\RoomRepositoryInterface;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    public function getModel()
    {
        return Room::class;
    }

    /**
     * @param integer $id
     * 
     * @return object
     */
    public function findByHotel(int $id) : object
    {
        $rooms = Room::where('hotel_id', $id)->get();   

        return $rooms;
    }
}
