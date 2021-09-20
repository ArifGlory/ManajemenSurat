@extends('mylayouts.app')
@section('title', 'Disposisi Surat Masuk (QR)')
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
            <h1>{{'Form Disposisi Surat Masuk (QR)'}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('kode-qr')}}">Disposisi Surat Masuk (QR)</a></div>
                <div class="breadcrumb-item active">{{'Form Disposisi Surat Masuk (QR)'}}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-sm-12 order-sm-0 order-lg-1 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <h4>Disposisi Surat di Lingkungan {{getSetting('area')}}</h4>
                            <div class="card-header-action">
                                <a href="javascript:add()" class="btn btn-danger">Form Disposisi</a>
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
                                    <th>Penerima</th>
                                    <th>Status</th>
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
                            <hr class="mb-2">
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
                                    <div class="col-sm-3 col-form-label">
                                        <label>Tanggal Surat Diterima</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="hidden" id="id" class="form-control"
                                               name="id">
                                        <input type="hidden" id="id_sm_fk" class="form-control"
                                               name="id_sm_fk" readonly value="{{$id}}">
                                        <input
                                            class="form-control datetimepickerindo"
                                            name="tgl_masuk" id="tgl_masuk" type="text" value="{{date('d/m/Y H:i')}}"/>
                                        <div class="invalid-feedback" id="error_tgl_masuk">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label>Penerima</label>
                                    </div>
                                    <div class="col-sm-9">
                                        @if(Auth::user()->level=='superadmin')
                                            <select class="select2 form-control" id="penerima"
                                                    name="penerima">
                                                @foreach($listPerangkat as $nama => $value)
                                                    <option
                                                        value="{{$nama}}">{{$nama}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input
                                                class="form-control"
                                                name="penerima" id="penerima" readonly type="text"
                                                value="{{$penerima}}"/>
                                        @endif
                                        <div class="invalid-feedback" id="error_penerima">
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
                                        <select class="form-control" id="status"
                                                name="status">
                                            <option value="diteruskan">
                                                Diteruskan
                                            </option>
                                            <option value="dihimpun">
                                                Dihimpun
                                            </option>
                                            <option value="tindak lanjut">
                                                Tindak Lanjut
                                            </option>
                                        </select>
                                        <div class="invalid-feedback" id="error_status">
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
                                        <select class="select2 form-control" id="kepada"
                                                name="kepada">
                                            @foreach($listPerangkat as $nama => $value)
                                                <option
                                                    value="{{$nama}}">{{$nama}}</option>
                                            @endforeach
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
                    url: "{{ url('dashboard/disposisi/data/'.$id) }}",
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
            var url = '{{ url('dashboard/disposisi/delete/') }}';
            deleteDataTable(paramId, url);
        }


        function bulkDelete() {
            var url = '{{ url('dashboard/disposisi/bulkDelete/') }}';
            bulkDeleteTable(url)
        }

        $('#modal_form').on('shown.bs.modal', function () {
            $('#tgl_masuk').focus()
        })

        $('#status').on('change', function () {
            getlabelstatus();
        });

        function getlabelstatus() {
            value_status = $("#status option:selected").text();
            $('#labeldisposisi').text(value_status + ' kepada');
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
            getlabelstatus();
            $('#btnsave').show();
            $('#btnbatal').hide();
        }

        function getpenerima() {
            var urlData = "{{ url('dashboard/disposisi/get-penerima/'.$id) }}";
            $.ajax({
                url: urlData,
                type: "GET",
                success: function (data) {
                    $('[name="penerima"]').val(data).trigger('change');
                }
            });
        }

        function initClick() {
            $(".clickable-edit").click(function () {
                save_method = 'update';
                id = $(this).attr('data-id');
                tgl_masuk = $(this).attr('data-tgl_masuk');
                //id_sm_fk = $(this).attr('data-id_sm_fk');
                penerima = $(this).attr('data-penerima');
                kepada = $(this).attr('data-kepada');
                catatan_disposisi = $(this).attr('data-catatan_disposisi');
                status = $(this).attr('data-status');
                $('#form')[0].reset(); // reset form on modals
                $('.form-control').removeClass('is-invalid'); // clear error class
                $('.invalid-feedback').empty(); // clear error string
                $('#modal_form').modal();
                $('#modal_form').appendTo("body");
                $('#modal_form').modal('show'); // sh
                $('[name="id"]').val(id);
                $('[name="tgl_masuk"]').val(tgl_masuk);
                console.log(tgl_masuk);
                //$('[name="id_sm_fk"]').val(id_sm_fk);
                $('[name="penerima"]').val(penerima).trigger('change');
                $('[name="kepada"]').val(kepada).trigger('change');
                $('[name="catatan_disposisi"]').val(catatan_disposisi);
                $('[name="status"]').val(status);
                getlabelstatus();
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
                url = "{{ url('dashboard/disposisi/create/') }}";
                _method = "POST";
            } else {
                id = $('[name="id"]').val();
                url = '{{ url('dashboard/disposisi/update/') }}' + '/' + id;
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
