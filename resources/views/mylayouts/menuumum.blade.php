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
            <li class="{{activeMenu('dashboard/surat-masuk')}}"><a class="nav-link"
                                                                   href="{{url('dashboard/surat-masuk')}}"><i
                        class="fas fa-envelope"></i> <span>Surat Masuk (QR)</span></a></li>

        </ul>
    </aside>
</div>
