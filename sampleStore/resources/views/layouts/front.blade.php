<!DOCTYPE html>
<!-- UPDATE -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace Sample Store</title>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script defer src="{{asset('js/app.js')}}"></script>



    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylesheets')
</head>

<body>
    <!-- NAV ORIGINAL -->

    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

            <a class="navbar-brand" href="{{route('home')}}">Marketplace Sample Store</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(request()->is('/')) active @endif">
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>

                    @foreach ($categorias as $categoria)
                    <li class="nav-item @if(request()->is('categoria/' . $categoria->slug)) active @endif">
                        <a class="nav-link" href="{{route('categoria.single', ['slug' => $categoria->slug])}}">{{$categoria->name}}</a>
                    </li>
                    @endforeach

                </ul>
                    <div class="my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto">
                            @if(!auth())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('login')}}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('register')}}">Registro</a>
                                </li>
                            @endif
                            @auth
                                <li class="nav-item mr-5">
                                    <a class="nav-link" href="#" onclick="event.preventDefault();document.querySelector('form.logout').submit(); ">Sair</a>
                                    <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                                       @csrf
                                    </form>
                                </li>
                            @endauth
                            <li class="nav-item">
                                @auth
                                    <li class="nav-item @if(request()->is('my-orders')) active @endif">
                                        <a href="{{ route('user.orders') }}" class="nav-link">Meus Pedidos</a>
                                    </li>
                                @endauth
                            <a href="{{route('cart.index')}}" class="nav-link">

                                @if(session()->has('cart'))

                                    <span class="badge badge-danger"> {{ count(session()->get('cart')) }}</span>

                                    <span class="badge badge-danger"> {{ array_sum(array_column(session()->get('cart'), 'amount')) }}</span>
                                @endif
                                <i class="fa fa-cart-arrow-down fa-2x"></i>
                            </a>
                            </li>
                        </ul>
                    </div>
            </div>

        </nav>  NAV ORIGINAL -->

    <!-- Nav Layout Vini -->
    <div class="nav-wrapper">
        <nav class="nav-app">
            <div class="logo">
                <a class="nav-link" href="{{route('home')}}"><img id="logo" src="../assets/img/Logo01_White.svg" alt="Logo SampleStore"></a>
            </div>

            <ul id="navigation-links">
                <li><a class="nav-link" href="{{route('home')}}">Home</a></li>
                <li><a class="nav-link" href="{{route('samples')}}">Samples</a></li>
                @guest
                <li><a class="login-button nav-link" href="{{route('login')}}">Entrar</a></li>
                <li><a class="register-button" href="{{route('register')}}">Registrar</a></li>
                @endauth

                @auth
                <li class="nav-item @if(request()->is('my-orders')) active @endif">
                    <a href="{{ route('user.orders') }}" class="nav-link">Meus Pedidos</a>
                </li>

                <li>
                    <p class="username-p">{{ auth()->user()->name }}</p>
                </li>
                @endauth

                @auth
                <li>
                    <a class="login-button" href="#" onclick="event.preventDefault();document.querySelector('form.logout').submit(); ">Sair</a>
                    <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>

                @endauth
            </ul>

            <div id="cart-icon">
                <a href="{{route('cart.index')}}">
                    <img id="cart-icon" src="../assets/img/cart-icon.svg" alt="Ìcone de carrinho de compras">
                    @if(session()->has('cart'))
                    <span class="badge badge-danger"> {{ count(session()->get('cart')) }}</span>
                    <!-- Abaixo a contagem soma todos mesmo se tiver vario produtos iguais:-->
                    <!--<span class="badge badge-danger"> {{ array_sum(array_column(session()->get('cart'), 'amount')) }}</span>-->
                    @endif
                </a>
            </div>

            <div class="menu-icon">
                <img src="../assets/img/menu-icon.svg" alt="Ìcone do menu">
            </div>

        </nav>
    </div>


    <!-- Nav Layout Vini -->


    <div class="container-app" id="containing-samples">
        @include('flash::message')
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script>

    @yield('scripts')
    <footer>

        <div class="logo-box">
            <img id="logo-footer" src="../../assets/img/Logo01_White.svg" alt="Logo">
        </div>

        <div class="copy">
            <span>SampleStore © Todos os direitos reservados - 2020 - Developers - <a href="https://github.com/SergioFelzener" target="_blank">Sérgio</a> & <a href="https://github.com/savegdesigner" target="_blank">Vinicius</a></span>
        </div>

    </footer>
</body>

</html>
