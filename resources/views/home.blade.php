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
    </head>
    <body>
    <div class="container">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
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
                                
                                    <button type="button" class="btn btn-dark">Comprar</button>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
    </body>
</html>
