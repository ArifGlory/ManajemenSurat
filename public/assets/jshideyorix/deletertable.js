function deleteDataTable(paramId, urlnya) {
    var id = paramId;
    var token = $('meta[name="csrf-token"]').attr('content');
    var urlAJAX =  urlnya + '/' + id;
    Swal.fire({
            title: "Yakin ingin menghapus data ini?",
            text: "Data yang dihapus tidak dapat dikembalikan lagi!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            cancelButtonClass: "btn-danger",
            confirmButtonText: "Hapus",
            cancelButtonText: "Tidak",
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            preConfirm: () => {
                return new Promise(function(resolve) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: urlAJAX,
                        type: 'DELETE',
                        success (res) {
                            if (res.status) {
                                Swal.fire("Terhapus!", res.pesan, "success");
                                table.ajax.reload()
                            } else {
                                Swal.fire("Gagal menghapus!", res.pesan, "error");
                            }
                        },
                        error (res) {
                            console.log(res)
                        }
                    })
                });
            },
        },
    );



   /* Swal.fire({
        title: 'Apakah anda ingin menghapus data ini',
        text: "Data yang anda hapus, tidak akan kembali",
        icon: 'warning',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
    }).then((result) => {
        if (result.value) {
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    url: urlnya + '/' + id,
                    type: 'DELETE',
                    dataType: "JSON",
                    data: {
                        "id": id,
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status) {
                            reloadTable();
                            iziToast.success({
                                title: 'Sukses',
                                message: response.pesan,
                                position: 'topRight'
                            });
                        } else {
                            iziToast.error({
                                title: 'Error',
                                message: response.pesan,
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

        } else if (result.dismiss === "cancel") {
            iziToast.info('data dibatalkan untuk dihapus', 'Info');
        }
    });*/
}


function bulkDeleteTable(urlnya) {
    var list_id = [];
    $(".data-check:checked").each(function () {
        list_id.push(this.value);
    });
    var token = $('meta[name="csrf-token"]').attr('content');
    if (list_id.length > 0) {
        Swal.fire({
            title: 'Yakin akan menghapus : ' + list_id.length + ' data yg telah dipilih ?',
            text: "Cek kembali data anda sebelum dihapus",
            icon: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    url: urlnya,
                    type: "POST",
                    data: {
                        id: list_id,
                    },
                    dataType: "JSON",
                    success: function (data) {
                        if (data.status) {
                            reloadTable();
                            iziToast.success({
                                title: 'Berhasil Hapus',
                                message: list_id.length + ' data',
                                position: 'topRight'
                            });
                            $('#check-all').prop('checked', false); // Unchecks
                        } else {
                            iziToast.error({
                                title: 'Gagal Hapus',
                                message: list_id.length + ' data',
                                position: 'topRight'
                            });
                        }
                    },
                    error: function (xhr) {
                        iziToast.error(xhr.responseText, 'Error');
                    }
                });
            } else if (result.dismiss === "cancel") {
                iziToast.info('data dibatalkan untuk dihapus', 'Info');
            }
        });
    } else {
        iziToast.warning({
            title: 'Perhatian',
            message: 'Silahkan pilih data yang akan dihapus',
            position: 'topRight'
        });
    }
}
