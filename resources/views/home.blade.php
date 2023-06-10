<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link href="/css/style.css" rel="stylesheet"> 
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
         <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
    <div class="container">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                        <a href="{{ url('/pedido') }}">Pedidos</a>
                        <a href="{{ url('/visualizar') }}">Carrinho</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif
                @foreach($produtos as $produto)
                    <div class="responsive">
                        <div class="gallery">
                            <a target="_blank" href="{{ $produto['foto'] }}">
                            <img src="{{ $produto['foto'] }}" alt="Cinque Terre" width="600" height="400">
                            </a>
                            <div class="desc">
                                {{ $produto['descricao'] }}
                                <p>
                                    <span>{{ $produto['preco'] }}</span>
                                </p>
                                    <form enctype="multipart/form-data" name="produtos" action="{{route('carrinho.adicionar')}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" id="codigo" name="codigo" value="{{ $produto['codigo'] }}">
                                        <button type="submit" class="btn btn-dark">Comprar</button>
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
    </body>
</html>
