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
                    @if($status_surat != "FINAL")
                        @if(Auth::user()->level == $listDetail[0]->kode_level)
                            <button onclick="add()" class="btn btn-primary text-right mb-3"><i class="fas fa-check"></i> Tanda Tangani</button>
                            <a href="{{url('dashboard/disposisi-surat-keluar/' . Hashids::encode($id_surat))}}" class="btn btn-success text-right mb-3" target="_blank"><i class="fas fa-edit"></i> Form Disposisi</a>
                        @else
                            <a href="{{url('dashboard/disposisi-surat-keluar/' . Hashids::encode($id_surat))}}" class="btn btn-success text-right mb-3" target="_blank"><i class="fas fa-edit"></i> Form Disposisi</a>
                        @endif
                    @endif


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

                                            if($dt->status_disposisi=='DITERUSKAN'):
                                                $status = '<label class="font-weight-bolder text-primary">DITERUSKAN</label>';
                                                $class_status = 'inforeceived';
                                            elseif($dt->status_disposisi=='DIKEMBALIKAN'):
                                                $status = '<label class="font-weight-bolder text-dark">DIKEMBALIKAN</label>';
                                                $class_status = 'deliveryoffice';
                                            elseif($dt->status_disposisi=='TINDAK LANJUT'):
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
                                            @if($dt->status_disposisi=='TINDAK LANJUT')
                                                <div class="tracking-content">{!! $status !!}
                                                    <span>Catatan Disposisi : {{($dt->catatan_disposisi)}}</span>
                                                </div>
                                            @else
                                                <div class="tracking-content">{!! $status !!} Kepada  {{$dt->kepada}}
                                                    <span>Catatan Disposisi : {{($dt->catatan_disposisi)}}</span>
                                                </div>
                                            @endif

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

    <!-- Modal -->
    <div
        class="modal fade"
        id="modal_form"

        role="dialog"
        aria-labelledby="exampleModalScrollableTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form class="form form-horizontal" id="form" name="form" method="post"
                      enctype="multipart/form-data" action="javascript:save();">
                    <div class="modal-header bg-dark text-white" style="padding-top: 10px; padding-bottom: 10px">
                        <h6 class="modal-title" id="judul">Tanda Tangani Surat</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="row">


                            <div class="col-12">
                                <div class="form-group">
                                    <div class="text-left">
                                        <input type="hidden" id="id_qr" class="form-control" value="{{$id_surat}}" name="id_qr">
                                        <label>Konfirmasi Password</label>
                                        <input required class="form-control" type="password" name="password" placeholder="Konfirmasi Password anda">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p class="font-italic">Dengan menekan tombol submit, surat akan ditandatangani secara digital, dan status surat akan diubah menjadi <strong>FINAL</strong> </p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke">
                        <button type="submit" id="btnsave"
                                class="btn btn-primary mr-1 waves-effect waves-float waves-light">
                            <i class="fa fa-save"></i> <span id="teksSimpan"> Submit</span>
                        </button>
                        <button type="button" id="btnbatal" onclick="add()"
                                class="btn btn-outline-secondary waves-effect"
                                style="display: none">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ assetku('assets/jshideyorix/general.js')}}"></script>
    <script>
        function add() {
            $('#modal_form').modal();
            $('#modal_form').appendTo("body");
            $('#modal_form').modal('show'); // show bootstrap modal
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-control').removeClass('is-invalid'); // clear error class
            $('.invalid-feedback').empty(); // clear error string
        }

        function save() {
            var url;
            var _method;
            var id;
            var formData = new FormData($('#form')[0]);
            id = '';
            url = "{{ url('dashboard/surat-keluar/finish-surat') }}";
            _method = "POST";

            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: url,
                type: 'POST',
                data: formData,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    if (data.status) //if success close modal and reload ajax table
                    {
                        iziToast.success({
                            title: 'Sukses',
                            message: 'Berhasil Finish Surat',
                            position: 'topRight'
                        });
                        $('#modal_form').modal('hide');
                        location.reload();
                    } else {
                        iziToast.error({
                            title: 'Gagal',
                            message: 'Konfirmasi Password anda salah',
                            position: 'topRight'
                        });
                    }
                },
                error: function (xhr) {
                    iziToast.error({
                        title: 'Error',
                        message: xhr.responseText,
                        position: 'topRight'
                    });
                }
            });
        }
    </script>
@endpush
