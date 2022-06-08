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
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errCode' => 1,
                'message' => 'failed'
            ], 404);
        }
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function profile(Request $request)
    {
        try {
            $query = $request->query();
            $user = $this->userRepository->getProfile($query['id']);

            return response()->json([
                'errCode' => 0,
                'message' => 'success',
                'user' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errCode' => 1,
                'message' => 'failed'
            ], 404);
        }
    }

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function edit(Request $request)
    {
        try {
            $query = $request->query();
            $data = [
                'position' => $request['position']
            ];
            $this->userRepository->update($query['id'], $data);

            return response()->json([
                'errCode' => 0,
                'message' => 'success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errCode' => 1,
                'message' => 'failed'
            ], 404);
        }
    }
}
