<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="my-background h-100">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

    <main class="py-4 h-100">

    <div class="container full-height">
        <div class="row h-100">
            <div class="move_to_center my-auto mx-auto">
                <div class="card p-3">
                    <h6 class="text-center"><b>Mickel Linn</b></h6>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{asset("images/diamond_icon.png")}}" width="20" height="20" alt="Diamond">
                                <p class="d-inline-block">10</p>
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset("images/coin_black.png")}}" width="16" height="16" alt="Diamond">
                                <p class="d-inline-block">50</p>
                            </div>
                        </div>
                    </div>
                    <div class="container reward_claim_box mt-3 p-2">
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <p>Reach total of 200 files</p>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-my-primarydark btn-block">
                                    {{ __('CLAIM') }}
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <p>Spin total of 20 times</p>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-my-primarydark btn-block">
                                    {{ __('CLAIM') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <a href="{{ url('dashboard') }}" type="submit" class="btn btn-my-primarydark btn-block mt-1">
                        {{ __('LET\'S SPIN') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    </main>
</div>
</body>
</html>
