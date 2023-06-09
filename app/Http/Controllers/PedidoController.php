<?php

namespace App\Http\Controllers;

use App\Carrinho;
use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SimpleXMLElement;

class PedidoController extends Controller
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


     protected function validator(array $data)
     {
         return Validator::make($data, [
             'quantidade' => 'required|numeric'
         ]);
     }
     

     public function adicionarCarrinho(Request $request){
        $campo = $request->only('codigo');

        $produto = Produto::with(['carrinho'])->where('codigo', $campo['codigo'])->first();

        if(isset($produto->carrinho)){
            $produto->carrinho->quantidade += 1;
            $produto->carrinho->updated_by = Auth::id();
            $produto->carrinho->save();
        }else{
            $carrinho = new Carrinho;
            $carrinho->produto_id = $produto->id;
            $carrinho->created_by = Auth::id();
            $carrinho->save();
        }

        return redirect('visualizar');
        
     }

     public function visualizarCarrinho(Request $request){
        $carrinhoQuery = Carrinho::with(['produto', 'produto.preco'])
            ->where('created_by', Auth::id())
            ->where('finalizado', false)
            ->get();

        $itens = [];
        $valor_total = 0;

        $home = new HomeController;

        foreach($carrinhoQuery as $item){
            $itens[] = [
                'id' => encrypt($item->id),
                'codigo' => $item->produto->codigo,
                'descricao' => $item->produto->descricao,
                'quantidade' => $item->quantidade,
                'preco' => $home->parserValor($item->produto->preco->real)
            ];

            $valor_total += $item->produto->preco->real;
        };

        // Fornecido pela api dos correios ou da transportadora
        $frete = $home->parserValor('14.50');

        $total = $valor_total + 14.50;

        return view('carrinho')->with([
            'itens' => $itens,
            'frete' => $frete,
            'valor_total' => $home->parserValor($valor_total),
            'total' => $home->parserValor($total)
        ]);
     }

     public function excluirCarrinho(Request $request){
        $campo = $request->only('id');

        $carrinho = Carrinho::find(decrypt($campo['id']));
        $carrinho->deleted_by = Auth::id();
        $carrinho->save();
        $carrinho->delete();

        return redirect('visualizar');
     }

     public function finalizarCarrinho(Request $request){

     }
}
