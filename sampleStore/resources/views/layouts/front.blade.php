<!DOCTYPE html>
<!-- UPDATE -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Marketplace Sample Store</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

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

            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

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
                @auth
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                        <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/produtos*')) active @endif">
                        <a class="nav-link" href="{{route('admin.produtos.index')}}">Produtos</a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/categorias*')) active @endif">
                        <a class="nav-link" href="{{route('admin.categorias.index')}}">Categorias</a>
                    </li>
                </ul>
                @endauth
                    <div class="my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                @auth
                                    <li class="nav-item @if(request()->is('my-orders')) active @endif">
                                        <a href="{{ route('user.orders') }}" class="nav-link">Meus Pedidos</a>
                                    </li>
                                @endauth
                            <a href="{{route('cart.index')}}" class="nav-link">
                                <!-- Se existir produtos no carrino -->
                                @if(session()->has('cart'))
                                <!-- Mostra a quantida de produtos no carrinho mesmo se existir muitos produtos iguais -->
                                    <span class="badge badge-danger"> {{ count(session()->get('cart')) }}</span>
                                <!-- Mostra a quantida de produtos no carrinho somando mesmo se forem iguais -->
                                    <span class="badge badge-danger"> {{ array_sum(array_column(session()->get('cart'), 'amount')) }}</span>
                                @endif
                                <i class="fa fa-cart-arrow-down fa-2x"></i>
                            </a>
                            </li>
                        </ul>
                    </div>
            </div>
        </nav>

         <!-- NAV -->

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- <script src="{{asset('js/app.js')}}"></script> -->
    @yield('scripts')
</body>
</html>
