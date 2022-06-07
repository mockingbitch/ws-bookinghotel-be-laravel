<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface BookingDetailRepositoryInterface extends BaseRepositoryInterface
{
    public function getBookingDetail(int $id);
}
