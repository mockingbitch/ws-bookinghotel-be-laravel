<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Booking;
use App\Repositories\Contracts\RepositoryInterface\BookingRepositoryInterface;
use App\Repositories\BaseRepository;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    public function getModel()
    {
        return Booking::class;
    }
}
