<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Compra;
use App\Estoque;
use App\Preco;
use App\Produto;
use App\User;
use App\UserPerfil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Keygen\Keygen;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    
}
