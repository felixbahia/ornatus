<?php

namespace App\Http\Controllers;

use App\Carrinho;
use App\DadosCliente;
use App\Pedido;
use App\PedidoItem;
use App\Produto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Keygen\Keygen;

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
            'total' => $home->parserValor($total),
            'valor_total_sql' => $valor_total,
            'total_sql' => $total,
            'frete_sql' => 14.50
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

     public function gerarPedido(Request $request){
        $campo = $request->only('frete', 'valor_total', 'total');

        $carrinhoQuery = Carrinho::with(['produto', 'produto.preco'])
            ->where('created_by', Auth::id())
            ->where('finalizado', false)
            ->get();

        $cliente = DadosCliente::where('created_by', Auth::id())->first();
        
        $pedido =  new Pedido;
        $pedido->cliente_id = $cliente->id;
        $pedido->numero = Keygen::numeric(8)->generate();
        $pedido->valor_total_produtos = $campo['valor_total'];
        $pedido->frete = $campo['frete'];
        $pedido->valor_total = $campo['total'];
        $pedido->status_id = 1;
        $pedido->created_by = Auth::id();
        $pedido->save();

        foreach($carrinhoQuery as $item){
            $pedidoItem = new PedidoItem;
            $pedidoItem->pedido_id = $pedido->id;
            $pedidoItem->produto_id = $item->produto->id;
            $pedidoItem->carrinho_id = $item->id;
            $pedidoItem->valor = $item->produto->preco->real * $item->quantidade;
            $pedidoItem->created_by = Auth::id();
            $pedidoItem->save();

            $item->finalizado = true;
            $item->updated_by = Auth::id();
            $item->save();
        }

        return redirect('pedido');
     }

     public function visualizarPedido(Request $request){
        $pedidoQuery = Pedido::with(['pedidoItem', 'pedidoItem.produto', 'pedidoItem.produto.preco','pedidoItem.carrinho'])
        ->where('created_by', Auth::id())
        ->get();

        $pedidos = [];
        $home = new HomeController;

        foreach($pedidoQuery as $pedido){
            $pedidos[$pedido->id] = [
                'numero' => $pedido->numero,
                'status' => $pedido->status->descricao,
                'total' => $home->parserValor($pedido->valor_total)
            ];

            foreach($pedido->pedidoItem as $item){
                $pedidos[$item->pedido_id]['itens'][] = [
                    'codigo' => $item->produto->codigo,
                    'descricao' => $item->produto->descricao,
                    'quantidade' => $item->carrinho->quantidade,
                    'valor' => $home->parserValor($item->valor)
                ];
            }
        } 

        return view('pedido')->with(['pedidos' => $pedidos]);
     }
}
