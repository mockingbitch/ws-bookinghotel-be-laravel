<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\User;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    /**
     * @return void
     */
    public function getAllUser() 
    {
        $users = User::select('id','name', 'phone', 'email', 'avatar', 'cccd', 'position')->get();

        return $users;
    }

    /**
     * @param integer $id
     * 
     * @return void
     */
    public function getProfile(int $id)
    {
        $user = User::select('id','name', 'phone', 'email', 'avatar', 'cccd', 'position')->where('id', $id)->get();

        return $user;
    }
}
