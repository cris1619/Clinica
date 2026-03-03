<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $role = Auth::user()->user_type;

    if (view()->exists("$role.dashboard")) {
        return view("$role.dashboard");
    }

    abort(403, 'Rol no autorizado');
}
}
