<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryCount = Categories::count();
        $userCount = User::count();

        return view('admin.dashboard', compact('categoryCount', 'userCount'));
    }
}
