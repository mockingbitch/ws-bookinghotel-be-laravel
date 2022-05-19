<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface AmountRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param integer $room_id
     * @param string $day
     * 
     * @return object
     */
    public function findByDay(int $room_id, string $day);

    /**
     * @param integer $room_id
     * 
     * @return object
     */
    public function findByRoom(int $room_id);
}
