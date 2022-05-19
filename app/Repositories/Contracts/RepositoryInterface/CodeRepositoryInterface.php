<?php

namespace App\Repositories\Contracts\RepositoryInterface;

use App\Repositories\BaseRepositoryInterface;

interface CodeRepositoryInterface extends BaseRepositoryInterface
{
    public function findByType(string $type);
}
