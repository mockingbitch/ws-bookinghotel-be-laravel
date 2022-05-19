<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Code;
use App\Repositories\Contracts\RepositoryInterface\CodeRepositoryInterface;
use App\Repositories\BaseRepository;

class CodeRepository extends BaseRepository implements CodeRepositoryInterface
{
    public function getModel()
    {
        return Code::class;
    }

    /**
     * @param string $type
     * 
     * @return Object
     */
    public function findByType(string $type) : Object
    {
        $result = Code::where('type', $type)->get();

        return $result;
    }
}
