<div class="main-sidebar">
   <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
         <a href="javascript:void(0)"><img src="{{url('uploads/'.getSetting('logo'))}}" width="25px">
         | {{getSetting('nama_app')}}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
         <a href="#"><img src="{{url('uploads/'.getSetting('logo'))}}" width="25px"> </a>
      </div>
      <ul class="sidebar-menu">
         <li class="menu-header">Modul</li>
         <li class="{{activeSegment('dashboard')}}"><a class="nav-link" href="{{route('dashboard')}}"><i
            class="fas fa-home"></i> <span>Dashboard</span></a></li>
         <li class="{{activeMenu('dashboard/jenis-penandatangan')}}"><a class="nav-link"
            href="{{url('dashboard/jenis-penandatangan')}}"><i
            class="fas fa-signature"></i> <span>Jenis Penandatangan</span></a></li>
         <li class="{{activeMenu('dashboard/perangkat-daerah')}}"><a class="nav-link"
            href="{{url('dashboard/perangkat-daerah')}}"><i
            class="fas fa-building"></i> <span>Pejabat / OPD</span></a></li>
          <li class="{{activeMenu('dashboard/surat-masuk')}}"><a class="nav-link" href="{{url('dashboard/surat-masuk')}}"><i
                      class="fas fa-envelope"></i> <span>Surat Masuk (QR)</span></a></li>
         <li class="{{activeMenu('dashboard/kode-qr')}}"><a class="nav-link" href="{{url('dashboard/kode-qr')}}"><i
            class="fas fa-qrcode"></i> <span>Surat Keluar (QR)</span></a></li>
{{--         <li class="{{activeMenu('dashboard/signature-qr')}}"><a class="nav-link"--}}
{{--            href="{{url('dashboard/signature-qr')}}"><i--}}
{{--            class="fas fa-sign"></i> <span>Signature QR</span></a></li>--}}
         <li class="nav-item dropdown {{activeMenu('dashboard/statistik')}}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-bar"></i><span>Statistik Surat Keluar</span></a>
            <ul class="dropdown-menu">
               <li class="{{activeMenu('dashboard/statistik/tanda-tangan')}}"><a class="nav-link"
                  href="{{url('dashboard/statistik/tanda-tangan')}}">Tanda Tangan</a>
               </li>
               <li class="{{activeMenu('dashboard/statistik/perangkat-daerah')}}"><a class="nav-link"
                  href="{{url('dashboard/statistik/perangkat-daerah')}}">Perangkat Daerah</a>
               </li>
               <li class="{{activeMenu('dashboard/statistik/signature-opd')}}"><a class="nav-link"
                  href="{{url('dashboard/statistik/signature-opd')}}">Signature QR / PD</a>
               </li>
            </ul>
         </li>
         <li class="menu-header">SET</li>
         <li class="{{activeMenu('dashboard/pengguna')}}"><a class="nav-link" href="{{route('pengguna')}}"><i
            class="fas fa-users"></i> <span>Pengguna Aplikasi</span></a></li>
      </ul>
   </aside>
</div>
