<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $role = $user->roles->first();

        if (!$role) {
            abort(403, 'No tiene rol asignado');
        }

        return view($role->nombre . '.dashboard');
    }
}