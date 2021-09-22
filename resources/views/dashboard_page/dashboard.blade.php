@extends('mylayouts.app')
@section('title', 'Dashboard')
@push('library-css')
@endpush
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jenis Penandatangan</h4>
                            </div>
                            <div class="card-body">
                                {{format_angka_indo($jenisttd)}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Surat Keluar</h4>
                            </div>
                            <div class="card-body">
                                {{format_angka_indo($kodeqr)}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{assetku('highchart/highcharts.js')}}"></script>
    <script src="{{assetku('highchart/highcharts-more.js')}}"></script>
    <script src="{{assetku('highchart/modules/exporting.js')}}"></script>
    <script type="text/javascript">
        function tampilkanwaktu() {         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
            var waktu = new Date();            //membuat object date berdasarkan waktu saat
            var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
            var sm = waktu.getMinutes() + "";  //memunculkan nilai detik
            var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
            document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
        }

        $(document).ready(function () {
            tampilkanwaktu();
            setInterval('tampilkanwaktu()', 1000);
        });

        Highcharts.chart('containerGrafik', {
            chart: {
                type: 'column',
            },

            title: {
                text: 'Jumlah Penggunaan QR / Tahun'
            },
            xAxis: {
                categories: ['Surat Keluar', 'Surat Masuk', 'Signature QR']
            },
            credits: {
                enabled: false
            },
            series: [

                <?php

                foreach ($data_tahun as $tahun) {
                    //$jumlah_kodeqr = $this->kodeqr->count_all_tahun($tahun->tahun);
                    $jumlah_kodeqr = \App\Models\KodeQR::whereYear("tgl_surat", $tahun->tahun)->count();
                    $jumlah_suratkeluar = \App\Models\SuratMasuk::whereYear("tgl_surat", $tahun->tahun)->count();
                    $jumlah_signature = \App\Models\SignatureQR::whereYear("tgl", $tahun->tahun)->count();

                    echo "{name:'" . $tahun->tahun . "',data:[" . $jumlah_kodeqr . "," . $jumlah_suratkeluar . "," . $jumlah_signature . "]},";
                }
                ?>
            ]
        });
    </script>
@endpush
