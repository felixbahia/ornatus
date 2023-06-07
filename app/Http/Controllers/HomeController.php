<?php

namespace App\Http\Controllers;

use App\Preco;
use App\Produto;
use Illuminate\Http\Request;

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
    public function index()
    {
        return view('home');
    }

    public function inserirDados(){
        $produtos = new Produto;
        $produtos->codigo = 'VJ8756';
        $produtos->descricao = 'Aliança de Ouro Classic';
        $produtos->foto = 'foto/alianca.jpg';
        $produtos->created_by = 1;
        $produtos->save();

        $preco = new Preco;
        $preco->produto_id = $produtos->id;
        $preco->dolar = 2045.92; 
        $preco->real = 4045.92;
        $preco->custo_real = 2000.92;
        $preco->custo_dolar = 1000.92;
        $preco->created_by = 1;
        $preco->save();

    }
}
