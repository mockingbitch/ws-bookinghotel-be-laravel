<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;

class UserController extends Controller
{
    /**
     * @var @userRepository
     */
    protected $userRepository;
    
    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        try {
            $users = $this->userRepository->getAllUser();

            return response()->json([
                'errCode' => 0,
                'message' => 'success',
                'users' => $users
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errCode' => 1,
                'message' => 'failed'
            ]);
        }
    }
}
