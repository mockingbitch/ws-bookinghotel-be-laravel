<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Amount;
use App\Repositories\Contracts\RepositoryInterface\AmountRepositoryInterface;
use App\Repositories\BaseRepository;

class AmountRepository extends BaseRepository implements AmountRepositoryInterface
{
    public function getModel()
    {
        return Amount::class;
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
        $amount = Amount::where('day', $day)->where('room_id', $room_id)->get();

        return $amount;
    }

    /**
     * @param integer $room_id
     * 
     * @return object
     */
    public function findByRoom(int $room_id) : object
    {
        $amount = Amount::where('room_id', $room_id)->get(); //select amount where(room_id = $room_id); get ~ select

        return $amount;
    }
}
