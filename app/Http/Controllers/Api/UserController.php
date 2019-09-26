<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersCollection;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
    	return new UsersCollection(User::paginate(10));
    }
}
