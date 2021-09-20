<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\JenisPenandatangan;
use App\Models\KodeQR;
use App\Models\Opd;
use App\Models\PerangkatDaerah;
use App\Models\Post;
use App\Models\SignatureQR;
use App\Models\SuratMasuk;
use App\Models\Topik;
use DataTables;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {

        if (Auth::user()->level != 'disposisi') :
            $data = [
                'jenisttd' => JenisPenandatangan::where('active', 1)->count(),
                'perangkatdaerah' => PerangkatDaerah::where('active', 1)->count(),
                'kodeqr' => KodeQR::count(),
                'suratmasuk' => SuratMasuk::count(),
                'signatureqr' => SignatureQR::count(),
                'data_tahun' => KodeQR::tahun()->get()
            ];
            return view('dashboard_page.dashboard', $data);
        else:
            return redirect(route('surat-masuk'));
        endif;
    }
}
