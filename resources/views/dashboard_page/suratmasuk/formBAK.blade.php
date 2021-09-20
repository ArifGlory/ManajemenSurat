@extends('mylayouts.app')
@section('title', 'Form '.ucwords($mode).' Surat Masuk (QR)')
@push('vendor-css')
    <link rel="stylesheet" href="{{ assetku('magnific-popup/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets//modules/bootstrap-daterangepicker/daterangepicker.css')}}">
    <style>
        .select_sm {
            height: 33.22222px !important;
            padding-bottom: 2px !important;
            padding-top: 2px !important;
            padding-right: 2px !important;
            padding-left: 2px !important;
        }
    </style>
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{'Form '.ucwords($mode).' Surat Masuk (QR)'}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('kode-qr')}}">Daftar Surat Masuk (QR)</a></div>
                <div class="breadcrumb-item active">{{'Form '.ucwords($mode).' Surat Masuk (QR)'}}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-sm-8 order-sm-0 order-lg-1 order-xl-1">
                    <div class="card">
                        <form id="form" name="form" role="form" action="{{$action}}"
                              enctype="multipart/form-data" method="post">
                            {{csrf_field()}}
                            @if($mode=='ubah')
                                {{ method_field('PUT') }}
                            @endif
                            <div class="card-body">
                                <div class="col-sm-12">
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-lg-3 col-form-label">No Surat</label>
                                        <div class="col-sm-9 col-lg-9">
                                            <div class="input-group">
                                 <span class="input-group-prepend">
                                 <label class="input-group-text">
                                 <i class="fa fa-list"></i></label>
                                 </span>
                                                <input class="form-control @error('no_surat') is-invalid @enderror"
                                                       required="required" name="no_surat" id="no_surat"
                                                       type="text" value="{{$no_surat}}" autofocus>
                                            </div>
                                            @error('no_surat')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-lg-3 col-form-label">Tgl Surat</label>
                                        <div class="col-sm-9 col-lg-9">
                                            <div class="input-group">
                                                          <span class="input-group-prepend">
                                                          <label class="input-group-text">
                                                          <i class="fa fa-calendar"></i></label>
                                                          </span>
                                                <input class="form-control @error('tgl_surat') is-invalid @enderror"
                                                       name="tgl_surat" id="tgl_surat"
                                                       type="text" value="{{$tgl_surat}}">
                                            </div>
                                            @error('tgl_surat')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-lg-3 col-form-label">Tgl Masuk</label>
                                        <div class="col-sm-9 col-lg-9">
                                            <div class="input-group">
                                                                                              <span
                                                                                                  class="input-group-prepend">
                                                                                              <label
                                                                                                  class="input-group-text">
                                                                                              <i class="fa fa-calendar"></i></label>
                                                                                              </span>

                                                <input
                                                    class="form-control datetimepickerindo @error('tgl_masuk') is-invalid @enderror"
                                                    name="tgl_masuk" id="tgl_masuk" type="text" value="{{$tgl_masuk}}"/>
                                            </div>
                                            @error('tgl_masuk')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-lg-3 col-form-label">Pengirim (INSTANSI)</label>
                                        <div class="col-sm-9 col-lg-9">
                                            <div class="input-group">
                                                                                              <span
                                                                                                  class="input-group-prepend">
                                                                                              <label
                                                                                                  class="input-group-text">
                                                                                              <i class="fa fa-user"></i></label>
                                                                                              </span>
                                                <input class="form-control @error('pengirim') is-invalid @enderror"
                                                       name="pengirim" id="pengirim"
                                                       type="text" value="{{$pengirim}}">
                                            </div>
                                            @error('pengirim')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-lg-3 col-form-label">Penerima</label>
                                        <div class="col-sm-9 col-lg-9">
                                            <div class="input-group">
                                                                                                                                 <span
                                                                                                                                     class="input-group-prepend">
                                                                                                                                 <label
                                                                                                                                     class="input-group-text">
                                                                                                                                 <i class="fa fa-user"></i></label>
                                                                                                                                 </span>
                                                <input class="form-control @error('penerima') is-invalid @enderror"
                                                       name="penerima" id="penerima"
                                                       type="text" value="{{$penerima}}">
                                            </div>
                                            @error('penerima')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-lg-3 col-form-label">Hal</label>
                                        <div class="col-sm-9 col-lg-9">
                                            <div class="input-group">
                                                                                                                                                                      <span
                                                                                                                                                                          class="input-group-prepend">
                                                                                                                                                                      <label
                                                                                                                                                                          class="input-group-text">
                                                                                                                                                                      <i class="fa fa-align-right"></i></label>
                                                                                                                                                                      </span>
                                                <input class="form-control @error('perihal') is-invalid @enderror"
                                                       name="perihal" id="perihal"
                                                       type="text" value="{{$perihal}}">
                                            </div>
                                            @error('perihal')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-lg-3 col-form-label">@if($berkas) Ubah @else
                                                Unggah @endif Berkas</label>
                                        <div class="col-sm-9 col-lg-9">
                                            <input name="berkas" id="berkas" type="file"
                                                   class="form-control"
                                                   accept="application/pdf">
                                            @if($berkas)
                                                <br/>
                                                <a href="{{url('berkas/'.$berkas)}}" target="_blank">Lihat Berkas saat
                                                    ini</a>
                                                <br/>
                                                <input type="checkbox" name="remove_berkas"
                                                       value="{{$berkas}}">
                                                Hapus
                                                Berkas
                                                Ketika Disimpan
                                            @endif
                                            @error('berkas')
                                            <p style="color:red">
                                                {{$message}}
                                            </p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-right bg-whitesmoke">
                                @if($mode=='tambah')
                                    <button type="reset" class="btn btn-secondary mr-2">Reset Form</button>
                                @endif
                                <button type="submit" class="btn btn-primary mr-2"><i class="mr-50 fa fa-save"></i>
                                    @if($mode=='ubah') Simpan Perubahan @else Submit @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4 order-sm-0 order-lg-0 order-xl-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="empty-state">
                                @if($mode=='ubah')
                                    <img class="img-fluid"
                                         src="{{url('kodeqr/'.$qrcode)}}"
                                         alt="image">
                                    <h2 class="mt-2 mb-4">Surat Masuk (QR) saat ini</h2>
                                @else
                                    <img class="img-fluid"
                                         src="{{assetku('assets/img/drawkit/revenue-graph-colour.svg')}}"
                                         alt="image">
                                    <h2 class="mt-2 mb-2">Isi Lengkap Data Surat Masuk (QR)</h2>
                                @endif

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <div class="alert-body">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{assetku('assets/modules/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{assetku('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{ assetku('magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ assetku('assets/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ assetku('assets/jshideyorix/general.js')}}"></script>
    <!--begin::Page Scripts(used by this page)-->
    <script type="text/javascript">
        @if(session('pesan_status'))
        tampilPesan('{{session('pesan_status.tipe')}}', '{{session('pesan_status.desc')}}', '{{session('pesan_status.judul')}}');
        @endif

        if (jQuery().daterangepicker) {
            if ($("#tgl_surat").length) {
                $('#tgl_surat').daterangepicker({
                    locale: {format: 'DD/MM/YYYY'},
                    singleDatePicker: true,
                });
            }
            // if ($("#tgl_masuk").length) {
            //     $('#tgl_masuk').daterangepicker({
            //         locale: {format: 'DD/MM/YYYY'},
            //         singleDatePicker: true,
            //     });
            // }

            if ($(".datetimepickerindo").length) {
                $('.datetimepickerindo').daterangepicker({
                    locale: {format: 'DD/MM/YYYY HH:mm'},
                    singleDatePicker: true,
                    timePicker: true,
                    timePicker24Hour: true,
                });
            }

        }
    </script>
@endpush
