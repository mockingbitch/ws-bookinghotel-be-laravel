<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\BookingDetail;
use App\Repositories\Contracts\RepositoryInterface\BookingDetailRepositoryInterface;
use App\Repositories\BaseRepository;

class BookingDetailRepository extends BaseRepository implements BookingDetailRepositoryInterface
{
    public function getModel()
    {
        return BookingDetail::class;
    }
}
