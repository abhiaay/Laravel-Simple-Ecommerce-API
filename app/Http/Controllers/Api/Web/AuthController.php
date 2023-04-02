<?php

namespace App\Http\Controllers\Api\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use App\Http\Requests\Api\Web\LoginRequest;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function doLogin(LoginRequest $request)
    {
        return $this->authService->login($request->validated());
    }
}
