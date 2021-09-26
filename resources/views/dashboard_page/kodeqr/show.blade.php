@extends('mylayouts.front')
@section('title', 'Detail Surat Keluar (QR)')
@push('library-css')

@endpush
@push('vendor-css')
    <link rel="stylesheet" href="{{assetku('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet"
          href="{{assetku('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/css/tracking.css')}}">
@endpush
@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-sm-4 order-sm-0 order-lg-1 order-xl-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="empty-state">
                                @if($berkas)
                                    <a href="{{url('berkas/'.$berkas)}}" target="_blank">
                                        <img class="img-fluid" style="height: 75px"
                                             src="{{url('uploads/pdf_icon.png')}}"
                                             alt="image">
                                        <h2 class="mt-2 mb-2">Download Berkas</h2>
                                    </a>
                                @else
                                    <img class="img-fluid"
                                         src="{{url('surat-keluar/'.$qrcode)}}"
                                         alt="{{$no_surat}}">
                                    <h2 class="mt-2 mb-2">Surat Keluar (QR)</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 order-sm-0 order-lg-0 order-xl-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-lg-5 col-form-label">1. No Surat</label>

                                    <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                        {{$no_surat}}
                                    </label>
                                </div>
                            </div>
                            <hr class="mb-2">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-lg-5 col-form-label">2. Tgl Surat</label>

                                    <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                        {{$tgl_surat}}
                                    </label>
                                </div>
                            </div>
                            <hr class="mb-2">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-lg-5 col-form-label">4. Kepada</label>

                                    <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                        {{$kepada}}
                                    </label>
                                </div>
                            </div>
                            <hr class="mb-2">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-lg-5 col-form-label">5. Lampiran</label>

                                    <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                        {{$lampiran}}
                                    </label>
                                </div>
                            </div>
                            <hr class="mb-2">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-lg-5 col-form-label">6. Hal</label>

                                    <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                        {{$perihal}}
                                    </label>
                                </div>
                            </div>
                            <hr class="mb-2">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-lg-5 col-form-label">7. Ditandangani Oleh</label>

                                    <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                        {{$jenis_ttd}}
                                    </label>
                                </div>
                            </div>
                            <hr class="mb-2">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-lg-5 col-form-label">8. Status Surat</label>
                                    @if($status_surat == "DRAFT")
                                        <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                            <span class="badge badge-success"> {{$status_surat}} </span>
                                        </label>
                                    @else
                                        <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                            <span class="badge badge-primary"> {{$status_surat}} </span>
                                        </label>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-sm-12 order-sm-0 order-lg-1 order-xl-1">
                    <a href="{{url('dashboard/disposisi/' . $id_surat)}}" class="btn btn-success text-right mb-3" target="_blank"><i class="fas fa-edit"></i> Form Disposisi</a>
                    <div id="tracking-pre"></div>
                    <div id="tracking" class="card">
                        <div class="text-center tracking-status-intransit">
                            <p class="tracking-status text-tight">TIMELINE DISPOSISI</p>
                        </div>
                        <div class="tracking-list">
                            @if(isset($listDetail))
                                @if(count($listDetail)>0)
                                    @foreach($listDetail as $dt)
                                        @php

                                            if($dt->status=='diteruskan'):
                                                $status = '<label class="font-weight-bolder text-primary">DITERUSKAN</label>';
                                                $class_status = 'inforeceived';
                                            elseif($dt->status=='dikembalikan'):
                                                $status = '<label class="font-weight-bolder text-dark">DIKEMBALIKAN</label>';
                                                $class_status = 'deliveryoffice';
                                            elseif($dt->status=='tindak lanjut'):
                                                $status = '<label class="font-weight-bolder text-success">TINDAK LANJUT</label>';
                                                $class_status = 'delivered';
                                            else:
                                                $status = '<label class="font-weight-bolder text-success">-</label>';
                                                $class_status = 'delivered';
                                            endif;
                                        @endphp
                                        <div class="tracking-item">
                                            <div class="tracking-icon status-{{$class_status}}">
                                                <svg class="svg-inline--fa fa-user fa-w-12" aria-hidden="true"
                                                     data-prefix="fas" data-icon="user" role="img"
                                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                                     data-fa-i2svg="">
                                                </svg>
                                                <!-- <i class="fas fa-circle"></i> -->
                                            </div>
                                            <div class="tracking-date">{{TanggalIndoSimple($dt->tgl_masuk)}}
                                                <span>{{waktuaja($dt->tgl_masuk)}}</span></div>
                                            <div class="tracking-content">Surat Diterima {{$dt->kepada}}
                                                <span>{!! $status !!} kepada {{$dt->kepada}}</span>
                                                <span>Catatan Disposisi : {{($dt->catatan_disposisi)}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ assetku('assets/jshideyorix/general.js')}}"></script>
@endpush
