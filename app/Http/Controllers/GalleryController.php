<?php

namespace App\Http\Controllers;


use App\Masjid;
use App\Gallery;


use Auth;
use Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Optimus\Optimus;


class GalleryController extends Controller
{

    public function __construct(Request $request, Optimus $optimus)
    {
        $this->middleware('auth');
        $this->optimus = $optimus;
        $this->request = $request;
    }


    // List all gallery
    public function index()
    {
        $request        = $this->request;
        $optimus        = $this->optimus;

        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();
        $galleries      = $masjid->galleries()->paginate(2);
        return view('pages.gallery', compact([
            'galleries',
        ]));
    }


    // Save single gallery
    public function store()
    {

        $request        = $this->request;

        $this->validate($request, [
            'title'     => 'string|max:255',
            'image'     => 'required|image',
        ]);

        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        $gallery            = new Gallery();
        $gallery->masjid_id = $masjid->id;
        $gallery->title     = $request->input('title');

        // Saving image
        $now                = new Carbon();
        $filename           = str_random(15).'_'.$now->timestamp;
        $path               = 'uploads/galleries/image_'.$filename.'.jpg';
        $img                = Image::make($request->file('image'));
        $img->fit(1600, 900);
        $img->save($path, 80);
        $gallery->image_url = $path;

        $gallery->save();

        return back()->with('success', __('gallery.flash_saved_successfully'));
    }



    public function destroy()
    {
        $request        = $this->request;
        $optimus        = $this->optimus;

        $id             = $optimus->decode($request->input('id'));
        $gallery        = Gallery::findOrFail($id);

        $gallery->delete();

        return back()->with('success', __('gallery.flash_deleted_successfully'));
    }


}
