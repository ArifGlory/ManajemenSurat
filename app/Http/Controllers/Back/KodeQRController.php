<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\DisposisiSuratKeluar;
use App\Models\JenisPenandatangan;
use App\Models\KodeQR;
use App\Models\Opd;
use App\Models\PerangkatDaerah;
use App\Models\User;
use App\Models\ViewModel\v_bar_opd_tahunan;
use App\Models\ViewModel\v_bar_penandatangan;
use App\Models\ViewModel\v_bar_perangkat_daerah;
use App\Models\ViewModel\v_bar_ttd_tahunan;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use QrCode;
use setasign\Fpdi\Tcpdf\Fpdi;
use Vinkla\Hashids\Facades\Hashids;

class KodeQRController extends Controller
{
    public function index()
    {

        $data = [
            'listPerangkat' => PerangkatDaerah::pluck('id_opd', 'alias_opd')->all(),
            'listJenis' => JenisPenandatangan::pluck('id_jenis_ttd', 'jenis_ttd')->all()
        ];

        return view('dashboard_page.kodeqr.index', $data);
    }

    public function data(Request $request)
    {
        $data = KodeQR::select('*');
        $id_jenis_ttd = $request->get('id_jenis_ttd');
        $tgl_mulai = ($request->get('tgl_mulai'));
        $tgl_akhir = ($request->get('tgl_akhir'));

        if ($id_jenis_ttd) :
            $data = $data->where('id_jenis_ttd', $id_jenis_ttd);
        endif;

        if ($tgl_mulai && $tgl_akhir) :
            $tgl_mulaiFormat = ubahformatTgl($tgl_mulai);
            $tgl_akhirFormat = ubahformatTgl($tgl_akhir);
            $data = $data->whereBetween('tgl_surat', [$tgl_mulaiFormat, $tgl_akhirFormat]);
        endif;

        if (Auth::user()->level == 'superadmin' && 'umum'):
           //bisa lihat semua
        else:
            $cekDataIdSuratKeluar = DisposisiSuratKeluar::where('kepada', Auth::user()->level)->get(['id_surat_keluar'])->pluck('id_surat_keluar')->toArray();
            $data = $data->where('id_qr', $cekDataIdSuratKeluar);
        endif;

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($row) {
                $checkbox = '<input type="checkbox" value="' . Hashids::encode($row->id_qr) . '" class="data-check">';
                return $checkbox;
            })
            ->editColumn('id_qr', function ($row) {
                return Hashids::encode($row->id_qr);
            })
            ->editColumn('no_surat', function ($row) {
                $no_surat = '<label class="font-weight-bolder">' . $row->no_surat . '</label>';
                return $no_surat;
            })
            ->editColumn('status_surat', function ($row) {
               if ($row->status_surat == "DRAFT"){
                   $status_surat = '<span class="badge badge-success">'.$row->status_surat.'</span>';
               }else{
                   $status_surat = '<span class="badge badge-primary">'.$row->status_surat.'</span>';
               }

                return $status_surat;
            })
            ->editColumn('tgl_surat', function ($row) {
                return $row->tgl_surat ? tanggalIndo($row->tgl_surat) : '';
            })
            ->editColumn('qrcode', function ($row) {
                $qrcode = $row->qrcode ? url('kodeqr/'.$row->qrcode) :url('uploads/blank.png');
                $showimage = '<a class="image-popup-no-margins" href="'.$qrcode.'"><img src="'.$qrcode.'" width="50px"></a>';
                return $showimage;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group" role="group" aria-label="First group">';
                $btn .= '<a href="' . url('kodeqr/' . $row->qrcode) . '" class="btn btn-sm btn-icon btn-info waves-effect" target="_blank" title="Download"><i class="fa fa-download"></i></a>';
                $btn .= '<a href="' . url('dashboard/surat-keluar/print/' . Hashids::encode($row->id_qr)) . '" target="_blank" class="btn btn-sm btn-icon btn-dark waves-effect" title="Print"><i class="fa fa-print"></i></a>';
                $btn .= '<a href="' . url('detail-surat-keluar/' . Hashids::encode($row->id_qr)) . '" target="_blank" class="btn btn-sm btn-icon btn-primary waves-effect" title="Detail"><i class="fa fa-eye"></i></a>';
                if (Auth::user()->level == 'superadmin' || Auth::user()->level == 'umum') {
                    $btn .= '<a href="' . url('dashboard/surat-keluar/edit/' . Hashids::encode($row->id_qr)) . '" class="btn btn-sm btn-icon btn-success waves-effect" title="Edit"><i class="fa fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0)" onclick="deleteData(' . "'" . Hashids::encode($row->id_qr) . "'" . ')" class="btn btn-sm btn-icon btn-danger waves-effect" title="Hapus"><i class="fa fa-trash"></i></a>';
                }
                $btn .= '</div>';
                return $btn;
            })
            ->escapeColumns([])
            ->toJson();
    }

    public function dataBK(Request $request)
    {
        if ($request->ajax()) {
            $id_jenis_ttd = $request->get('id_jenis_ttd');
            $tgl_mulai = ($request->get('tgl_mulai'));
            $tgl_akhir = ($request->get('tgl_akhir'));
            $cari = $request->get('cari');
            $arrayList = $request->get('arrayList');
            $paginateList = [12, 24, 50, 100];
            $page_count = $request->get('page_count');
            $countPaginate = $page_count ? $page_count : 12;

            $eloKodeQR = KodeQR::orderBy('created_at', 'DESC');


            if ($id_jenis_ttd) :
                $dataKodeQR = $eloKodeQR->where('id_jenis_ttd', $id_jenis_ttd);
            endif;

            if ($tgl_mulai && $tgl_akhir) :
                $tgl_mulaiFormat = ubahformatTgl($tgl_mulai);
                $tgl_akhirFormat = ubahformatTgl($tgl_akhir);
                $dataKodeQR = $eloKodeQR->whereBetween('tgl_surat', [$tgl_mulaiFormat, $tgl_akhirFormat]);
            endif;

            if ($cari) :
                $dataKodeQR = $eloKodeQR->where('no_surat', 'like', "%" . $cari . "%");
            endif;

            $dataKodeQR = $eloKodeQR->paginate($countPaginate);

            $data = [
                "listQR" => $dataKodeQR,
                "arrayList" => $arrayList != null ? $arrayList : [],
                "page_count" => $page_count,
                "paginateList" => $paginateList,
            ];
            return view('dashboard_page.kodeqr.data', $data)->render();
        } else {
            return false;
        }
    }

    public function destroy($id)
    {
        $this->destroyBerkas($id, KodeQR::class, 'berkas', 'berkas', '');
        $this->destroyFunction($id, KodeQR::class, 'qrcode', 'no_surat', 'Surat Keluar', 'kodeqr', '');
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
            $this->destroyBerkas($id, KodeQR::class, 'berkas', 'berkas', '');
            $this->destroyFunction($id, KodeQR::class, 'qrcode', 'no_surat', 'Surat Keluar', 'kodeqr', '');
        }
        return Respon('', true, 'Berhasil menghapus beberapa data', 200);
    }

    public function form()
    {
        $data =
            [
                'mode' => 'tambah',
                'action' => url('dashboard/surat-keluar/create'),
                'no_surat' => old('no_surat') ? old('no_surat') : '',
                'tgl_surat' => old('tgl_surat') ? old('tgl_surat') : date('d/m/Y'),
                'kepada' => old('kepada') ? old('kepada') : '',
                'lampiran' => old('lampiran') ? old('lampiran') : '',
                'perihal' => old('perihal') ? old('perihal') : '',
                'id_jenis_ttd_fk' => old('id_jenis_ttd_fk') ? old('id_jenis_ttd_fk') : '',
                'listPerangkat' => PerangkatDaerah::pluck('id_opd', 'nama_opd')->all(),
                'listJenis' => JenisPenandatangan::pluck('id_jenis_ttd', 'jenis_ttd')->all(),
                'qrcode' => '',
                'berkas' => '',

            ];
        return view('dashboard_page.kodeqr.form', $data);
    }

    public function create(Request $request)
    {
        $rule = KodeQR::$validationRule;
        if ($request->hasFile('berkas')) {
            $rule['berkas'] = 'max:5000|mimes:pdf';
        }
        $this->validate($request,
            $rule,
            [],
            KodeQR::$attributeRule,
        );

        if ($request->hasFile('berkas')) {
            $berkasFile = $request->file('berkas');
            $berkas = $this->uploadFile($berkasFile, 'berkas');
            $jenisTtd = JenisPenandatangan::find($request->input('id_jenis_ttd_fk'));
           /* if ($jenisTtd->cert != null && $jenisTtd->priv_key)
                $this->signPDF($berkas, $jenisTtd);*/

        } else {
            $berkas = null;
        }
//        $kodeqr = QrCode::size(100)->generate($request->input('no_surat'), base_path('kodeqr/'.$nameFile));
//        $image = QrCode::size(200)->errorCorrection('H')
//            ->generate('A simple example of QR code!');
//        return response($image)->header('Content-type', 'image/png');
        //$kodeqr->move('kodeqr' . '/', $nameFile);
        $dataCreate = array(
            'no_surat' => $request->input('no_surat'),
            'tgl_surat' => ubahformatTgl($request->input('tgl_surat')),
            'kepada' => $request->input('kepada'),
            'lampiran' => $request->input('lampiran'),
            'perihal' => $request->input('perihal'),
            'id_jenis_ttd_fk' => $request->input('id_jenis_ttd_fk'),
            'berkas' => $berkas,
            'created_by'=>Auth::user()->id
            //'qrcode' => $nameFile
        );

        $insert = KodeQR::create($dataCreate);

        $nameFile = round(microtime(true) * 1000) . '.svg';
        $generator = url('detail-surat-keluar/' . Hashids::encode($insert->id_qr));
        dd($generator);
        QrCode::size(500)->format('svg')->generate($generator, base_path('kodeqr/' . $nameFile));
        $dataMaster = KodeQR::find($insert->id_qr);
        $dataUpdate = [
            'qrcode' => $nameFile,
        ];
        $dataMaster->update($dataUpdate);
        if ($insert) :
            saveLogs('menambahkan data ' . $request->input('no_surat') . ' pada fitur surat keluar');
            return redirect(route('surat-keluar'))
                ->with('pesan_status', [
                    'tipe' => 'success',
                    'desc' => 'surat keluar berhasil ditambahkan',
                    'judul' => 'data surat keluar'
                ]);
        else :
            return redirect(route('surat-keluar.form'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'kodeqr gagal ditambahkan',
                    'judul' => 'Data surat keluar'
                ]);
        endif;

    }

    public function edit($id)
    {
        $checkData = KodeQR::find(Hashids::decode($id));
        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];
            $data =
                [
                    'mode' => 'ubah',
                    'action' => url('dashboard/surat-keluar/update/' . $id),
                    'no_surat' => old('no_surat') ? old('no_surat') : $dataMaster->no_surat,
                    'tgl_surat' => old('tgl_surat') ? old('tgl_surat') : TanggalIndo2($dataMaster->tgl_surat),
                    'kepada' => old('kepada') ? old('kepada') : $dataMaster->kepada,
                    'lampiran' => old('lampiran') ? old('lampiran') : $dataMaster->lampiran,
                    'perihal' => old('perihal') ? old('perihal') : $dataMaster->perihal,
                    'id_jenis_ttd_fk' => old('id_jenis_ttd_fk') ? old('id_jenis_ttd_fk') : $dataMaster->id_jenis_ttd_fk,
                    'qrcode' => $dataMaster->qrcode,
                    'berkas' => $dataMaster->berkas,
                    'listJenis' => JenisPenandatangan::pluck('id_jenis_ttd', 'jenis_ttd')->all()

                ];
            return view('dashboard_page.kodeqr.form', $data);
        else :
            return redirect(route('surat-keluar'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Surat Keluar tidak ditemukan',
                    'judul' => 'Halaman Surat Keluar'
                ]);
        endif;
    }

    public function update($id, Request $request)
    {
        $rule = KodeQR::$validationRule;
        $idDecode = Hashids::decode($id)[0];
        $dataMaster = KodeQR::find($idDecode);

      //  $rule['no_surat'] = 'required|unique:tbl_qrcode,no_surat,' . $idDecode . ',id_qr';
        if ($request->hasFile('berkas')) {
            $rule['berkas'] = 'max:1024|mimes:pdf';
        }
        $this->validate($request,
            $rule,
            [],
            KodeQR::$attributeRule,
        );

        if ($request->hasFile('berkas')) {
            $berkasFile = $request->file('berkas');
            $berkas = $this->uploadFile($berkasFile, 'berkas');
            $jenisTtd = JenisPenandatangan::find($request->input('id_jenis_ttd_fk'));
            if ($jenisTtd->cert != null && $jenisTtd->priv_key)
                $this->signPDF($berkas, $jenisTtd);

            $this->deleteFile('berkas', $dataMaster['berkas']);
        } else {
            $remove_berkas = $request->input('remove_berkas');
            if ($remove_berkas) :
                $this->deleteFile('berkas', $dataMaster['berkas']);
                $berkas = '';
            else :
                $berkas = $dataMaster->berkas;
            endif;
        }

        $dataUpdate = [
            'no_surat' => $request->input('no_surat'),
            'tgl_surat' => ubahformatTgl($request->input('tgl_surat')),
            'kepada' => $request->input('kepada'),
            'lampiran' => $request->input('lampiran'),
            'perihal' => $request->input('perihal'),
            'id_jenis_ttd_fk' => $request->input('id_jenis_ttd_fk'),
            'berkas' => $berkas,
        ];
        //simpan perubahan
        $update = $dataMaster->update($dataUpdate);

        if ($update) :
            saveLogs('memperbarui data ' . $request->input('no_surat') . ' pada fitur surat keluar');
            return redirect(route('surat-keluar'))
                ->with('pesan_status', [
                    'tipe' => 'success',
                    'desc' => 'Surat Keluar berhasil diupdate',
                    'judul' => 'Data Surat Keluar'
                ]);
        else :
            return redirect(url('dashboard/surat-keluar/edit/' . $id))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Surat Keluar gagal diupdate',
                    'judul' => 'Data Surat Keluar'
                ]);
        endif;
    }

    public function show($id)
    {
        $checkData = KodeQR::find(Hashids::decode($id));

        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];
            $data =
                [
                    'id_surat' => $dataMaster->id_qr,
                    'no_surat' => $dataMaster->no_surat,
                    'tgl_surat' => TanggalIndo2($dataMaster->tgl_surat),
                    'kepada' => $dataMaster->kepada,
                    'lampiran' => $dataMaster->lampiran,
                    'perihal' => $dataMaster->perihal,
                    'jenis_ttd' => JenisPenandatangan::where('id_jenis_ttd', $dataMaster->id_jenis_ttd_fk)->first()->jenis_ttd,
                    'qrcode' => $dataMaster->qrcode,
                    'status_surat' => $dataMaster->status_surat,
                    'berkas' => $dataMaster->berkas,
                    'listDetail' => DisposisiSuratKeluar::where('id_surat_keluar', Hashids::decode($id)[0])->orderBy('tgl_masuk', 'DESC')->get(),
                ];

            foreach ($data['listDetail'] as $key => $value){
                $temp_kepada = $value->kepada;
                $nama_level = getNamaLevel($temp_kepada);

                $data['listDetail'][$key]->kepada = $nama_level;
                $data['listDetail'][$key]->kode_level = $temp_kepada;
            }

            return view('dashboard_page.kodeqr.show', $data);
        else :
            return redirect(route('surat-keluar'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Surat Keluar tidak ditemukan',
                    'judul' => 'Halaman Surat Keluar'
                ]);
        endif;
    }

    public function print($id)
    {
        $checkData = KodeQR::find(Hashids::decode($id));
        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];
            $data =
                [
                    'qrcode' => $dataMaster->qrcode,
                ];
            return view('dashboard_page.kodeqr.print', $data);
        else :
            return redirect(route('surat-keluar'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Surat Keluar tidak ditemukan',
                    'judul' => 'Halaman Surat Keluar'
                ]);
        endif;
    }

    function signPDF($filePath, $certInfo)
    {
        $pdf = new FPDI('P', 'mm', 'A4');
        $pages = $pdf->setSourceFile(base_path('berkas/' . $filePath));
        $certificate = 'file://' . realpath('storage/app/public/' . $certInfo->cert);
        $priv_key = 'file://' . realpath('storage/app/public/' . $certInfo->priv_key);


// set additional information
        $info = array(
            'Name' => $certInfo->jenis_ttd,
            'Location' => 'Dirjen Bina Marga',
            'Reason' => 'Sebagai validasi surat terverifikasi elektronik.',
            'ContactInfo' => 'info@binamarga.pu.go.id',
        );
//        dd($certificate, $info);

        for ($i = 1; $i <= $pages; $i++) {
            $pdf->AddPage();
            $page = $pdf->importPage($i);
            $pdf->useTemplate($page, 0, 0);
            // set document signature
            $pdf->setSignature($certificate, $priv_key, '12345678', '', 2, $info);
        }
//        $pdf->setSi

        $pdf->Output(base_path('berkas/') . $filePath, "F");
    }

    function finishSurat(Request $request){
        //finish status surat nya, dan kasih footer signed
        $id_qr = $request->input('id_qr');
        $password = $request->input('password');

        $surat_keluar = KodeQR::find($id_qr);
        $user = User::find(Auth::user()->id);
        if (Hash::check($password, $user->password)) {
            $pdf = new FPDI('P', 'mm', 'A4');
            $pages = $pdf->setSourceFile(base_path('berkas/' . $surat_keluar->berkas));

            for ($i = 1; $i <= $pages; $i++) {
                // import a page
                $pdf->AddPage();
                $page = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($i);
              //  $templateId = $pdf->importPage($i);
                // get the size of the imported page
             //   $size = $pdf->getTemplateSize($templateId);

                // use the imported page
              //  $pdf->useTemplate($templateId);
                $pdf->useTemplate($page, 0, 0);

                $y = $size['height'] - 20;
                $pdf->SetFont('Helvetica');
                $pdf->SetFontSize(5);
                $pdf->SetXY(5,0);
                $pdf->Write(5, "Dokumen Telah Ditandatangi Secara Digital Oleh Dirjen Bina Marga RI");
            }
            // Output the new PDF
            $pdf->Output(base_path('berkas/') . $surat_keluar->berkas, "F");


            //update status nya
            $dataUpdate = [
                'status_surat' => "FINAL"
            ];
            //simpan perubahan
            $update = $surat_keluar->update($dataUpdate);

            //simpan log disposisi telah di ttd
            $dataInput = [
                'id_surat_keluar' => $id_qr,
                'tgl_masuk' => date("Y-m-d H:i:s"),
                'kepada' => "-",
                'catatan_disposisi' => "Ditandatangani oleh  ".$user->name,
                'status_disposisi' => "TINDAK LANJUT",
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];
            $insert = DisposisiSuratKeluar::create($dataInput);

            $cek = true;
        }else{
           $cek = false;
        }

        if ($cek) {
            saveLogs('finish surat '.$surat_keluar->perihal);
            return Respon('', true, 'Berhasil Finish Surat', 200);
        } else {
            return Respon('', false, 'Gagal finish surat', 200);
        }

    }

    public function statistik_tanda_tangan()
    {
        $data_grafik = v_bar_ttd_tahunan::selectRaw("SUM(jumlah) AS jumlah, id_jenis_ttd_fk, jenis_ttd")
            ->groupBy('id_jenis_ttd_fk')
            ->orderBy('id_jenis_ttd_fk', 'ASC')
            ->get();
        $data = [
            'kodeqr' => KodeQR::count(),
            'data_tahun' => KodeQR::tahun()->get(),
            'data_grafik' => $data_grafik
        ];
        return view('dashboard_page.jenis-penandatangan.statistik', $data);
    }

    public function tampil_grafik_ttd(Request $request)
    {
        if ($request->ajax()) {
            $tahun = $request->get('tahun');
            $bulan = $request->get('bulan');
            if ($tahun != "") {
                if ($bulan != "") {
                    $periode = $bulan . '-' . $tahun;
                    $query = v_bar_penandatangan::select('*')->where('periode', $periode)->groupBy('id_jenis_ttd_fk');
                } else {
                    $query = v_bar_ttd_tahunan::select('*')->where('periode', $tahun)->groupBy('id_jenis_ttd_fk');
                }
            } else {
                $query = v_bar_ttd_tahunan::selectRaw('SUM(jumlah) AS jumlah, id_jenis_ttd_fk, jenis_ttd')->groupBy('id_jenis_ttd_fk');
            }

            $data = $query->get();
            echo json_encode($data);
        }
        return false;
    }

    public function statistik_perangkat_daerah()
    {
        $data = [
            'kodeqr' => KodeQR::count(),
            'data_tahun' => KodeQR::tahun()->get(),
        ];
        return view('dashboard_page.perangkat-daerah.statistik', $data);
    }

    public function disposisi($id)
    {
        $checkData = KodeQR::find(Hashids::decode($id));
        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];

            $pembuat  = User::find($dataMaster->created_by);
            $bidang_pembuat = getNamaLevel($pembuat->level);

            $data =
                [
                    'id' => $id,
                    'no_surat' => $dataMaster->no_surat,
                    'tgl_surat' => TanggalIndo2($dataMaster->tgl_surat),
                    //'tgl_masuk' => TanggalIndo2($dataMaster->tgl_masuk),
                    'pengirim' => $dataMaster->pengirim,
                    'perihal' => $dataMaster->perihal,
                    'qrcode' => $dataMaster->qrcode,
                    'berkas' => $dataMaster->berkas,
                    'status_surat' => $dataMaster->status_surat,
                    'nama_pembuat'=>$pembuat->name,
                    'bidang_pembuat'=>$bidang_pembuat,
                    'listPerangkat' => PerangkatDaerah::pluck('id_opd', 'nama_opd')->all(),

                ];
            return view('dashboard_page.kodeqr.disposisi', $data);
        else :
            return redirect(route('surat-keluar'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Surat  tidak ditemukan',
                    'judul' => 'Halaman Surat Keluar'
                ]);
        endif;
    }

    public function dataDisposisi(Request $request, $id)
    {
        $data = DisposisiSuratKeluar::where('id_surat_keluar', Hashids::decode($id)[0]);
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('tgl_masuk', function ($row) {
                return TanggalIndowaktu($row->tgl_masuk);
            })
            ->editColumn('kepada', function ($row) {
                $kepada = $row->kepada;
                $nama_level = getNamaLevel($kepada);
                return $nama_level;
            })
            ->editColumn('status_disposisi', function ($row) {
                if ($row->status_disposisi == 'DITERUSKAN'):
                    $active = '<div class="text-primary font-weight-bolder"> DITERUSKAN </div>';
                elseif ($row->status_disposisi == 'DIKEMBALIKAN'):
                    $active = '<div class="text-danger font-weight-bolder"> DIKEMBALIKAN </div>';
                else:
                    $active = '<div class="text-success font-weight-bolder"> TINDAK LANJUT </div>';
                endif;
                return $active;
            })
            ->addColumn('action', function ($row) {

                $btn = '<div class="btn-group" role="group" aria-label="First group">';

                $editaksi = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-success waves-effect clickable-edit" title="Edit"
                                                       data-id="' . Hashids::encode($row->id) . '"
                                                       data-id_surat_keluar="' . Hashids::encode($row->id_surat_keluar) . '"
                                                       data-tgl_masuk="' . TanggalIndowaktu($row->tgl_masuk) . '"
                                                       data-kepada="' . $row->kepada . '"
                                                       data-catatan_disposisi="' . $row->catatan_disposisi . '"
                                                       data-status_disposisi="' . $row->status_disposisi . '"
                                                       ><i class="fa fa-edit"></i></a>';
                $deleteaksi = '<a href="javascript:void(0)" onclick="deleteData(' . "'" . Hashids::encode($row->id) . "'" . ')" class="btn btn-sm btn-icon btn-danger waves-effect" title="Hapus"><i class="fa fa-trash"></i></a>';
                if (Auth::user()->level == 'superadmin') {
                    $btn .= $editaksi;
                    $btn .= $deleteaksi;
                } else {
                    if ($row->created_by == Auth::user()->id) {
                        $btn .= $editaksi;
                        $btn .= $deleteaksi;
                    } else {
                        $btn .= '-';
                    }
                }
                $btn .= '</div>';
                return $btn;

            })
            ->escapeColumns([])
            ->toJson();
    }

    public function tampil_grafik_pd(Request $request)
    {
       /* if ($request->ajax()) {
            $tahun = $request->get('tahun');
            $bulan = $request->get('bulan');
            if ($tahun != "") {
                if ($bulan != "") {
                    $periode = $bulan . '-' . $tahun;
                    $query = v_bar_perangkat_daerah::select('*')->where('periode', $periode)->groupBy('id_opd_fk');
                } else {
                    $query = v_bar_opd_tahunan::select('*')->where('periode', $tahun)->groupBy('id_opd_fk');
                }
            } else {
                $query = v_bar_opd_tahunan::selectRaw('SUM(jumlah) AS jumlah, id_opd_fk, nama_opd, alias_opd')->groupBy('id_opd_fk');
            }

            $data = $query->get();
            echo json_encode($data);
        }
        return false;*/
    }
}
