<?php

namespace App\Http\Controllers;


use App\Masjid;
use App\Gallery;
use App\Schedule;


use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Optimus\Optimus;


class MasjidController extends Controller
{

    public function __construct(Request $request, Optimus $optimus)
    {
        $this->middleware('auth');
        $this->optimus = $optimus;
        $this->request = $request;
    }


    // Show current shalat configuration
    public function indexShalat()
    {
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();
        return view('pages.shalat-time', compact([
            'masjid',
        ]));
    }


    // Show current finance status
    public function indexFinance()
    {
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();
        return view('pages.financial', compact([
            'masjid',
        ]));
    }
}
