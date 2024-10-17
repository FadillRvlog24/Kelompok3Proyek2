<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link href="{{ asset('css/app.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/belanja.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/tentangkami.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/lokasi.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/edit.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/produk.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/cart.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="{{ asset('css/checkout.css') }}?v={{ time() }}" rel="stylesheet">
    

   

    <!-- Scripts -->
     
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
   
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light custom-navbar shadow-sm">
            
            <div class="container">
            <img src="{{ asset('images/logo.png.png') }}" alt="{{ config('app.name') }}" class="logo"/>
            <a class="navbar-brand app-name" href="{{ url('/') }}"> 
            {{ config('app.name', default: 'Laravel') }}
      </a>
       
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('tentangkami') }}">{{ __('tentang kami') }}</a>
                                </li>
                        
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

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('home') }}">{{ __('beranda') }}</a>
                            </li>
                    
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('tentangkami') }}">{{ __('tentang kami') }}</a>
                                </li>

                                <li class="nav-item">
                            <a class="nav-link" href="{{ url('belanja') }}">{{ __('belanja') }}</a>
                                </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('lokasi') }}">{{ __('lokasi') }}</a>
                                </li>

                                <li class="nav-item">
                            <a class="nav-link" href="{{ url('produk') }}">{{ __('produk') }}</a>
                                </li>

                                <li class="nav-item">
                            <a class="nav-link" href="{{ url('pesanan-saya') }}">{{ __('pesanan saya') }}</a>
                                </li>
                                
                                <li class="nav-item">
    <a class="nav-link" href="{{ url('cart') }}">
        <!-- Menampilkan ikon keranjang -->
        <img src="{{ asset('images/icons8cart24.png') }}" alt="Keranjang" class="cart-icon"/>
        <!-- Menampilkan jumlah item dalam keranjang -->
    </a>
</li>


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href="{{ url('profile') }}">
                                        {{ __('Profile') }}
                                           </a>
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
            @yield(section: 'content')
      </main>

   <div>
    @include( 'webatom.footer')
    </div>         
</body>
</html>
