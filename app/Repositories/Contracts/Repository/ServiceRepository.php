<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Service;
use App\Repositories\Contracts\RepositoryInterface\ServiceRepositoryInterface;
use App\Repositories\BaseRepository;

class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    public function getModel()
    {
        return Service::class;
    }
}
