<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Availability;
use App\Repositories\Contracts\RepositoryInterface\AvailabilityRepositoryInterface;
use App\Repositories\BaseRepository;

class AvailabilityRepository extends BaseRepository implements AvailabilityRepositoryInterface
{
    public function getModel()
    {
        return Availability::class;
    }

    /**
     * @param integer $room_id
     * @param string $day
     * 
     * @return object
     */
    public function findByDay(int $room_id, string $day) : object
    {
        $day = strtotime($day);
        $availability = Availability::where('day', $day)->where('room_id', $room_id)->get();

        return $availability;
    }

    /**
     * @param integer $room_id
     * 
     * @return object
     */
    public function findByRoom(int $room_id) : object
    {
        $availability = Availability::where('room_id', $room_id)->get();

        return $availability;
    }
}
