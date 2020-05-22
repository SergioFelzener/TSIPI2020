<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>SampleStore</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    </style>

</head>
<body>

<!-- Nav Vini -->
<div class="nav-wrapper">
            <nav class="nav-app">
            <div class="logo">
                <a href="{{route('home')}}"><img id="logo" src="../../assets/img/Logo01_White.svg" alt="Logo SampleStore"></a>
            </div>

            @auth
            <ul id="navigation-links">

                <li class=" @if(request()->is('admin/orders*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.orders.my') }}">Meus Pedidos</a>
                </li>

                <li class=" @if(request()->is('admin/stores*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.stores.index') }}">Loja <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item @if(request()->is('admin/produtos*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.produtos.index') }}">Produtos</a>
                </li>

                <li class=" @if(request()->is('admin/categorias*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.categorias.index') }}">Categorias</a>
                </li>

                <li class="username-span">
                    <span class="">{{ auth()->user()->name }}</span>
                </li>

                <li class="">
                    <a href="{{ route('admin.notifications.index') }}" class="nav-link">
                        <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                        <i class="fa fa-bell"></i>
                    </a>
                </li>

                <li>
                    <a class="login-button" href="#" onclick="event.preventDefault();document.querySelector('form.logout').submit(); ">Sair</a>
                    <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>
                        
   
            </ul>
            @endauth

            <div class="menu-icon">
                <img src="../assets/img/menu-icon.svg" alt="Ìcone do menu">
            </div>

        </nav>
    </div>



<!-- NAV Original -->
    <!-- <nav class="navbar nav-sample">
        <a class="navbar-brand" href="{{route('home')}}">
            <img class="sample-logo" src="../assets/img/SampleStoreLogo.png" alt="Sample Store Logo">
        </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('admin/orders*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.orders.my') }}">Meus Pedidos</a>
                </li>

                <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.stores.index') }}">Loja <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item @if(request()->is('admin/produtos*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.produtos.index') }}">Produtos</a>
                </li>
                <li class="nav-item @if(request()->is('admin/categorias*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.categorias.index') }}">Categorias</a>
                </li>
            </ul>
                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="{{ route('admin.notifications.index') }}" class="nav-link">
                                <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                                <i class="fa fa-bell"></i>
                            </a>
                        </li>
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="#" onclick="event.preventDefault();document.querySelector('form.logout').submit(); ">Sair</a>
                            <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ auth()->user()->name }}</span>

                        </li>
                    </ul>

                </div>
                @endauth
        </div>
    </nav> -->

    <div class="container">

        @include('flash::message')
        @yield('content')

    </div>

    <script src="{{asset('js/app.js')}}"></script>
    @yield('scripts')

</body>
</html>
