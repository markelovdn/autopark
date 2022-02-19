<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->roles->pluck('name')->contains('Admin'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin') }}">Админка</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link nav-link-picture dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                </a>
                                <span class="dropdown-item">
                                    </span>

{{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}

{{--                                    <a class="dropdown-item" href="{{ route('profile') }}">Личный кабинет</a>--}}
{{--                                    <a class="dropdown-item" href="{{ route('orders') }}">Заказы</a>--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        Выход--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

    <!-- Notifications Dropdown Menu -->

</ul>
</nav>
<!-- /.navbar -->
