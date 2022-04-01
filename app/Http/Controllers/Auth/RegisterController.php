<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\UserService;

class RegisterController extends Controller
{
    private $uservice;

    public function __construct(UserService $uservice){
        $this->uservice = $uservice;
    }

    public function __invoke(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'email' => ['required','email'],
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($res, 400);
        }

        $respon = $this->uservice->register($request->all());
        return response()->json($respon, 200);
    }
}
