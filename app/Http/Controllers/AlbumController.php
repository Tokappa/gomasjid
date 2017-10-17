<?php

namespace App\Http\Controllers;


use App\Album;
use App\Masjid;
use App\AlbumImage;


use Auth;
use Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Optimus\Optimus;


class AlbumController extends Controller
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
        $albums         = $masjid->albums()->paginate(2);
        return view('pages.album', compact([
            'albums',
        ]));
    }


    // Save album
    public function store()
    {

        $request        = $this->request;

        $this->validate($request, [
            'title'     => 'string|max:255',
        ]);

        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        // Save album
        $album              = new Album();
        $album->masjid_id   = $masjid->id;
        $album->title       = $request->input('title');
        $album->save();

        // Saving images
        foreach ($request->file('image') as $index => $sent_image)
        {
            $album_image        = new AlbumImage();
            $now                = new Carbon();
            $filename           = str_random(15).'_'.$now->timestamp;
            $path               = 'uploads/albums/album_'.$album->id.'_'.$filename.'.jpg';
            $img                = Image::make($sent_image);
            $img->fit(1600, 900);
            $img->save($path, 80);
            $album_image->album_id  = $album->id;
            $album_image->md5       = md5_file($path);
            $album_image->image_url = $path;
            $album_image->sequence  = $index;
            $album_image->save();
        }


        return back()->with('success', __('album.flash_saved_successfully'));
    }


}
