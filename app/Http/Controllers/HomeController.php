<?php

namespace App\Http\Controllers;


use App\Masjid;


use Auth;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::all();
        // dd($users);
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();
        return view('pages.dashboard', compact('users', 'user', 'masjid'));
    }
}
