<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CV. Irando') }}</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>
    @yield('styles')

    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('editable/js/bootstrap4-editable.js')}}"></script>
    <script>
        $(function(){
            window.Echo.channel('my-channel')
            .listen('.my-event', (data) => {
                var toastLiveExample = $('#liveToast');
                var toast = new window.bootstrap.Toast(toastLiveExample);
                $('.toast-body').empty().append('<p><strong>Number:</strong> '+data.phone.number+'<br/><strong>Provider:</strong> '+data.phone.provider+'</p>');
                $('.timeAdded').empty().append(moment(data.phone.created_at).fromNow());
                toast.show();
                var audio = new Audio('{{url('/sounds/notification_sound.mp3')}}');
                audio.play();
            });
        });
    </script>
    @yield('scripts')
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'CV. Irando') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('phones.index') }}">{{ __('Phones') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('phones.create') }}">{{ __('Add New Phones') }}</a>
                        </li>
                    </ul>

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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div aria-live="polite" aria-atomic="true" class="position-relative">
                <div style="z-index:2;" class="toast-container position-absolute top-0 end-0 p-3">
                    <div id="liveToast" class="toast" role="alert" aria-atomic="true" data-bs-autohide="true" data-bs-animation="true" delay="2500">
                        <div class="toast-header bg-primary text-white">
                            <strong class="me-auto">New Number Added</strong>
                            <small class="timeAdded"></small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body"></div>
                    </div>
                </div>
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>
