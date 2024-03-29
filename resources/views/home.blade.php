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
{{--            <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--               onclick="event.preventDefault();--}}
{{--                                                         document.getElementById('logout-form').submit();">--}}
{{--                {{ __('Logout') }}--}}
{{--            </a>--}}

{{--            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                @csrf--}}
{{--            </form>--}}

    <main class="py-4 h-100">

    <div class="container full-height">
        <div class="row h-100">
            <div class="move_to_center my-auto mx-auto">
                <div class="card p-3">
                    <h6 class="text-center"><b style="text-transform: uppercase;">{{ \Illuminate\Support\Facades\Auth::user()->name }}</b></h6>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{asset("images/diamond_icon.png")}}" width="20" height="20" alt="Diamond">
                                <p class="d-inline-block">{{ $diamonds}}</p>
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset("images/coin_black.png")}}" width="16" height="16" alt="Diamond">
                                <p class="d-inline-block">{{ $points }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="container reward_claim_box mt-3 p-2">
                        @foreach($achievements as $achievement)
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <p>{{ $achievement->description }}</p>
                            </div>
                            <div class="col-md-4">
                                    <form action="{{ url('claimAachievement',['id'=>$achievement->id]) }}" method="POST">
                                        @csrf
                                    <button type="submit" class="btn btn-my-primarydark btn-block">
                                        {{$achievement->d_amount}}
                                        <img src="{{asset("images/white_diamond.png")}}" width="20" height="20" alt="Diamond">
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
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
