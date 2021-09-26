@extends('mylayouts.app')
@section('title', 'Surat Keluar ')
@push('vendor-css')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link rel="stylesheet" href="{{ assetku('magnific-popup/magnific-popup.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets//modules/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet"
          href="{{assetku('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">

@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Surat Keluar </h1>
            <div class="section-header-button">
                <a href="{{ route('surat-keluar.form') }}"
                   class="btn btn-primary btn-sm"><i
                        class="fa fa-plus mr-50"></i>
                    Tambah
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Daftar Surat Keluar</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                {{--<div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-row mb-3">
                                        <div class="col-lg-12">
                                            <label>Ditandantangani oleh :</label>
                                            <select class="form-control select2"
                                                    style="width: 100%;" name="id_opd_fk" id="id_opd_fk">
                                                <option value="">Seluruh</option>
                                                @foreach($listJenis as $nama => $value)
                                                    <option
                                                        value={{$value}}>{{$nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-row mb-3">
                                        <div class="col-lg-12">
                                            <label>Dari Tanggal :</label>
                                            <input class="form-control datepickerindo" placeholder=""
                                                   name="tgl_mulai"
                                                   id="tgl_mulai"
                                                   type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-row mb-3">
                                        <div class="col-lg-12">
                                            <label>Sampai Tanggal :</label>
                                            <input class="form-control datepickerindo" placeholder=""
                                                   name="tgl_akhir" id="tgl_akhir" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-row mb-3">
                                        <div class="col-lg-12">
                                            <label>Pencarian :</label>
                                            <input class="form-control" placeholder="Cari Nomor Surat"
                                                   name="textSearch" id="textSearch" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-right">
                                    <button class="btn btn-outline-info btn-sm" onclick="getViewData(1)"
                                            type="button"
                                            id="btnubah">
                                        <i class="fa fa-undo"></i> Saring Data
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>--}}

                <div class="col-md-12">
                    <div class="alert alert-warning">
                        Klik pada Gambar QRCode untuk memperbesar
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered" id="hideyori_datatable">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all"></th>
                                    <th>No.</th>
                                    <th>No Surat</th>
                                    <th>Tanggal Surat</th>
                                    {{--                            <th>Pejabat / Perangkat Daerah</th>--}}
                                    {{--                            <th>Kepada</th>--}}
                                    <th>Perihal</th>
                                    {{--                            <th>Jenis Penandatangan</th>--}}
                                    <th>QRCODE</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <!--begin::Dropdown-->
                            <div class="dropdown d-inline">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pilih Opsi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item has-icon" href="javascript:bulkDelete()"><i
                                            class="fa fa-trash text-danger"></i> Hapus yang dipilih</a>
                                </div>
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
    <script src="{{ assetku('assets/jshideyorix/general.js')}}"></script>
    <script src="{{ assetku('magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ assetku('assets/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{assetku('assets/modules/datatables/datatables.min.js')}}"></script>
    <script
        src="{{assetku('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{assetku('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ assetku('assets/jshideyorix/mydatatable.js')}}"></script>
    <script src="{{ assetku('assets/jshideyorix/deletertable.js')}}"></script>
    <!--begin::Page Scripts(used by this page)-->
    <script type="text/javascript">
        $(function () {
            @if(session('pesan_status'))
            tampilPesan('{{session('pesan_status.tipe')}}', '{{session('pesan_status.desc')}}', '{{session('pesan_status.judul')}}');
            @endif
        });

        $(function () {
            table = $('#hideyori_datatable').DataTable({
                aLengthMenu: [
                    [25, 50, 100, -1],
                    [25, 50, 100, "All"]
                ],
                paging: true,
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                {{--ajax: "{{ route('perangkat-daerah.data') }}",--}}
                ajax: {
                    url: "{{ route('surat-keluar.data') }}",
                    type: "GET",
                    data: function (d) {
                        d.id_jenis_ttd = $("#id_jenis_ttd").val();
                        d.tgl_mulai = $("#tgl_mulai").val();
                        d.tgl_akhir = $("#tgl_akhir").val();
                    }
                },
                order: [[2, "asc"]],
                columns: [

                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {data: 'no_surat', name: 'no_surat', responsivePriority: -1},
                    {data: 'tgl_surat', name: 'tgl_surat', responsivePriority: -1},
                    // {data: 'nama_opd', name: 'nama_opd', responsivePriority: -1},
                    // {data: 'kepada', name: 'kepada', responsivePriority: -1},
                    {data: 'perihal', name: 'perihal', responsivePriority: -1},
                    // {data: 'jenis_ttd', name: 'jenis_ttd', responsivePriority: -1},
                    {data: 'qrcode', name: 'qrcode', orderable: false, searchable: false, className: 'text-center'},
                    {data: 'status_surat', name: 'status_surat', orderable: false, searchable: false, className: 'text-center'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
                ],

                rowCallback: function (row, data, index) {
                    cellValue = data['id_qr'];
                    // console.log(cellValue);
                    var html = $(row);
                    if (array_data.includes(cellValue, 0)) {
                        var input = html.find('input[type=checkbox]').prop('checked', 'checked')
                    }
                },
                drawCallback: function () {
                    $('.data-check').on('change', function () {
                        console.log($(this).val());
                        if ($(this).is(':checked')) {
                            array_data.push($(this).val())
                        } else {
                            var index = array_data.indexOf($(this).val());
                            if (index !== -1) {
                                array_data.splice(index, 1);
                            }
                        }
                    });
                    initMagnific();
                },
                "error": function (xhr, error, thrown) {
                    console.log("Error occurred!");
                    console.log(xhr, error, thrown);
                }
            });
        });

        if (jQuery().daterangepicker) {

            var fromDate = new Date();
            $("#tgl_mulai").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoApply: true,
                    locale: {
                        format: 'DD/MM/YYYY'
                    },
                    autoUpdateInput: false,
                },
                function (start, end, label) {
                    $("#tgl_mulai").val(start.format('DD/MM/YYYY'));
                    fromDate = start.format('DD/MM/YYYY');
                    $("#tgl_akhir").daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        autoApply: true,
                        locale: {
                            format: 'DD/MM/YYYY'
                        },
                        minDate: fromDate
                    });
                });
        }

        function deleteData(paramId) {
            var url = '{{ url('dashboard/surat-keluar/delete/') }}';
            deleteDataTable(paramId, url);
        }

        function bulkDelete() {
            var url = '{{ url('dashboard/surat-keluar/bulkDelete/') }}';
            bulkDeleteTable(url);
        }


        function initMagnific() {
            $('.image-popup-no-margins').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image: {
                    verticalFit: true
                },
            });
        }
    </script>
    <!--end::Page Scripts-->
@endpush
