<?php

namespace App\Http\Controllers;


use App\Masjid;
use App\Gallery;
use App\Schedule;


use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Optimus\Optimus;


class ScheduleController extends Controller
{

    public function __construct(Request $request, Optimus $optimus)
    {
        $this->middleware('auth');
        $this->optimus = $optimus;
        $this->request = $request;
    }


    // Show current schedule
    public function index()
    {
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();
        return view('pages.schedule', compact([
            'masjid',
        ]));
    }


    // Show requested schedule from AJAX request
    public function getActive()
    {
        $request        = $this->request;
        $optimus        = $this->optimus;

        // Get requested parameters
        $id         = $request->id;
        $start      = $request->start . " 00:00:00";
        $end        = $request->end . " 23:59:59";

        // Search database
        $masjid     = Masjid::findOrFail($optimus->decode($id));
        $schedules  = $masjid->active_events($start, $end)->get();

        foreach ($schedules as $event)
        {
            $event->backgroundColor = "#9c27b0";
            $event->borderColor     = "#9c27b0";
            $event->title           = $event->gallery->title;
            $event->image           = asset($event->gallery->image_url);
            $event->url             = route('schedule.detail', $event->hashed_id);
        }

        // Return JSON
        return $schedules;
    }



    // Store a schedule
    public function store()
    {
        $request        = $this->request;
        $optimus        = $this->optimus;

        $this->validate($request, [
            'id'                => 'required|numeric',
            'display_schedule'  => 'required|string',
        ]);

        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        $id             = $optimus->decode($request->input('id'));
        $gallery        = Gallery::findOrFail($id);

        $display_schedule   = explode(' - ', $request->display_schedule);

        $schedule       = new Schedule();
        $schedule->masjid_id    = $masjid->id;
        $schedule->gallery_id   = $gallery->id;
        $schedule->start        = trim($display_schedule[0]) . ' 00:00:00';
        $schedule->end          = trim($display_schedule[1]) . ' 23:59:59';
        $schedule->save();

        return back()->with('success', __('schedule.flash_saved_successfully'));

    }


    // Show single schedule
    public function show($schedule_id)
    {
        $request        = $this->request;
        $optimus        = $this->optimus;

        $id             = $optimus->decode($schedule_id);
        $schedule       = Schedule::findOrFail($id);

        // dd($schedule);

        return view('pages.schedule-detail', compact('optimus', 'schedule'));
    }


    // Update single schedule
    public function update()
    {
        $request        = $this->request;
        $optimus        = $this->optimus;

        $this->validate($request, [
            'id'                => 'required|numeric',
            'display_schedule'  => 'required|string',
        ]);

        $display_schedule       = explode(' - ', $request->display_schedule);

        $id                     = $optimus->decode($request->input('id'));
        $schedule               = Schedule::findOrFail($id);
        $schedule->start        = trim($display_schedule[0]) . ' 00:00:00';
        $schedule->end          = trim($display_schedule[1]) . ' 23:59:59';
        $schedule->save();

        return back()->with('success', __('schedule.flash_saved_successfully'));

    }


    // Delete single schedule
    public function destroy()
    {
        $request        = $this->request;
        $optimus        = $this->optimus;

        $id             = $optimus->decode($request->input('id'));
        $schedule       = Schedule::findOrFail($id);

        $schedule->delete();

        return redirect()->route('schedule.list')->with('success', __('schedule.flash_deleted_successfully'));
    }


}
