<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $users = User::all()->count();

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('dashboard.admin.index', [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'users' => $users,
                'user' => $user,
            ]);
        } else {
            return view('dashboard.user.index', [
                'title' => 'Dashboard',
                'active' => 'dashboard',
                'user' => $user,
            ]);
        }
    }

    public function profile()
    {
        $user = Auth::user();

        return view('dashboard.profile', [
            'title' => 'Profile',
            'active' => 'profile',
            'user' => $user,
        ]);
    }
}
