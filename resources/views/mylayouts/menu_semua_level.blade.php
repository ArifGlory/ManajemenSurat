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
         <li class="{{activeMenu('dashboard/surat-keluar')}}"><a class="nav-link" href="{{url('dashboard/surat-keluar')}}"><i
            class="fas fa-qrcode"></i> <span>Surat Keluar</span></a></li>
      </ul>
   </aside>
</div>
