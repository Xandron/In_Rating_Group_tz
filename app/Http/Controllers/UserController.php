<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;

class UserController extends Controller
{

    public function index()
    {

        $result = User::where('active', true)
            ->get();

        return UserResource::collection($result);
    }
}
