<?php
namespace App\Services\Auth;

use App\Traits\ResponseAPI;
use Illuminate\Http\Response;

class AuthService
{
    use ResponseAPI;

    public function login($credentials)
    {
        if (! $token = auth()->attempt($credentials)) {
            return $this->error('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    private function respondWithToken($token)
    {
        return $this->success('Login Successfully', [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}