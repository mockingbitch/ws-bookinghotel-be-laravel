<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface RoomRepositoryInterface extends BaseRepositoryInterface
{
    public function findByHotel(int $id);
}
