<nav
    class="header-navbar  navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow  container-xxl"
    data-nav="brand-center">
    <div class="navbar-container d-flex content">
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown dropdown-user">
                @if(auth()->check())
                    <a class="nav-link dropdown-toggle dropdown-user-link"
                       id="dropdown-user" href="#" data-bs-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span
                                class="user-name fw-bolder">{{auth()->user()->name}}</span>
                            <span
                                class="user-status badge badge-info">{{auth()->user()->roles->first()->name}}</span></div>
                        <span class="avatar"><img class="round"
                                                  src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/2048px-User_font_awesome.svg.png"
                                                  alt="avatar" height="40" width="40"><span
                                class="avatar-status-online"></span></span></a>
                @else
                    <a class="nav-link dropdown-toggle dropdown-user-link"
                        href="/login"  >
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">Entrar</span>
                            <span
                                class="user-status"> </span></div>
                        <span class="avatar"><img class="round"
                                                  src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/2048px-User_font_awesome.svg.png"
                                                  alt="avatar" height="40" width="40"><span
                                class="avatar-status-online"></span></span></a>
                @endif

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">

{{--                        <div class="dropdown-divider"></div>--}}
                        @if(auth()->check())
                        <a class="dropdown-item" href="/logout">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-power me-50">
                                <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                                <line x1="12" y1="2" x2="12" y2="12"></line>
                            </svg>
                            Sair
                        </a>
                        @else
                            <a class="dropdown-item" href="/login">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                                Entrar
                            </a>
                        @endif
                    </div>



            </li>
        </ul>
    </div>
</nav>
