<?php

namespace App\Http\Controllers;


use App\Album;
use App\Masjid;
use App\Gallery;
use App\AlbumSchedule;
use App\GallerySchedule;


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

        // Gallery
        $gallery_schedules  = $masjid->gallery_schedules($start, $end)->get();

        // Album
        $album_schedules    = $masjid->album_schedules($start, $end)->get();

        foreach ($gallery_schedules as $event)
        {
            $event->backgroundColor = "#9c27b0";
            $event->borderColor     = "#9c27b0";
            $event->title           = $event->gallery->title;
            $event->image           = asset($event->gallery->image_url);
            $event->url             = route('schedule.detail.gallery', $event->hashed_id);
        }

        foreach ($album_schedules as $event)
        {
            $event->backgroundColor = "#00bcd4";
            $event->borderColor     = "#00bcd4";
            $event->title           = $event->album->title;
            $event->image           = asset($event->album->images->first()->image_url);
            $event->url             = route('schedule.detail.album', $event->hashed_id);
        }

        // Return JSON
        // dd($gallery_schedules->toArray());
        // return array_merge($gallery_schedules, $album_schedules);
        // $merged = $gallery_schedules->merge($album_schedules);
        // return $merged->all();
        $gallery_schedule = $gallery_schedules->toArray();
        $album_schedule = $album_schedules->toArray();
        return array_merge($gallery_schedule, $album_schedule);
    }



    // Store a schedule
    public function store()
    {
        $request        = $this->request;
        $optimus        = $this->optimus;

        $this->validate($request, [
            'id'                => 'required|numeric',
            'display_schedule'  => 'required|string',
            'type'              => 'required|string'
        ]);

        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        $id             = $optimus->decode($request->input('id'));


        // Decide whether we're add gallery or album schedule
        if ($request->input('type') == 'gallery')
        {
            $gallery                = Gallery::findOrFail($id);

            $display_schedule       = explode(' - ', $request->display_schedule);

            $schedule               = new GallerySchedule();
            $schedule->masjid_id    = $masjid->id;
            $schedule->gallery_id   = $gallery->id;
            $schedule->start        = trim($display_schedule[0]) . ' 00:00:00';
            $schedule->end          = trim($display_schedule[1]) . ' 23:59:59';
            $schedule->save();

        }

        else if ($request->input('type') == 'album')
        {
            $album                  = Album::findOrFail($id);

            $display_schedule       = explode(' - ', $request->display_schedule);

            $schedule               = new AlbumSchedule();
            $schedule->masjid_id    = $masjid->id;
            $schedule->album_id     = $album->id;
            $schedule->start        = trim($display_schedule[0]) . ' 00:00:00';
            $schedule->end          = trim($display_schedule[1]) . ' 23:59:59';
            $schedule->save();
        }

        else
        {
            return back()->with('success', __('schedule.flash_error'));
        }

        return back()->with('success', __('schedule.flash_saved_successfully'));

    }


    // Show single schedule
    public function showGallery($schedule_id)
    {
        $request        = $this->request;
        $optimus        = $this->optimus;

        $id             = $optimus->decode($schedule_id);
        $schedule       = GallerySchedule::findOrFail($id);

        // dd($schedule);

        return view('pages.schedule-detail-gallery', compact('optimus', 'schedule'));
    }



    // Show single schedule
    public function showAlbum($schedule_id)
    {
        $request        = $this->request;
        $optimus        = $this->optimus;

        $id             = $optimus->decode($schedule_id);
        $schedule       = AlbumSchedule::findOrFail($id);

        // dd($schedule);

        return view('pages.schedule-detail-album', compact('optimus', 'schedule'));
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

        // Decide whether we're add gallery or album schedule
        if ($request->input('type') == 'gallery')
        {
            $schedule           = GallerySchedule::findOrFail($id);
        }

        else if ($request->input('type') == 'album')
        {
            $schedule           = AlbumSchedule::findOrFail($id);
        }

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

        // Decide whether we're add gallery or album schedule
        if ($request->input('type') == 'gallery')
        {
            $schedule           = GallerySchedule::findOrFail($id);
        }

        else if ($request->input('type') == 'album')
        {
            $schedule           = AlbumSchedule::findOrFail($id);
        }

        $schedule->delete();

        return redirect()->route('schedule.list')->with('success', __('schedule.flash_deleted_successfully'));
    }


}
