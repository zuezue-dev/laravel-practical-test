<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use App\Repositories\V1\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    protected $userrepo;
    public $user;
    public function __construct(UserRepository $userrepo)
    {
        $this->userrepo = $userrepo;
    }
    /**
     * Register User 
     * 
     * @return JSON
     */
    public function register(RegisterRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];
        $user  = $this->userrepo->save($data);

        $token =  $user->createToken('User-Token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token
        ], Response::HTTP_OK);
    }
}
