<?php

namespace App\Http\Controllers;


use App\User;
use App\News;
use App\Jumat;
use App\Masjid;
use App\Finance;
use App\Statistic;


use Auth;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // $this->middleware(['role:member']);
    //     $this->middleware('auth:api');
    // }

    // Get masjid configuration to calculate sholat times
    // Parameters:
    // -api_token
    public function postConfig()
    {
        $user           = Auth::guard('api')->user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        return $masjid;
    }

    // Get masjid current event
    public function postEvents()
    {
        $user = Auth::guard('api')->user();
        $masjid = $user->masjid;
        $id     = $masjid->id;
        $start  = date("Y-m-d") . " 00:00:00";
        $end    = date("Y-m-d") . " 23:59:59";
        // $start  = $request->start;
        // $end    = $request->end;

        // dd($start);

        // Search database
        $masjid = Masjid::find($id);
        $events = $masjid->active_events($start, $end, true)->get();
        return $events;
    }

    // Get financial condition
    public function postFinancial()
    {
        $user = Auth::guard('api')->user();
        $financial = Finance::where(['masjid_id' => $user->masjid->id])->first();
        return $financial;
    }

    // Get sholat jumat
    public function postJumat()
    {
        $user = Auth::guard('api')->user();
        $jumat = Jumat::where(['masjid_id' => $user->masjid->id])->first();
        return $jumat;
    }

    // Get running text
    public function postNews()
    {
        $user = Auth::guard('api')->user();
        $news = News::where(['masjid_id' => $user->masjid->id])->get();
        return $news;
    }

    // Check TOKEN for installation
    public function postCheckToken()
    {
        $user = Auth::guard('api')->user();
        return $user;
    }

    // Receive device status
    public function postDeviceStatus(Request $request)
    {
        $user = Auth::guard('api')->user();
        $masjid = $user->masjid;
        $id     = $masjid->id;
        $status_input = $request->input();
        // dd($status);
        if ($request->has('status'))
        {
            $status_records = $status_input['status'];
            // $status = Statistic::firstOrCreate(['masjid_id' => $id]);
            $status = new Statistic;
            $status->masjid_id      = $id;
            $status->status         = 1;
            $status->temperature    = $status_records['temperature'];
            $status->total_space    = $status_records['total_space'];
            $status->used_space     = $status_records['used_space'];
            $status->free_space     = $status_records['free_space'];
            $status->used_space_perc = $status_records['used_space_perc'];
            $status->bandwidth      = $status_records['bandwidth'];
            $status->save();
            return response()->json([
                'error' => false,
                'message' => 'OK, data diterima'
            ], 200);
        }
        else
        {
            return response()->json([
                'error' => true,
                'message' => 'Format data salah.'
            ], 200);

        }

    }
}
