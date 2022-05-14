<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Support\Arr;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\V1\UserResource;
use App\Repositories\V1\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    protected $user;
    protected $userrepo;
    public function __construct(UserRepository $userrepo)
    {
        $this->userrepo = $userrepo;
    }
    /**
     * Authenticate User 
     * 
     * @return JSON
     */
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password
        ];
        if ($this->attempt($credentials)) {
            $user = $this->user;
            $token = $user->createToken('User-Token')->plainTextToken;

            return response()->json([
                'user'  =>  new UserResource($user),
                'token' =>  $token
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * create a check method for api login
     */
    public function attempt($credentials)
    {
        $email    =  Arr::get($credentials, 'email');
        $password =  Arr::get($credentials, 'password');
        $user     =  $this->userrepo->findBy($email, 'email');
 
        if ($user) {
            $this->user = $user;
            return Hash::check($password, $user->password);
        }
        return false;
    }
}
