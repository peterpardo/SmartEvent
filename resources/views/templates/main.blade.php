<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Event') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet">
    <livewire:styles />

    {{-- JS --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"
        defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    @if(Auth::user())
    {{-- NAVIGATION BAR --}}
    <nav class="navbar navbar-expand-sm navbar-dark bg-nav">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">SmartEvent</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto"></ul>
                {{-- PC PART --}}
                <li class="nav-item dropdown d-flex justify-content-end d-none d-md-flex">
                    <img src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                        alt="Avatar Logo" style="width: 40px; height: 40px" class="rounded-pill" />
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown">Hello, {{ Auth::user()->fname }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/account/{{ Auth::user()->id }}">Account</a></li>
                        @role('user')
                            <li><a class="dropdown-item" href="/events">Schedule Events</a></li>
                        @endrole
                        <li>
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                {{-- mobile part --}}
                <li class="nav-item d-md-none d-flex">
                    <div class="text-end w-100">
                        <div class="d-flex justify-content-end w-100">
                        </div>
                        <a class="nav-link justify-content-end row text-white mx-2 my-2" href="/account/{{ Auth::user()->id }}">Account</a>
                        @role('user')
                            <a class="nav-link justify-content-end row text-white mx-2 my-2" href="/events">Schedule Events</a>
                        @endrole
                        <a class="nav-link justify-content-end row text-white mx-2 my-2"href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                        @csrf
                    </form>
                </li>
            </div>
        </div>
    </nav>
    @yield('content')
    @else
    @yield('content')
    @endif

    <livewire:scripts />
</body>

</html>