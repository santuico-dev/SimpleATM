<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function fetchAllUsers()
    {
        return response()->json(
            $this->authService->fetchAllUsers()
        );
    }

    public function registerAccount(Request $request)
    {
        $registerResponse = $this->authService->registerAccount($request->all());
        return response(compact('registerResponse'));
    }

    public function loginAccount(Request $request)
    {
        $loginResponse =   $this->authService->loginAccount($request->pinCode);
        return response(compact('loginResponse'));
    }
}
