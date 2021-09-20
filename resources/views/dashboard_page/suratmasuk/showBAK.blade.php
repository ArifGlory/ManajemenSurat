@extends('mylayouts.front')
@section('title', 'Detail Surat Masuk (QR)')
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
                <div class="col-sm-12 order-sm-0 order-lg-1 order-xl-1" style="display: none">
                    <div class="card">
                        <div class="card-header">
                            <h4>Disposisi Surat di Lingkungan {{getSetting('area')}}</h4>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover stripe"
                                   style="width:100%"
                                   id="hideyori_datatable">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Surat Diterima</th>
                                    <th>Penerima</th>
                                    <th>Status</th>
                                    <th>Disposisikan Kepada</th>
                                    <th>Catatan Disposisi</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 order-sm-0 order-lg-0 order-xl-0">
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
                                    <label class="col-sm-5 col-lg-5 col-form-label">3. Pengirim (INSTANSI)</label>

                                    <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                        {{$pengirim}}
                                    </label>
                                </div>
                            </div>
                            <hr class="mb-2">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-lg-5 col-form-label">4. Hal</label>

                                    <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                        {{$perihal}}
                                    </label>
                                </div>
                            </div>
                            @if($berkas)
                                <hr class="mb-2">
                                <div class="col-sm-12">
                                    <div class="row mb-3">
                                        <label class="col-sm-5 col-lg-5 col-form-label">5. Berkas</label>

                                        <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                            <a href="{{url('berkas/'.$berkas)}}" target="_blank">
                                                <img class="img-fluid" style="height: 75px"
                                                     src="{{url('uploads/pdf_icon.png')}}"
                                                     alt="image">
                                                <h2 class="mt-2 mb-2">Download Berkas</h2>
                                            </a>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="col-sm-12 order-sm-0 order-lg-1 order-xl-1">
                    <div id="tracking-pre"></div>
                    <div id="tracking" class="card">
                        <div class="text-center tracking-status-intransit">
                            <p class="tracking-status text-tight">TIMELINE DISPOSISI</p>
                        </div>
                        <div class="tracking-list">
                            @if(count($listDetail)>0)
                                @foreach($listDetail as $dt)
                                    @php

                                        if($dt->status=='diteruskan'):
                                            $status = '<label class="font-weight-bolder text-primary">DITERUSKAN</label>';
                                            $class_status = 'inforeceived';
                                        elseif($dt->status=='dihimpun'):
                                            $status = '<label class="font-weight-bolder text-dark">DIHIMPUN</label>';
                                            $class_status = 'delivered';
                                        elseif($dt->status=='tindak lanjut'):
                                            $status = '<label class="font-weight-bolder text-success">TINDAK LANJUT</label>';
                                            $class_status = 'deliveryoffice';
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
                                        <div class="tracking-content">Surat Diterima {{$dt->penerima}}
                                            <span>{!! $status !!} kepada {{$dt->kepada}}</span>
                                            <span>Catatan Disposisi : {{($dt->catatan_disposisi)}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{assetku('assets/modules/datatables/datatables.min.js')}}"></script>
    <script
        src="{{assetku('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{assetku('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{assetku('assets/modules/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{assetku('assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ assetku('assets/jshideyorix/general.js')}}"></script>
    <script src="{{ assetku('assets/jshideyorix/mydatatable.js')}}"></script>
    <script src="{{ assetku('assets/jshideyorix/deletertable.js')}}"></script>
    <script src="{{assetku('assets/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script>
        $(function () {
            table = $('#hideyori_datatable').DataTable({
                aLengthMenu: [
                    [10, 50, 100, -1],
                    [10, 50, 100, "All"]
                ],
                paging: true,
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ordering: false,
                order: [[1, "asc"]],
                {{--ajax: "{{ route('disposisi.data') }}",--}}
                ajax: {
                    url: "{{ url('show-disposisi/'.$id) }}",
                    type: "GET",
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {data: 'tgl_masuk', name: 'tgl_masuk', responsivePriority: -1},
                    {data: 'penerima', name: 'penerima'},
                    {data: 'status', name: 'status'},
                    {data: 'kepada', name: 'kepada'},
                    {data: 'catatan_disposisi', name: 'catatan_disposisi'},
                ],

                rowCallback: function (row, data, index) {

                },
                drawCallback: function () {

                },
                "error": function (xhr, error, thrown) {
                    console.log("Error occurred!");
                    console.log(xhr, error, thrown);
                }
            });
        });
    </script>
@endpush
