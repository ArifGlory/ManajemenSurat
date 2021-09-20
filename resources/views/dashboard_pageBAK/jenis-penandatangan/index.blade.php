@extends('mylayouts.app')
@section('title', 'Jenis Penandatangan')
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
    <!--begin::Card-->

    <section class="section">
        <div class="section-header">
            <h1>Daftar Jenis Penandatangan</h1>
            <div class="section-header-button">
                <a href="javascript:add()"
                   class="btn btn-primary btn-sm"><i
                        class="fa fa-plus mr-50"></i>
                    Tambah
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Daftar Jenis Penandatangan</div>
            </div>
        </div>

        <div class="section-body">


            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="hideyori_datatable">
                        <thead>
                        <tr>
                            <th width="2%"><input type="checkbox" id="check-all"></th>
                            <th width="3%">No.</th>
                            <th width="70%">Jenis Penandatangan</th>
                            <th width="15%">Status</th>
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
                            <a class="dropdown-item has-icon" href="javascript:bulkDelete()"><i
                                    class="fa fa-trash text-danger"></i> Hapus yang dipilih</a>
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
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalScrollableTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <form class="form form-horizontal" id="form" name="form" method="post"
                      enctype="multipart/form-data" action="javascript:save();">
                    <div class="modal-header bg-dark text-white" style="padding-top: 10px; padding-bottom: 10px">
                        <h6 class="modal-title" id="judul">Modal title</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label>Judul Kategori</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="id_jenis_ttd" class="form-control"
                                               name="id_jenis_ttd">
                                        <input type="text" id="jenis_ttd" class="form-control form-control-sm"
                                               name="jenis_ttd">
                                        <div class="invalid-feedback" id="error_jenis_ttd">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label>Status</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control select_sm" id="active"
                                                name="active">
                                            <option value=1>
                                                Aktif
                                            </option>
                                            <option value=0>
                                                Non Aktif
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" id="error_active">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label>Upload Cert</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="file" id="cert" class="form-control form-control-sm"
                                               name="cert">
                                        <div class="invalid-feedback" id="error_cert">
                                        </div>
                                        <p class="mt-2" id="cert-text"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label>Upload Private Key</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="file" id="priv_key" class="form-control form-control-sm"
                                               name="priv_key">
                                        <div class="invalid-feedback" id="error_priv_key">
                                        </div>
                                        <p class="mt-2" id="priv_key-text"></p>
                                    </div>
                                </div>
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
                    [10, 50, 100, -1],
                    [10, 50, 100, "All"]
                ],
                paging: true,
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                {{--ajax: "{{ route('jenis-penandatangan.data') }}",--}}
                ajax: {
                    url: "{{ route('jenis-penandatangan.data') }}",
                    type: "GET",
                },
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
                    {data: 'jenis_ttd', name: 'jenis_ttd', responsivePriority: -1},
                    {
                        data: 'active',
                        name: 'active',
                        responsivePriority: -1,
                        className: 'text-center'
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
                ],

                rowCallback: function (row, data, index) {
                    cellValue = data['id_jenis_ttd'];
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
                    initClick();
                },
                "error": function (xhr, error, thrown) {
                    console.log("Error occurred!");
                    console.log(xhr, error, thrown);
                }
            });
        });

        function deleteData(paramId) {
            var url = '{{ url('dashboard/jenis-penandatangan/delete/') }}';
            deleteDataTable(paramId, url);
        }


        function bulkDelete() {
            var url = '{{ url('dashboard/jenis-penandatangan/bulkDelete/') }}';
            bulkDeleteTable(url)
        }

        $('#modal_form').on('shown.bs.modal', function () {
            $('#jenis_ttd').focus()
        })

        function add() {
            $('#modal_form').modal();
            $('#modal_form').appendTo("body");
            $('#modal_form').modal('show'); // show bootstrap modal
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-control').removeClass('is-invalid'); // clear error class
            $('.invalid-feedback').empty(); // clear error string
            $('#judul').text('FORM TAMBAH JENIS PENANDATANGAN'); // Set Title to Bootstrap modal title
            $('#teksSimpan').text('Tambah');
            $('#btnsave').show();
            $('#cert-text').text("");
            $('#priv_key-text').text("");
            $('[name="jenis_ttd"]').prop('disabled', false);
            $('[name="categorys_seotitle"]').prop('disabled', false);
            $('[name="active"]').prop('disabled', false);
            $('[name="cert"]').prop('disabled', false);
            $('#btnbatal').hide();
        }

        function initClick() {
            $(".clickable-edit").click(function () {
                save_method = 'update';
                id_jenis_ttd = $(this).attr('data-id_jenis_ttd');
                jenis_ttd = $(this).attr('data-jenis_ttd');
                categorys_seotitle = $(this).attr('data-categorys_seotitle');
                cert = $(this).attr('data-cert');
                privKey = $(this).attr('data-priv');
                active = $(this).attr('data-active');
                $('#form')[0].reset(); // reset form on modals
                $('.form-control').removeClass('is-invalid'); // clear error class
                $('.invalid-feedback').empty(); // clear error string
                $('#modal_form').modal();
                $('#modal_form').appendTo("body");
                $('#modal_form').modal('show'); // sh
                $('[name="id_jenis_ttd"]').val(id_jenis_ttd);
                $('[name="jenis_ttd"]').val(jenis_ttd);
                $('[name="categorys_seotitle"]').val(categorys_seotitle);
                $('[name="active"]').val(active);
                $('#judul').text('FORM UBAH JENIS PENANDATANGAN'); // Set Title to Bootstrap modal titlep modal title
                $('#teksSimpan').text('Simpan Perubahan');
                $('#cert-text').text(cert);
                $('#priv_key-text').text(privKey);
                $('#btnsave').show();
                $('[name="jenis_ttd"]').prop('disabled', false);
                $('[name="categorys_seotitle"]').prop('disabled', false);
                $('[name="active"]').prop('disabled', false);
                $('[name="cert"]').prop('disabled', false);
                $('#btnbatal').show();
                $('#btnbatal').text('Batal Ubah');
            });
        }


        function save() {
            var url;
            var _method;
            var id;
            var formData = new FormData($('#form')[0]);
            if (save_method == 'add') {
                id = '';
                url = "{{ url('dashboard/jenis-penandatangan/create/') }}";
                _method = "POST";
            } else {
                id = $('[name="id_jenis_ttd"]').val();
                url = '{{ url('dashboard/jenis-penandatangan/update/') }}' + '/' + id;
                _method = "PUT";
                formData.append('_method', 'PUT');
            }

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
                    if (data.status) //if success close modal and reload ajax table
                    {
                        if (save_method == 'add') {
                            reloadTable();
                            iziToast.success({
                                title: 'Sukses',
                                message: 'Berhasil Input Data',
                                position: 'topRight'
                            });
                            $('#modal_form').modal('hide');
                        } else {
                            reloadTable();
                            iziToast.success({
                                title: 'Sukses',
                                message: 'Berhasil Ubah Data',
                                position: 'topRight'
                            });
                            $('#modal_form').modal('hide');
                        }
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid'); //select parent twice to
                            $('#error_' + data.inputerror[i] + '').text(data.error_string[i]);
                            $('[name="' + data.inputerror[i] + '"]').focus();
                        }
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
