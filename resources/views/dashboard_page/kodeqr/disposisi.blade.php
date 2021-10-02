@extends('mylayouts.app')
@section('title', 'Disposisi Surat Keluar')
@push('vendor-css')
    <link rel="stylesheet" href="{{assetku('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet"
          href="{{assetku('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{assetku('assets/modules/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{'Form Disposisi Surat Keluar'}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('surat-keluar')}}">Disposisi Surat Masuk (QR)</a></div>
                <div class="breadcrumb-item active">{{'Form Disposisi Surat Masuk (QR)'}}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-sm-12 order-sm-0 order-lg-1 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-action">
                                  <a href="javascript:add()" class="btn btn-danger"> <i class="fas fa-plus"></i> Form Disposisi</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover stripe"
                                   style="width:100%"
                                   id="hideyori_datatable">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Surat Diterima</th>
                                    <th>Status Disposisi</th>
                                    <th>Disposisikan Kepada</th>
                                    <th>Catatan Disposisi</th>
                                    <th>Actions</th>
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
                                    <label class="col-sm-5 col-lg-5 col-form-label">3. Dibuat Oleh </label>

                                    <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                        {{$nama_pembuat}} - {{$bidang_pembuat}}
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
                            <hr class="mb-2">

                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label class="col-sm-5 col-lg-5 col-form-label">5. Status Surat</label>

                                    <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                        @if($status_surat == "DRAFT")
                                            <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                                <span class="badge badge-success"> {{$status_surat}} </span>
                                            </label>
                                        @else
                                            <label class="col-sm-7 col-lg-7 col-form-label font-weight-bolder">
                                                <span class="badge badge-primary"> {{$status_surat}} </span>
                                            </label>
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <hr class="mb-2">
                            @if($berkas)
                                <div class="col-sm-12">
                                    <div class="row mb-3">
                                        <label class="col-sm-5 col-lg-5 col-form-label">6. Berkas</label>

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
                        <h6 class="modal-title" id="judul">Modal title</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="row">


                            <div class="col-12">
                                <div class="form-group row">
                                    {{--<div class="col-sm-3 col-form-label">
                                        <label>Tanggal Surat Diterima</label>
                                    </div>--}}
                                    <div class="col-sm-9">
                                        <input type="hidden" id="id" class="form-control"
                                               name="id">
                                        <input type="hidden" id="id_surat_keluar" class="form-control" value="{{$id}}"
                                               name="id_surat_keluar">
                                        <input
                                            class=""
                                            name="tgl_masuk" id="tgl_masuk" type="hidden" value="{{date('d/m/Y H:i')}}"/>
                                        <div class="invalid-feedback" id="error_tgl_masuk">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label>Status Disposisi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="status_disposisi"
                                                name="status_disposisi">
                                            <option value="DITERUSKAN">
                                                DITERUSKAN
                                            </option>
                                            <option value="DIKEMBALIKAN">
                                                DIKEMBALIKAN
                                            </option>
                                            <option value="TINDAK LANJUT">
                                                TINDAK LANJUT
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" id="error_status_disposisi">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label id="labeldisposisi">Didisposisikan Kepada</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select_cari form-control" id="kepada"
                                                name="kepada">
                                            <option
                                                value="umum">
                                                User Bagian Kepegawaian dan Umum
                                            </option>
                                            <option value="subkoor_kepegawaian">
                                                Sub Koor Tata Usaha Kepegawaian
                                            </option>
                                            <option value="subkoor_organisasi">
                                                Sub Koor Organisasi dan Tata Laksana
                                            </option>
                                            <option value="subkoor_pengembangan">
                                                Sub Koor Pengembangan Pegawai
                                            </option>
                                            <option value="subkoor_umum">
                                                Sub Koor Umum
                                            </option>
                                            <option value="kabag">
                                                Kepala Bagian
                                            </option>
                                            <option value="seketaris">
                                                Seketaris Direktorat Jenderal Bina Marga
                                            </option>
                                            <option value="direktur">
                                                Direktur Jenderal Bina Marga
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" id="error_kepada">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label>Catatan Disposisi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="height: auto!important;"
                                                  name="catatan_disposisi"
                                                  id="catatan_disposisi" rows="5"></textarea>
                                        <div class="invalid-feedback" id="error_catatan_disposisi">
                                        </div>
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
    <script src="{{assetku('assets/modules/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script>
        if (jQuery().daterangepicker) {
            if ($(".datetimepickerindo").length) {
                $('.datetimepickerindo').daterangepicker({
                    locale: {format: 'DD/MM/YYYY HH:mm'},
                    singleDatePicker: true,
                    timePicker: true,
                    timePicker24Hour: true,
                });
            }
        }
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
                order: [[1, "asc"]],
                {{--ajax: "{{ route('disposisi.data') }}",--}}
                ajax: {
                    url: "{{ url('dashboard/disposisi-surat-keluar/data/'.$id) }}",
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
                    {data: 'status_disposisi', name: 'status_disposisi'},
                    {data: 'kepada', name: 'kepada'},
                    {data: 'catatan_disposisi', name: 'catatan_disposisi'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
                ],

                rowCallback: function (row, data, index) {
                    cellValue = data['id'];
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
            var url = '{{ url('dashboard/disposisi-surat-keluar/delete/') }}';
            deleteDataTable(paramId, url);
        }


        function bulkDelete() {
            var url = '{{ url('dashboard/disposisi-surat-keluar/bulkDelete/') }}';
            bulkDeleteTable(url)
        }

        $('#modal_form').on('shown.bs.modal', function () {
            $('#tgl_masuk').focus()
        })

        $('#status_disposisi').on('change', function () {
            getlabelstatus_disposisi();
        });

        function getlabelstatus_disposisi() {
            value_status_disposisi = $("#status_disposisi option:selected").text();
            $('#labeldisposisi').text(value_status_disposisi + ' kepada');
        }

        function add() {
            $('#modal_form').modal();
            $('#modal_form').appendTo("body");
            $('#modal_form').modal('show'); // show bootstrap modal
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-control').removeClass('is-invalid'); // clear error class
            $('.invalid-feedback').empty(); // clear error string
            $('#judul').text('FORM DISPOSISI'); // Set Title to Bootstrap modal title
            $('#teksSimpan').text('Tambah');
            getlabelstatus_disposisi();
            $('#btnsave').show();
            $('#btnbatal').hide();
        }


        function initClick() {
            $(".clickable-edit").click(function () {
                save_method = 'update';
                id = $(this).attr('data-id');
                tgl_masuk = $(this).attr('data-tgl_masuk');
                id_surat_keluar = $(this).attr('data-id_surat_keluar');
                kepada = $(this).attr('data-kepada');
                catatan_disposisi = $(this).attr('data-catatan_disposisi');
                status_disposisi = $(this).attr('data-status_disposisi');
                $('#form')[0].reset(); // reset form on modals
                $('.form-control').removeClass('is-invalid'); // clear error class
                $('.invalid-feedback').empty(); // clear error string
                $('#modal_form').modal();
                $('#modal_form').appendTo("body");
                $('#modal_form').modal('show'); // sh
                $('[name="id"]').val(id);
                $('[name="id_surat_keluar"]').val(id_surat_keluar);
                $('[name="tgl_masuk"]').val(tgl_masuk);
                console.log(tgl_masuk);
                //$('[name="id_sm_fk"]').val(id_sm_fk);
                $('[name="kepada"]').val(kepada).trigger('change');
                $('[name="catatan_disposisi"]').val(catatan_disposisi);
                $('[name="status_disposisi"]').val(status_disposisi);
                getlabelstatus_disposisi();
                $('#judul').text('FORM UBAH DISPOSISI'); // Set Title to Bootstrap modal titlep modal title
                $('#teksSimpan').text('Simpan Perubahan');
                $('#btnsave').show();
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
                url = "{{ url('dashboard/disposisi-surat-keluar/create/') }}";
                _method = "POST";
            } else {
                id = $('[name="id"]').val();
                url = '{{ url('dashboard/disposisi-surat-keluar/update/') }}' + '/' + id;
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
                    console.log(data);
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
