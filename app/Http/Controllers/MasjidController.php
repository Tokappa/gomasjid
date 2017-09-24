<?php

namespace App\Http\Controllers;


use App\News;
use App\Jumat;
use App\Masjid;
use App\Gallery;
use App\Finance;
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
        $request        = $this->request;

        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        $waktu_sholat   = $this->calculateWaktuSholat($masjid);

        $pengaturan_sholat = json_decode($masjid->fine_tune);

        if ((is_null($masjid->lat)) AND (is_null($masjid->lng)))
        {
            $request->session()->flash('message', 'Setting lokasi masjid belum diset');
            $request->session()->flash('message-type', 'danger');
        }

        return view('pages.shalat-time', compact([
            'masjid',
            'waktu_sholat',
            'pengaturan_sholat',
        ]));
    }


    // Show current finance status
    public function indexFinance()
    {
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();
        $masjid->financial  = $masjid->finance;
        return view('pages.financial', compact([
            'masjid',
        ]));
    }



    // Show current jumat status
    public function indexJumat()
    {
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();
        $masjid->jumat  = $masjid->jumat;
        return view('pages.jumat', compact([
            'masjid',
        ]));
    }



    // Show all running text
    public function indexNews()
    {
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();
        $news           = $masjid->news()->paginate(10);
        // dd($news);
        return view('pages.news', compact([
            'masjid',
            'news',
        ]));
    }



    // Get single running text
    public function showNews()
    {
        $request        = $this->request;
        $optimus        = $this->optimus;
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        $id             = $optimus->decode($request->input('id'));
        $news           = News::findOrFail($id);

        return $news;
        // $news   = $masjid->news()->paginate(10);
        // dd($news);
        // return view('pages.news', compact([
        //     'masjid',
        //     'news',
        // ]));
    }


    // Save masjid profile and calculation method
    public function storeShalat()
    {
        $request        = $this->request;
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        // Step 1: Coordinate and Method
        if ($request->input('step') == "1")
        {
            if ($request->has('latitude'))
            {
                $masjid->lat = $request->input('latitude');
            }
            if ($request->has('longitude'))
            {
                $masjid->lng = $request->input('longitude');
            }
            if ($request->has('altitude'))
            {
                $masjid->alt = $request->input('altitude');
            }
            if ($request->has('convention'))
            {
                $masjid->convention = $request->input('convention');
            }
            $masjid->save();

            return back()->with('success', __('masjid.flash_saved_successfully'));

        }

        // Step 2: Fine tune
        else if ($request->input('step') == "2")
        {
            $finetune['subuh'] = array(
                (int) $request->input('subuh_preparation'),
                (int) $request->input('subuh_adzan'),
                (int) $request->input('subuh_iqamat'),
                (int) $request->input('subuh_duration'),
            );
            $finetune['dzuhur'] = array(
                (int) $request->input('dzuhur_preparation'),
                (int) $request->input('dzuhur_adzan'),
                (int) $request->input('dzuhur_iqamat'),
                (int) $request->input('dzuhur_duration'),
            );
            $finetune['ashar'] = array(
                (int) $request->input('ashar_preparation'),
                (int) $request->input('ashar_adzan'),
                (int) $request->input('ashar_iqamat'),
                (int) $request->input('ashar_duration'),
            );
            $finetune['maghrib'] = array(
                (int) $request->input('maghrib_preparation'),
                (int) $request->input('maghrib_adzan'),
                (int) $request->input('maghrib_iqamat'),
                (int) $request->input('maghrib_duration'),
            );
            $finetune['isya'] = array(
                (int) $request->input('isya_preparation'),
                (int) $request->input('isya_adzan'),
                (int) $request->input('isya_iqamat'),
                (int) $request->input('isya_duration'),
            );

            // $finetune['imsak'] = array(
            //     $request->has('show_imsak') ? 1 : 0,
            //     (int) $request->pengaturan_imsak,
            // );
            // $finetune['syuruq'] = array(
            //     $request->has('show_syuruq') ? 1 : 0,
            //     (int) $request->pengaturan_syuruq,
            //     );
            // $finetune['jumat'] = array(
            //     $request->pengaturan_adzan_jumat,
            //     (int) $request->pengaturan_iqamat_jumat,
            // );

            $masjid->fine_tune = json_encode($finetune);

            $masjid->save();

            return back()->with('success', __('masjid.flash_saved_successfully'));
        }
    }



    // Update financial status
    public function storeFinance()
    {
        $request        = $this->request;
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        $this->validate($request, [
            'income'        => 'required|numeric',
            'expense'       => 'required|numeric',
            'balance'       => 'required|numeric',
        ]);

        $financial          = $masjid->finance;
        if (empty($financial))
        {
            $financial      = new Finance;
            $financial->masjid_id   = $masjid->id;
        }
        $financial->income  = $request->input('income');
        $financial->expense = $request->input('expense');
        $financial->balance = $request->input('balance');
        $financial->save();

        return back()->with('success', __('masjid.flash_financial_saved_successfully'));
    }



    // Update financial status
    public function storeJumat()
    {
        $request        = $this->request;
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        $this->validate($request, [
            'muadzin'       => 'required|string',
            'khatib'        => 'required|string',
            'imam'          => 'required|string',
        ]);

        $jumat          = $masjid->jumat;
        if (empty($jumat))
        {
            $jumat      = new Jumat;
            $jumat->masjid_id   = $masjid->id;
        }
        $jumat->muadzin = $request->input('muadzin');
        $jumat->khatib  = $request->input('khatib');
        $jumat->imam    = $request->input('imam');
        $jumat->save();

        return back()->with('success', __('masjid.flash_jumat_saved_successfully'));
    }



    // Update running text
    public function storeNews()
    {
        $request        = $this->request;
        $optimus        = $this->optimus;
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        if ($request->has('id') AND ($request->input('id') != ""))
        {
            $id             = $optimus->decode($request->input('id'));
            $news           = News::findOrFail($id);
        }
        else
        {
            $news           = new News;
            $news->masjid_id  = $masjid->id;

        }

        $news->content  = $request->input('content');
        $news->save();

        return back()->with('success', __('masjid.flash_news_saved_successfully'));
    }


    // Destroy single news
    public function destroyNews()
    {
        $request        = $this->request;
        $optimus        = $this->optimus;
        $user           = Auth::user();
        $masjid         = Masjid::where('user_id', $user->id)->first();

        $id             = $optimus->decode($request->input('id'));
        $news           = News::findOrFail($id);
        $news->delete();

        return back()->with('success', __('masjid.flash_news_deleted_successfully'));
    }


    // Get absolute value
    private function signNumber($x) {
        if($x==0)
        return 0;
        else
        return $x / abs($x);
    }

    // Calculate sholat time
    private function calculateWaktuSholat($configuration) {
        $tanggal=getdate();
        $J=$tanggal['yday'];

        $B = is_null($configuration->lat) ? -7.7893603 : $configuration->lat;    // Garis Lintang (derajat)  -  Latitude (Degrees)
        $H = is_null($configuration->alt) ? 50 : $configuration->alt;    // Ketinggian laut (meter)
        $L = is_null($configuration->lng) ? 110.367609 : $configuration->lng;    // Garis Bujur (derajat)  -  Longitude (Degrees)


        switch ($configuration->convention)
        {
            case "mwlg":
                $Gd = 18;
                $Gn = 17;
                break;

            case "isna":
                $Gd = 15;
                $Gn = 15;
                break;

            case "egas":
                $Gd = 19.5;
                $Gn = 17.5;
                break;

            case "uqum":
                $Gd = 18.5;
                $Gn = 90;
                break;

            case "uisk":
                $Gd = 18;
                $Gn = 18;
                break;

            default:
                $Gd = 18;    // Sudut Fajar Senja (15°-19°)  -  Dawn’s Twilight Angle (15°-19°)
                $Gn = 18;    // Sudut Malam Senja (15°-19°)  -  Night’s Twilight Angle (15°-19°)
        }

        $TZ = 7;    // Waktu Daerah (jam)  -  Time Zone (Hours)
        $Sh = 1;    // Sh=1 (Shafii) - Sh=2 (Hanafi)
        // STOP EDITING

        $D = 0;    // Turun mengenai matahari (derajat)  -  Solar Declination (derajat)
        $T = 0;    // Persamaan dari waktu (menit)  -  Equation of times (minutes)
        $R = 0;    // Referensi Garis Bujur (derajat)  -  Reference Longitude (Degrees)

        $beta = 2 * pi() * $J / 365;
        // $D = Sun Declination
        $D = (180 / pi()) * (0.006918 - (0.399912 * cos($beta)) + (0.070257 * sin($beta)) - (0.006758 * cos(2 * $beta)) + (0.000907 * sin(2 * $beta)) - (0.002697 * cos(3 * $beta)) + (0.001480 * sin(3 * $beta)));
        $T = 229.18 * (0.000075 + (0.001868 * cos($beta)) - (0.032077 * sin($beta)) - (0.014615 * cos(2 * $beta)) - (0.040849 * sin(2 * $beta)));
        $R = 15 * $TZ;
        $G = 18;
        $Z = 12 + (($R - $L) / 15) - ($T / 60);
        $U = (180 / (15 * pi())) * acos((sin((-0.8333 - 0.0347 * $this->signNumber($H) * sqrt(abs($H))) * (pi() / 180)) - sin($D * (pi() / 180)) * sin($B * (pi() / 180))) / (cos($D * (pi() / 180)) * cos($B * (pi() / 180))));
        $Vd = (180 / (15 * pi())) * acos((-sin($Gd * (pi() / 180)) - sin($D * (pi() / 180)) * sin($B * (pi() / 180))) / (cos($D * (pi() / 180)) * cos($B * (pi() / 180))));
        $Vn = (180 / (15 * pi())) * acos((-sin($Gn * (pi() / 180)) - sin($D * (pi() / 180)) * sin($B * (pi() / 180))) / (cos($D * (pi() / 180)) * cos($B * (pi() / 180))));
        $W = (180 / (15 * pi())) * acos((sin(atan(1 / ($Sh + tan(abs($B - $D) * pi() / 180))))-sin($D * pi() / 180) * sin($B * pi() / 180)) / (cos($D * pi() / 180) * cos($B * pi() / 180)));

        for ($i=1; $i<= 6; $i++)
        {
            switch ($i) {
                // Subuh
                case 1:
                    $hasil = $Z-$Vd;
                    break;
                // Syuruq
                case 2:
                    $hasil = $Z-$U;
                    break;
                // Dzuhur
                case 3:
                    $hasil = $Z;
                    break;
                // Ashar
                case 4:
                    $hasil = $Z+$W;
                    break;
                // Maghrib
                case 5:
                    $hasil = $Z+$U;
                    break;
                // Isya
                case 6:
                    if ($configuration->convention == 'uqum')
                    {
                        $hasil = $Z+$U+1.5;
                    }
                    else
                    {
                        $hasil = $Z+$Vn;
                    }
                    break;
            }


            $jam = floor($hasil);
            $menit = floor(($hasil - $jam) * 60);
            $detik = floor(((($hasil - $jam) * 60) - $menit) * 60);
            if (strlen($jam)==1) $jam="0" . $jam;
            if (strlen($menit)==1) $menit="0" . $menit;
            if (strlen($detik)==1) $detik="0" . $detik;
            $output[] = "$jam:$menit:$detik";
        }
        return $output;
    }
}
