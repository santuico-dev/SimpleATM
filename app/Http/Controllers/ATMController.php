<?php

namespace App\Http\Controllers;

use App\Services\ATMService;
use Illuminate\Http\Request;

class ATMController extends Controller
{
    //Initializing the service class in the constuctor
    public function __construct(protected ATMService $atmService)
    {}

    public function withdraw(Request $request)
    {
        $withDrawResponse = $this->atmService->withdraw($request->userID, $request->withdrawAmount);
        return response(compact('withDrawResponse'));
    }

    public function deposit(Request $request)
    {
        $depositResponse = $this->atmService->deposit($request->userID, $request->depositAmount);
        return response(compact('depositResponse'));
    }
}
