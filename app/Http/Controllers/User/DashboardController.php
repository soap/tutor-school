<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.dashboard')
            ->withUser(Auth::user());
    }
}
