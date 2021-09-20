<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\KodeQR;
use App\Models\PerangkatDaerah;
use App\Models\SignatureQR;
use App\Models\ViewModel\v_bar_signature;
use App\Models\ViewModel\v_bar_signature_tahunan;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use QrCode;
use Vinkla\Hashids\Facades\Hashids;

class SignatureQRController extends Controller
{
    public function index()
    {
        $data = [
            'listPerangkat' => PerangkatDaerah::pluck('id_opd', 'alias_opd')->all(),
        ];
        return view('dashboard_page.signature.index', $data);
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $id_opd_fk = $request->get('id_opd_fk');
            $tgl_mulai = ($request->get('tgl_mulai'));
            $tgl_akhir = ($request->get('tgl_akhir'));
            $arrayList = $request->get('arrayList');
            $paginateList = [12, 24, 50, 100];
            $page_count = $request->get('page_count');
            $countPaginate = $page_count ? $page_count : 12;

            $eloKodeQR = SignatureQR::perangkat()->orderBy('created_at', 'DESC');

            if ($id_opd_fk) :
                $dataKodeQR = $eloKodeQR->where('id_opd_fk', $id_opd_fk);
            endif;

            if ($tgl_mulai && $tgl_akhir) :
                $tgl_mulaiFormat = ubahformatTgl($tgl_mulai);
                $tgl_akhirFormat = ubahformatTgl($tgl_akhir);
                $dataKodeQR = $eloKodeQR->whereBetween('tgl', [$tgl_mulaiFormat, $tgl_akhirFormat]);
            endif;

            $dataKodeQR = $eloKodeQR->paginate($countPaginate);

            $data = [
                "listQR" => $dataKodeQR,
                "arrayList" => $arrayList != null ? $arrayList : [],
                "page_count" => $page_count,
                "paginateList" => $paginateList,
            ];
            return view('dashboard_page.signature.data', $data)->render();
        } else {
            return false;
        }
    }

    public function destroy($id)
    {
        $this->destroyFunction($id, SignatureQR::class, 'qrcode', 'qrcode', 'Signature QR', 'signatureqr', '');
        if (true):
            return Respon('', true, 'Berhasil menghapus data', 200);
        else:
            return Respon('', false, 'Gagal menghapus data', 500);
        endif;
    }

    public function bulkDelete(Request $request)
    {
        $list_id = $request->input('id');
        foreach ($list_id as $id) {
            $this->destroyFunction($id, SignatureQR::class, 'qrcode', 'qrcode', 'Signature QR', 'signatureqr', '');
        }
        return Respon('', true, 'Berhasil menghapus beberapa data', 200);
    }

    public function form()
    {
        $data =
            [
                'mode' => 'tambah',
                'action' => url('dashboard/signature-qr/create'),
                'judul' => old('judul') ? old('judul') : getSetting('pernyataan_verifikasi'),
                'tgl' => old('tgl_surat') ? old('tgl_surat') : date('d/m/Y'),
                'id_opd_fk' => old('id_opd_fk') ? old('id_opd_fk') : '',
                'nomor_surat' => old('nomor_surat') ? old('nomor_surat') : '',
                'listPerangkat' => PerangkatDaerah::pluck('id_opd', 'nama_opd')->all(),
                'qrcode' => '',

            ];
        return view('dashboard_page.signature.form', $data);
    }

    public function create(Request $request)
    {

        $rule = SignatureQR::$validationRule;

        $this->validate($request,
            $rule,
            [],
            SignatureQR::$attributeRule,
        );


//        $kodeqr = QrCode::size(100)->generate($request->input('no_surat'), base_path('kodeqr/'.$nameFile));
//        $image = QrCode::size(200)->errorCorrection('H')
//            ->generate('A simple example of QR code!');
//        return response($image)->header('Content-type', 'image/png');
        //$kodeqr->move('kodeqr' . '/', $nameFile);
        $dataCreate = array(
            'judul' => $request->input('judul'),
            'tgl' => ubahformatTgl($request->input('tgl')),
            'id_opd_fk' => $request->input('id_opd_fk'),
            'nomor_surat' => $request->input('nomor_surat'),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            //'qrcode' => $nameFile
        );

        $insert = SignatureQR::create($dataCreate);

        $nameFile = round(microtime(true) * 1000) . '.png';
        $generator = url('signature-qr/' . Hashids::encode($insert->id));
        QrCode::format('png')->errorCorrection('H')->size(250)->merge('uploads/lampung_gray.png', 0.3, true)->generate($generator, base_path('signatureqr/' . $nameFile));

        $dataMaster = SignatureQR::find($insert->id);
        $dataUpdate = [
            'qrcode' => $nameFile,
        ];
        $dataMaster->update($dataUpdate);
        if ($insert) :
            saveLogs('menambahkan data pada fitur signature qr');
            return redirect(route('signature-qr'))
                ->with('pesan_status', [
                    'tipe' => 'success',
                    'desc' => 'signature qr berhasil ditambahkan',
                    'judul' => 'data signature qr'
                ]);
        else :
            return redirect(route('signature-qr.form'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'signature qr gagal ditambahkan',
                    'judul' => 'Data signature qr'
                ]);
        endif;

    }

    public function edit($id)
    {
        $checkData = SignatureQR::find(Hashids::decode($id));
        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];
            $data =
                [
                    'mode' => 'ubah',
                    'action' => url('dashboard/signature-qr/update/' . $id),
                    'judul' => old('judul') ? old('judul') : $dataMaster->judul,
                    'tgl' => old('tgl') ? old('tgl') : TanggalIndo2($dataMaster->tgl),
                    'id_opd_fk' => old('id_opd_fk') ? old('id_opd_fk') : $dataMaster->id_opd_fk,
                    'qrcode' => $dataMaster->qrcode,
                    'nomor_surat' => $dataMaster->nomor_surat,
                    'listPerangkat' => PerangkatDaerah::pluck('id_opd', 'nama_opd')->all(),
                ];
            return view('dashboard_page.signature.form', $data);
        else :
            return redirect(route('signature-qr'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Signature QR tidak ditemukan',
                    'judul' => 'Halaman Signature QR'
                ]);
        endif;
    }

    public function update($id, Request $request)
    {
        $rule = SignatureQR::$validationRule;
        $idDecode = Hashids::decode($id)[0];
        $dataMaster = SignatureQR::find($idDecode);

        $this->validate($request,
            $rule,
            [],
            SignatureQR::$attributeRule,
        );

        $dataUpdate = [
            'judul' => $request->input('judul'),
            'tgl' => ubahformatTgl($request->input('tgl')),
            'id_opd_fk' => $request->input('id_opd_fk'),
            'nomor_surat' => $request->input('nomor_surat'),
        ];
        //simpan perubahan
        $update = $dataMaster->update($dataUpdate);

        if ($update) :
            saveLogs('memperbarui data ' . $id . ' pada fitur signature qr');
            return redirect(route('signature-qr'))
                ->with('pesan_status', [
                    'tipe' => 'success',
                    'desc' => 'Signature QR berhasil diupdate',
                    'judul' => 'Data Signature QR'
                ]);
        else :
            return redirect(url('dashboard/signature-qr/edit/' . $id))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Signature QR gagal diupdate',
                    'judul' => 'Data Signature QR'
                ]);
        endif;
    }

    public function show($id)
    {
        $checkData = SignatureQR::find(Hashids::decode($id));
        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];
            $data =
                [
                    'judul' => $dataMaster->judul,
                    'tgl' => TanggalIndo2($dataMaster->tgl),
                    'qrcode' => $dataMaster->qrcode,
                    'nomor_surat' => $dataMaster->nomor_surat,
                    'nama_opd' => PerangkatDaerah::where('id_opd', $dataMaster->id_opd_fk)->first()->nama_opd,
                ];
            return view('dashboard_page.signature.show', $data);
        else :
            return redirect(route('kode-qr'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Signature QR tidak ditemukan',
                    'judul' => 'Halaman Signature QR'
                ]);
        endif;
    }

    public function print($id)
    {
        $checkData = SignatureQR::find(Hashids::decode($id));
        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];
            $data =
                [
                    'qrcode' => $dataMaster->qrcode,
                ];
            return view('dashboard_page.signature.print', $data);
        else :
            return redirect(route('signature-qr'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Signature QR tidak ditemukan',
                    'judul' => 'Halaman Signature QR'
                ]);
        endif;
    }

    public function statistik_perangkat_daerah()
    {
        $data = [
            'kodeqr' => KodeQR::count(),
            'data_tahun' => KodeQR::tahun()->get(),
        ];
        return view('dashboard_page.signature.statistik', $data);
    }

    public function tampil_grafik_pd(Request $request)
    {
        if ($request->ajax()) {
            $tahun = $request->get('tahun');
            $bulan = $request->get('bulan');
            if ($tahun != "") {
                if ($bulan != "") {
                    $periode = $bulan . '-' . $tahun;
                    $query = v_bar_signature::select('*')->where('periode', $periode)->groupBy('id_opd_fk');
                } else {
                    $query = v_bar_signature_tahunan::select('*')->where('periode', $tahun)->groupBy('id_opd_fk');
                }
            } else {
                $query = v_bar_signature_tahunan::selectRaw('SUM(jumlah) AS jumlah, id_opd_fk, nama_opd, alias_opd')->groupBy('id_opd_fk');
            }

            $data = $query->get();
            echo json_encode($data);
        }
        return false;
    }

    public function dataAjaxSuratKeluar(Request $request)
    {


        if ($request->has('q')) {
            $cari = $request->q;
            $data = KodeQR::select('id_qr', 'no_surat')->where('no_surat', 'LIKE', "%" . $cari . "%")->get();
            return response()->json($data);
        } else {
            $data = [];
        }
        return response()->json($data);
    }

    function fetchSuratKeluar(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = KodeQR::select('id_qr', 'no_surat')->where('no_surat', 'LIKE', "%" . $query . "%")->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li><a href="javascript:void(0)" class="text-dark">' . $row->no_surat . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }


}
