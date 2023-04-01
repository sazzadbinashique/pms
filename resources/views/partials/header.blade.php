<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg" style="color:blue;">
                <use xlink:href="{{asset('admin/coreui/vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
            </svg>
        </button>

        <span style="font-family:arial;font-weight:bold;font-size:18px;"> BAFWWA Pharmacy Management Software (BAFWWA PMS)</span>

        <a class="header-brand d-md-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg>
        </a>

        <ul class="header-nav d-none d-md-flex">

        </ul>

        <ul class="header-nav ms-auto">

        </ul>

        <span style="font-family:arial;font-weight:bold;">{{ Auth::user()->name }}</span>

        <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md"><img class="avatar-img" src="{{asset('admin/coreui/assets/img/avatars/log_out_n.jfif')}}" alt="user@email.com"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">Settings</div>
                    </div><a class="dropdown-item" href="#">
                        <svg class="icon me-2">
                            <use xlink:href="{{asset('admin/coreui/vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <svg class="icon me-2">
                            <use xlink:href="{{asset('admin/coreui/vendors/@coreui/icons/svg/free.svg#cil-account-logout')}}"></use>
                        </svg>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>

    </div>
    
</header>
{{--<header class="header header-sticky">
    <div class="container-fluid">
        --}}{{--<a class="header-brand d-none d-md-flex" href="{{route('admin.dashboard')}}">
            <img height="46" src="{{asset('assets/coreui/assets/img/logo-naro.png')}}" alt="logo">
        </a>--}}{{--
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
                <use xlink:href="{{asset('assets/coreui/vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
            </svg>
        </button>
        <ul class="header-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#"  aria-haspopup="true" aria-expanded="false">
                    <span class="flag-icon flag-icon-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"><span class="flag-icon flag-icon-{{$language['flag-icon']}}"></span> {{$language['display']}}</a>
                        @endif
                    @endforeach
                </div>
            </li>
        </ul>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown d-md-down-none"><a  data-user_id="{{ Auth::user()->id??'' }}"  class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                    <svg class="icon icon-lg my-1 mx-2">
                        <use xlink:href="{{asset('assets/coreui/vendors/@coreui/icons/svg/free.svg#cil-bell')}}"></use>
                    </svg>
                     <span class="badge rounded-pill position-absolute top-0 end-0 bg-danger-gradient text-white" style="background: #be1616; ">{{$unseens->count()}}</span>
                   --}}{{-- <span class="badge rounded-pill position-absolute top-0 end-0 bg-danger-gradient text-white" style="background: #be1616; ">{{ $nt_count }}</span> --}}{{--
                    <span class="badge rounded-pill position-absolute top-0 end-0 bg-danger-gradient text-white" id="not_counter" style="background: #be1616; ">{{ $nt_count }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg scrollable-menu pt-0 " style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(-151px, 50px);" data-popper-placement="bottom-end">
                    <div class="dropdown-header bg-light"><strong>You have {{ $unseens->count()}} unseen notifications</strong></div>
                     @foreach($notices as $notice)
                        <form action="{{ route('admin.notices.seen', $notice->id) }}" method="post">
                            @csrf
                            @method("PUT")
                            @if($notice->status == 0)
                            <button class="dropdown-item text-dark"><strong>{{\Illuminate\Support\Str::limit($notice->title, 40)}}</strong></button>
                            @else
                                <button class="dropdown-item text-dark"><span>{{\Illuminate\Support\Str::limit($notice->title, 40)}}</span></button>
                            @endif
                        </form>
                    @endforeach
                </div>
            </li>
        </ul>


        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">

                    <span class="" style="display: inline-block">
                        <span class="user-name text-dark" style="font-size: 0.75em;">{{ Auth::user()->name ?? '' }}</span>
                        <span class="user-possition" style="font-size: 0.65em; ">
                            @if(!empty(Auth::user()))
                                @foreach(Auth::user()->getRoleNames() as $v)
                                    <span class="small text-dark" style="display: block">{{ $v }}</span>
                                @endforeach
                            @endif
                        </span>
                    </span>
                    <div class="avatar avatar-md" style="vertical-align: unset !important;">
                        <img class="avatar-img" src="{{(!empty(auth()->user()->avatar))? asset(auth()->user()->avatar) : asset('assets/coreui/assets/img/avatars/not-found.png')}}">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">{{__('messages.সেটিংস')}}</div>
                    </div>
                    <a class="dropdown-item" href="{{route('admin.profile')}}">
                        <svg class="icon me-2">
                            <use xlink:href="{{asset('assets/coreui/vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                        </svg> {{__('messages.প্রোফাইল')}}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('/clear-cache')}}">
                        <svg class="icon me-2">
                            <use xlink:href="{{asset('assets/coreui/vendors/@coreui/icons/svg/free.svg#cil-clear-all')}}"></use>
                        </svg> {{__('messages.ক্লিয়ার ক্যাশ')}}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <svg class="icon me-2">
                            <use xlink:href="{{asset('assets/coreui/vendors/@coreui/icons/svg/free.svg#cil-account-logout')}}"></use>
                        </svg>
                        {{ __('messages.লগআউট') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </li>
        </ul>
    </div>
</header>--}}
