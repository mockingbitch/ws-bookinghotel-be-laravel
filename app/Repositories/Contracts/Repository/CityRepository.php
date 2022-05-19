<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\City;
use App\Repositories\Contracts\RepositoryInterface\CityRepositoryInterface;
use App\Repositories\BaseRepository;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function getModel()
    {
        return City::class;
    }
}
