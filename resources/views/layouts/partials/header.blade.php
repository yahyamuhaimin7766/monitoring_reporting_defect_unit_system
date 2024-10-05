
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
                            data-feather="menu"></i></a></li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                    id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">{{ auth()->user()->name }}</span>
                    </div>
                    <span class="avatar">
                        @if (auth()->user()->photo_profile == null)
                            <img class="round" src="{{ asset('template/app-assets/images/slider/09.jpg') }}"
                                alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        @else
                            <img class="round" src="{{ \Storage::url(auth()->user()->photo_profile) }} " alt="avatar"
                                height="40" width="40">
                            <span class="avatar-status-online"></span>
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="document.querySelector('#form-logout').submit()" href="#">
                        <i class="mr-50" data-feather="power"></i>
                        Logout</a>
                    <form action="{{ route('logout') }}" method="post" id="form-logout">
                        @csrf
                    </form>
                </div>

            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->
