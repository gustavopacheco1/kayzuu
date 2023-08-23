<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kayzuu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Kayzuu</a>
            <ul class="nav nav-underline">
                <li class="nav-item">
                    <a href="{{ url('download') }}" class="nav-link">DOWNLOAD</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            COMMUNITY
                        </a>
                        <ul class="dropdown-menu rounded-0">
                            <li><a class="dropdown-item" href="{{ url('search-player') }}">Search player</a></li>
                            <li><a class="dropdown-item" href="{{ url('guilds') }}">Guilds</a></li>
                            <li><a class="dropdown-item" href="{{ url('players-online') }}">Players online</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ url('highscore') }}" class="nav-link">HIGHSCORE</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('store') }}" class="nav-link">STORE</a>
                </li>
            </ul>
            <ul class="nav nav-underline justify-content-end">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('register') }}">REGISTER</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                ACCOUNT
                            </a>
                            <ul class="dropdown-menu rounded-0">
                                <li><a class="dropdown-item" href="{{ url('account') }}">General</a></li>
                                <li><a class="dropdown-item" href="{{ url('account/characters') }}">Characters</a></li>
                                <li><a class="dropdown-item" href="{{ url('account/transaction-history') }}">Transaction
                                        History</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <div class="container">
        @yield('content_header')
        @yield('content')
    </div>
    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="{{ url('/') }}" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="{{ url('/rules') }}" class="nav-link px-2 text-muted">Rules</a></li>
            </ul>
            <p class="text-center text-muted">© 2022 Company, Inc</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
