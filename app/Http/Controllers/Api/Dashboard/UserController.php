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

    /**
     * @return void
     */
    public function index()
    {
        try {
            $users = $this->userRepository->getAllUser();

            return response()->json([
                'errCode' => 0,
                'message' => 'success',
                'users' => $users
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errCode' => 1,
                'message' => 'failed'
            ]);
        }
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function search(Request $request) 
    {
        try {
            $query = $request->query();
            $users = $this->userRepository->search($query['name']);

            return response()->json([
                'errCode' => 0,
                'message' => 'success',
                'users' => $users
            ], 200);
        } catch (\Throwable $th) {
          
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile() {
        return response()->json([
            'errCode' => 0,
            'message' => 'success',
            'user' => auth()->user()
        ], 200);
    }
}
