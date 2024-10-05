<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand"
                    href="../../../html/ltr/vertical-menu-template/index.html"><span class="brand-logo">
                        <h2 class="brand-text">SIDM</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('dashboard') }}"><i
                        data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Dashboard</span>
                </a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Options</span><i
                    data-feather="more-horizontal"></i>
            </li>
            @if (auth()->user()->hasRole('qc'))
            <li class="nav-item {{ request()->is('qc*') ? 'active' : '' }} ">
                <a class="d-flex align-items-center" href="{{route('defect.index')}}">
                    <i data-feather='airplay'></i><span class="menu-title text-truncate"
                        data-i18n="Email">Laporan Defect</span></a>
            </li>
            @endif
            @if (auth()->user()->hasRole('leader'))
            <li class="nav-item {{ request()->is('leader/defect*') ? 'active' : '' }} ">
                <a class="d-flex align-items-center" href="{{route('defect.leader.index')}}">
                    <i data-feather='airplay'></i><span class="menu-title text-truncate"
                        data-i18n="Email">Laporan Defect</span></a>
            </li>
            <li class="nav-item {{ request()->is('leader/repair*') ? 'active' : '' }} ">
                <a class="d-flex align-items-center" href="{{route('repair.leader.index')}}">
                    <i data-feather='airplay'></i><span class="menu-title text-truncate"
                        data-i18n="Email">Laporan Repair</span></a>
            </li>
            <li class="nav-item {{ request()->is('leader/cetak') ? 'active' : '' }} ">
                <a class="d-flex align-items-center" href="{{route('laporan.index')}}">
                    <i data-feather='printer'></i><span class="menu-title text-truncate"
                        data-i18n="Email">Cetak Data</span></a>
            </li>
            @endif
            @if (auth()->user()->hasRole('maintenance'))
            <li class="nav-item {{ request()->is('maintenance*') ? 'active' : '' }} ">
                <a class="d-flex align-items-center" href="{{route('repair.index')}}">
                    <i data-feather='airplay'></i><span class="menu-title text-truncate"
                        data-i18n="Email">Laporan Repair</span></a>
            </li>
            @endif
           @if (auth()->user()->hasRole('admin'))
                <li class="nav-item {{ request()->is('pemasangan*') ? 'active' : '' }} ">
                    <a class="d-flex align-items-center" href="{{route('pemasangan.index')}}">
                        <i data-feather='users'></i><span class="menu-title text-truncate"
                            data-i18n="Email">Kelola Pemasangan</span></a>
                </li>
                <li class="nav-item {{ request()->is('user*') ? 'active' : '' }} ">
                    <a class="d-flex align-items-center" href="{{route('user.index')}}">
                        <i data-feather='users'></i><span class="menu-title text-truncate"
                            data-i18n="Email">Kelola User</span></a>
                </li>
                <li class="nav-item {{ request()->is('pemasangan/cetak') ? 'active' : '' }} ">
                    <a class="d-flex align-items-center" href="{{route('pemasangan.cetak')}}">
                        <i data-feather='printer'></i><span class="menu-title text-truncate"
                            data-i18n="Email">Cetak</span></a>
                </li>
           @endif
        </ul>
    </div>
</div>
