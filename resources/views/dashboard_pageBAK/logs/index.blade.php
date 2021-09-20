@extends('mylayouts.app')
@section('title', 'Logs')
@push('vendor-css')
    <!--begin::Page Vendors Styles(used by this page)-->
    <link rel="stylesheet" href="{{assetku('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet"
          href="{{assetku('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/select2/dist/css/select2.min.css')}}">

    <!--end::Page Vendors Styles-->
@endpush
@push('library-css')
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Log Aktivitas</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-row mb-1">
                                <div class="col-lg-4">
                                    <label>Pilih User :</label>
                                    <select class="select2 form-control form-control-sm" id="log_IdUser"
                                            name="log_IdUser">
                                        <option value="">-ALL-</option>
                                        @foreach($listUser as $nama => $value)
                                            <option
                                                value={{$value}}>{{$nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <hr class="my-0">
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="hideyori_datatable">
                        <thead>
                        <tr>
                            <th width="2%"><input type="checkbox" id="check-all"></th>
                            <th width="3%">No.</th>
                            <th width="15%">Waktu</th>
                            <th width="70%">Logs</th>
                            <th width="10%">Actions</th>
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
                            <a class="dropdown-item has-icon" href="javascript:bulkDelete()"><i class="fa fa-trash text-danger"></i> Hapus yang dipilih</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::Card-->


    @endsection

    @push('scripts')
        <!--begin::Page Vendors(used by this page)-->
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
            <!--end::Page Vendors-->
            <!--begin::Page Scripts(used by this page)-->
            <script type="text/javascript">
                @if(session('pesan_status'))
                tampilPesan('{{session('pesan_status.tipe')}}', '{{session('pesan_status.desc')}}', '{{session('pesan_status.judul')}}');
                @endif

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
                        {{--ajax: "{{ route('logs.data') }}",--}}
                        ajax: {
                            url: "{{ route('logs.data') }}",
                            type: "GET",
                            data: function (d) {
                                d.log_IdUser = $('#log_IdUser').val();
                            }
                        },
                        order: [[ 2, "desc" ]],
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
                            {data: 'log_Time', name: 'log_Time', responsivePriority: -1},
                            {
                                data: 'log_Description',
                                name: 'log_Description',
                                responsivePriority: -1,
                                orderable: false
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false,
                                className: 'text-center'
                            },
                        ],
                        rowCallback: function (row, data) {
                            cellValue = data['log_Id'];
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
                        },
                    });
                });

                $('#log_IdUser').change(function () {
                    reloadTable();
                });

                function deleteData(paramId) {
                    var url = '{{ url('dashboard/logs/delete/') }}';
                    deleteDataTable(paramId, url);
                }


                function bulkDelete() {
                    var url = '{{ url('dashboard/logs/bulkDelete/') }}';
                    bulkDeleteTable(url)
                }

            </script>
    @endpush
