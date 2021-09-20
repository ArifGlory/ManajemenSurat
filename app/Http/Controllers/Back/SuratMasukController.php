<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Disposisi;
use App\Models\Opd;
use App\Models\PerangkatDaerah;
use App\Models\SuratMasuk;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use QrCode;
use Vinkla\Hashids\Facades\Hashids;

class SuratMasukController extends Controller
{
    public function index()
    {
        $data = [
        ];
        return view('dashboard_page.suratmasuk.index', $data);
    }

    public function data(Request $request)
    {
        $data = SuratMasuk::select('*');
        $tgl_mulai = ($request->get('tgl_mulai'));
        $tgl_akhir = ($request->get('tgl_akhir'));
        if ($tgl_mulai && $tgl_akhir) :
            $tgl_mulaiFormat = ubahformatTgl($tgl_mulai);
            $tgl_akhirFormat = ubahformatTgl($tgl_akhir);
            $data = $data->whereBetween('tgl_surat', [$tgl_mulaiFormat, $tgl_akhirFormat]);
        endif;

        if (Auth::user()->level == 'disposisi'):
            $nama_opd = User::perangkat()->where('id', Auth::user()->id)->first()->nama_opd;
            $cekDataIdSuratMasuk = Disposisi::where('penerima', $nama_opd)->orWhere('kepada', $nama_opd)->distinct()->get(['id_sm_fk'])->pluck('id_sm_fk')->toArray();

            $data = $data->where('id', $cekDataIdSuratMasuk);
        endif;

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($row) {
                $checkbox = '<input type="checkbox" value="' . Hashids::encode($row->id) . '" class="data-check">';
                return $checkbox;
            })
            ->editColumn('id', function ($row) {
                return Hashids::encode($row->id);
            })
            ->editColumn('no_surat', function ($row) {
                $no_surat = '<label class="font-weight-bolder">' . $row->no_surat . '</label>';
                return $no_surat;
            })
            ->editColumn('tgl_surat', function ($row) {
                return $row->tgl_surat ? tanggalIndo($row->tgl_surat) : '';
            })
            ->editColumn('qrcode', function ($row) {
                $qrcode = $row->qrcode ? url('kodeqr/' . $row->qrcode) : url('uploads/blank.png');
                $showimage = '<a class="image-popup-no-margins" href="' . $qrcode . '"><img src="' . $qrcode . '" width="50px"></a>';
                return $showimage;
            })
            ->editColumn('disposisi', function ($row) {
                $btn = '<a href="' . url('dashboard/disposisi/' . Hashids::encode($row->id)) . '" class="btn btn-sm btn-primary waves-effect" title="Disposisi"><i class="fa fa-forward"></i> Disposisi</a>';
                return $btn;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group" role="group" aria-label="First group">';
                //$btn .= '<a href="' . url('dashboard/disposisi/' . $row->qrcode) . '" class="btn btn-sm btn-icon btn-info waves-effect" title="Disposisi"><i class="fa fa-forward"></i></a>';
                if (Auth::user()->level !='disposisi') :
                $btn .= '<a href="' . url('kodeqr/' . $row->qrcode) . '" class="btn btn-sm btn-icon btn-info waves-effect" target="_blank" title="Download"><i class="fa fa-download"></i></a>';
                $btn .= '<a href="' . url('dashboard/surat-masuk/print/' . Hashids::encode($row->id)) . '" target="_blank" class="btn btn-sm btn-icon btn-dark waves-effect" title="Print"><i class="fa fa-print"></i></a>';
                endif;
                $btn .= '<a href="' . url('surat-masuk/' . Hashids::encode($row->id)) . '" target="_blank" class="btn btn-sm btn-icon btn-primary waves-effect" title="Detail"><i class="fa fa-eye"></i></a>';
                if (Auth::user()->level == 'superadmin' || Auth::user()->level == 'umum') :
                    $btn .= '<a href="' . url('dashboard/surat-masuk/edit/' . Hashids::encode($row->id)) . '" class="btn btn-sm btn-icon btn-success waves-effect" title="Edit"><i class="fa fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0)" onclick="deleteData(' . "'" . Hashids::encode($row->id) . "'" . ')" class="btn btn-sm btn-icon btn-danger waves-effect" title="Hapus"><i class="fa fa-trash"></i></a>';
                endif;
                $btn .= '</div>';
                return $btn;
            })
            ->escapeColumns([])
            ->toJson();
    }

    public function dataBAK(Request $request)
    {
        if ($request->ajax()) {
            $kepada = $request->get('kepada');
            $id_jenis_ttd = $request->get('id_jenis_ttd');
            $tgl_mulai = ($request->get('tgl_mulai'));
            $tgl_akhir = ($request->get('tgl_akhir'));
            $cari = $request->get('cari');
            $arrayList = $request->get('arrayList');
            $paginateList = [12, 24, 50, 100];
            $page_count = $request->get('page_count');
            $countPaginate = $page_count ? $page_count : 12;

            $eloSuratMasuk = SuratMasuk::orderBy('created_at', 'DESC');

            if ($kepada) :
                $dataSuratMasuk = $eloSuratMasuk->where('kepada', $kepada);
            endif;

            if ($id_jenis_ttd) :
                $dataSuratMasuk = $eloSuratMasuk->where('id_jenis_ttd', $id_jenis_ttd);
            endif;

            if ($tgl_mulai && $tgl_akhir) :
                $tgl_mulaiFormat = ubahformatTgl($tgl_mulai);
                $tgl_akhirFormat = ubahformatTgl($tgl_akhir);
                $dataSuratMasuk = $eloSuratMasuk->whereBetween('tgl_surat', [$tgl_mulaiFormat, $tgl_akhirFormat]);
            endif;

            if ($cari) :
                $dataSuratMasuk = $eloSuratMasuk->where('no_surat', 'like', "%" . $cari . "%");
            endif;

            $dataSuratMasuk = $eloSuratMasuk->paginate($countPaginate);

            $data = [
                "listQR" => $dataSuratMasuk,
                "arrayList" => $arrayList != null ? $arrayList : [],
                "page_count" => $page_count,
                "paginateList" => $paginateList,
            ];
            return view('dashboard_page.suratmasuk.data', $data)->render();
        } else {
            return false;
        }
    }

    public function destroy($id)
    {
        $this->destroyBerkas($id, SuratMasuk::class, 'berkas', 'berkas', '');
        $this->destroyFunction($id, SuratMasuk::class, 'qrcode', 'no_surat', 'Surat Masuk', 'suratmasuk', '');
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
            $this->destroyBerkas($id, SuratMasuk::class, 'berkas', 'berkas', '');
            $this->destroyFunction($id, SuratMasuk::class, 'qrcode', 'no_surat', 'Surat Masuk', 'suratmasuk', '');
        }
        return Respon('', true, 'Berhasil menghapus beberapa data', 200);
    }

    public function form()
    {
        $data =
            [
                'mode' => 'tambah',
                'action' => url('dashboard/surat-masuk/create'),
                'no_surat' => old('no_surat') ? old('no_surat') : '',
                'tgl_surat' => old('tgl_surat') ? old('tgl_surat') : date('d/m/Y'),
                'tgl_masuk' => old('tgl_masuk') ? old('tgl_masuk') : date('d/m/Y H:i'),
                'pengirim' => old('pengirim') ? old('pengirim') : '',
                //'penerima' => old('penerima') ? old('penerima') : 'Biro Umum',
                'perihal' => old('perihal') ? old('perihal') : '',
                'qrcode' => '',
                'berkas' => '',

            ];
        return view('dashboard_page.suratmasuk.form', $data);
    }

    public function create(Request $request)
    {
        $rule = SuratMasuk::$validationRule;
        $rule['no_surat'] = 'required|unique:tbl_surat_masuk,no_surat';
        if ($request->hasFile('berkas')) {
            $rule['berkas'] = 'max:1024|mimes:pdf';
        }
        $this->validate($request,
            $rule,
            [],
            SuratMasuk::$attributeRule,
        );

        if ($request->hasFile('berkas')) {
            $berkasFile = $request->file('berkas');
            $berkas = $this->uploadFile($berkasFile, 'berkas');

        } else {
            $berkas = null;
        }

        $dataCreate = array(
            'no_surat' => $request->input('no_surat'),
            'tgl_surat' => ubahformatTgl($request->input('tgl_surat')),
            //'tgl_masuk' => DateTimeFormatDB($request->input('tgl_masuk')),
            'pengirim' => $request->input('pengirim'),
            // 'penerima' => $request->input('penerima'),
            'perihal' => $request->input('perihal'),
            'berkas' => $berkas,
            //'qrcode' => $nameFile
        );

        $insert = SuratMasuk::create($dataCreate);

        $nameFile = round(microtime(true) * 1000) . '.svg';
        $generator = url('surat-masuk/' . Hashids::encode($insert->id));
        QrCode::size(500)->format('svg')->generate($generator, base_path('kodeqr/' . $nameFile));
        $dataMaster = SuratMasuk::find($insert->id);
        $dataUpdate = [
            'qrcode' => $nameFile,
        ];
        $dataMaster->update($dataUpdate);
        if ($insert) :
            $id_sm_fk = $insert->id;
            if (Auth::user()->level != 'superadmin') {
                $penerima = User::perangkat()->where('id', Auth::user()->id)->first()->nama_opd;
            } else {
                $penerima = 'Biro Umum';
            }
            $kepada = 'Biro Administrasi Pimpinan';
            $catatan_disposisi = '-';
            $status = 'diteruskan';
            $dataInput = [
                'id_sm_fk' => $id_sm_fk,
                'tgl_masuk' => DateTimeFormatDB($request->input('tgl_masuk')),
                'penerima' => $penerima,
                'kepada' => $kepada,
                'catatan_disposisi' => $catatan_disposisi,
                'status' => $status,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];
            Disposisi::create($dataInput);
            saveLogs('menambahkan data ' . $request->input('no_surat') . ' pada fitur surat masuk');
            return redirect(route('surat-masuk'))
                ->with('pesan_status', [
                    'tipe' => 'success',
                    'desc' => 'surat masuk berhasil ditambahkan',
                    'judul' => 'data surat masuk'
                ]);
        else :
            return redirect(route('surat-masuk.form'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'surat masuk gagal ditambahkan',
                    'judul' => 'Data surat masuk'
                ]);
        endif;

    }

    public function edit($id)
    {
        $checkData = SuratMasuk::find(Hashids::decode($id));
        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];
            if (Auth::user()->level != 'superadmin') {
                $penerima = User::perangkat()->where('id', Auth::user()->id)->first()->nama_opd;
            } else {
                $penerima = 'Biro Umum';
            }
            $dataMasterDisposisiAwal = Disposisi::where('id_sm_fk', Hashids::decode($id)[0])->where('penerima', $penerima)->where('kepada', 'Biro Administrasi Pimpinan')->orderBy('id', 'ASC')->first();
            $data =
                [
                    'mode' => 'ubah',
                    'action' => url('dashboard/surat-masuk/update/' . $id),
                    'no_surat' => old('no_surat') ? old('no_surat') : $dataMaster->no_surat,
                    'tgl_surat' => old('tgl_surat') ? old('tgl_surat') : TanggalIndo2($dataMaster->tgl_surat),
                    'tgl_masuk' => old('tgl_surat') ? old('tgl_surat') : TanggalIndowaktu($dataMasterDisposisiAwal->tgl_masuk),
                    'pengirim' => old('pengirim') ? old('pengirim') : $dataMaster->pengirim,
                    //   'penerima' => old('penerima') ? old('penerima') : $dataMaster->penerima,
                    'perihal' => old('perihal') ? old('perihal') : $dataMaster->perihal,
                    'qrcode' => $dataMaster->qrcode,
                    'berkas' => $dataMaster->berkas,

                ];
            return view('dashboard_page.suratmasuk.form', $data);
        else :
            return redirect(route('surat-masuk'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Surat Masuk tidak ditemukan',
                    'judul' => 'Halaman Surat Masuk'
                ]);
        endif;
    }

    public function update($id, Request $request)
    {
        $rule = SuratMasuk::$validationRule;
        $idDecode = Hashids::decode($id)[0];
        $dataMaster = SuratMasuk::find($idDecode);

        $rule['no_surat'] = 'required|unique:tbl_qrcode,no_surat,' . $idDecode . ',id';
        if ($request->hasFile('berkas')) {
            $rule['berkas'] = 'max:1024|mimes:pdf';
        }
        $this->validate($request,
            $rule,
            [],
            SuratMasuk::$attributeRule,
        );

        if ($request->hasFile('berkas')) {
            $berkasFile = $request->file('berkas');
            $berkas = $this->uploadFile($berkasFile, 'berkas');

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
            //'tgl_masuk' => DateTimeFormatDB($request->input('tgl_masuk')),
            'pengirim' => $request->input('pengirim'),
            //'penerima' => $request->input('penerima'),
            'perihal' => $request->input('perihal'),
            'berkas' => $berkas,
        ];
        //simpan perubahan
        $update = $dataMaster->update($dataUpdate);

        if ($update) :
            if (Auth::user()->level != 'superadmin') {
                $penerima = User::perangkat()->where('id', Auth::user()->id)->first()->nama_opd;
            } else {
                $penerima = 'Biro Umum';
            }
            $dataMasterDisposisiAwal = Disposisi::where('id_sm_fk', $idDecode)->where('penerima', $penerima)->where('kepada', 'Biro Administrasi Pimpinan')->orderBy('id', 'ASC')->first()->id;
            if ($dataMasterDisposisiAwal != null) {
                $dataUpdateDisposisi = [
                    'tgl_masuk' => DateTimeFormatDB($request->input('tgl_masuk')),
                ];
                $dataMasterDisposisiAwal->update($dataUpdateDisposisi);
            }
            saveLogs('memperbarui data ' . $request->input('no_surat') . ' pada fitur surat masuk');
            return redirect(route('surat-masuk'))
                ->with('pesan_status', [
                    'tipe' => 'success',
                    'desc' => 'Surat Masuk berhasil diupdate',
                    'judul' => 'Data Surat Masuk'
                ]);
        else :
            return redirect(url('dashboard/surat-masuk/edit/' . $id))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Surat Masuk gagal diupdate',
                    'judul' => 'Data Surat Masuk'
                ]);
        endif;
    }

    public function show($id)
    {
        $checkData = SuratMasuk::find(Hashids::decode($id));
        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];
            $data =
                [
                    'id' => $id,
                    'no_surat' => $dataMaster->no_surat,
                    'tgl_surat' => TanggalIndo2($dataMaster->tgl_surat),
                    // 'tgl_masuk' => TanggalIndo2($dataMaster->tgl_masuk),
                    'pengirim' => $dataMaster->pengirim,
                    // 'penerima' => $dataMaster->penerima,
                    'perihal' => $dataMaster->perihal,
                    'qrcode' => $dataMaster->qrcode,
                    'berkas' => $dataMaster->berkas,
                    'listDetail' => Disposisi::where('id_sm_fk', Hashids::decode($id)[0])->orderBy('tgl_masuk', 'DESC')->get(),
                ];
            return view('dashboard_page.suratmasuk.show', $data);
        else :
            return redirect(route('surat-masuk'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Surat Masuk tidak ditemukan',
                    'judul' => 'Halaman Surat Masuk'
                ]);
        endif;
    }

    public function print($id)
    {
        $checkData = SuratMasuk::find(Hashids::decode($id));
        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];
            $data =
                [
                    'qrcode' => $dataMaster->qrcode,
                ];
            return view('dashboard_page.suratmasuk.print', $data);
        else :
            return redirect(route('surat-masuk'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Surat Masuk tidak ditemukan',
                    'judul' => 'Halaman Surat Masuk'
                ]);
        endif;
    }


    public function disposisi($id)
    {
        $checkData = SuratMasuk::find(Hashids::decode($id));
        if (count($checkData) > 0) :
            $dataMaster = $checkData[0];
            if (Auth::user()->level != 'superadmin') {
                $penerima = User::perangkat()->where('id', Auth::user()->id)->first()->nama_opd;
            } else {
                $penerima = '';
            }
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
                    'listPerangkat' => PerangkatDaerah::pluck('id_opd', 'nama_opd')->all(),
                    'penerima' => $penerima,


                ];
            return view('dashboard_page.suratmasuk.disposisi', $data);
        else :
            return redirect(route('surat-masuk'))
                ->with('pesan_status', [
                    'tipe' => 'error',
                    'desc' => 'Surat Masuk tidak ditemukan',
                    'judul' => 'Halaman Surat Masuk'
                ]);
        endif;
    }

    public function dataDisposisi(Request $request, $id)
    {
        //$data = Disposisi::suratmasuk();
        //$data->where('id_sm_fk', Hashids::decode($id)[0]);
        $data = Disposisi::where('id_sm_fk', Hashids::decode($id)[0]);
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('tgl_masuk', function ($row) {
                return TanggalIndowaktu($row->tgl_masuk);
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 'diteruskan'):
                    $active = '<div class="text-primary font-weight-bolder"> DITERUSKAN </div>';
                elseif ($row->status == 'dihimpun'):
                    $active = '<div class="text-dark font-weight-bolder"> DIHIMPUN </div>';
                else:
                    $active = '<div class="text-success font-weight-bolder"> TINDAK LANJUT </div>';
                endif;
                return $active;
            })
            ->addColumn('action', function ($row) {

                $btn = '<div class="btn-group" role="group" aria-label="First group">';

                $editaksi = '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-success waves-effect clickable-edit" title="Edit"
                                                       data-id="' . Hashids::encode($row->id) . '"
                                                       data-id_sm_fk="' . $row->id_sm_fk . '"
                                                       data-tgl_masuk="' . TanggalIndowaktu($row->tgl_masuk) . '"
                                                       data-penerima="' . $row->penerima . '"
                                                       data-kepada="' . $row->kepada . '"
                                                       data-catatan_disposisi="' . $row->catatan_disposisi . '"
                                                       data-status="' . $row->status . '"
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

    public function dataDisposisiShow(Request $request, $id)
    {
        //$data = Disposisi::suratmasuk();
        $data = Disposisi::where('id_sm_fk', Hashids::decode($id)[0]);
        //$data->where('id_sm_fk', Hashids::decode($id)[0]);
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('tgl_masuk', function ($row) {
                return TanggalIndowaktu($row->tgl_masuk);
            })
            ->editColumn('status', function ($row) {
                if ($row->status == 'diteruskan'):
                    $active = '<div class="text-primary font-weight-bolder"> DITERUSKAN </div>';
                elseif ($row->status == 'dihimpun'):
                    $active = '<div class="text-dark font-weight-bolder"> DIHIMPUN </div>';
                else:
                    $active = '<div class="text-success font-weight-bolder"> TINDAK LANJUT </div>';
                endif;
                return $active;
            })
            ->escapeColumns([])
            ->toJson();
    }
}
