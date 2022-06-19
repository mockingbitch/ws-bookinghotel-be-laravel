<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

    /**
     * @param Request $request
     * 
     * @return void
     */
    public function changePassword(Request $request)
    {
        $user = auth()->user();
        $oldPassword = Hash::make($request->current_password);
        if (Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'errCode' => 1,
                'message' => 'Wrong password',
                'old' => $oldPassword,
            ], 200);
        }
        $newPassword = $request->new_password;
        $confirmPassword = $request->confirm_password;
        if ($newPassword !== $confirmPassword) {
            return response()->json([
                'errCode' => 1,
                'message' => 'Cant confirm your password'
            ], 200);
        } 
        
        $new = Hash::make($confirmPassword);
        $id = $user->id;
        $user = User::find($id);
        $user->password = $new;
        $user->save();

        return response()->json([
            'errCode' => 0,
            'message' => 'success',
        ], 200);
    }
}
