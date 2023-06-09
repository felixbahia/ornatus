<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Compra;
use App\DadosCliente;
use App\Estoque;
use App\Pedido;
use App\PedidoStatus;
use App\Preco;
use App\Produto;
use App\User;
use App\UserPerfil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Keygen\Keygen;

class HomeController extends Controller
{
    public function index(){

        $produtoObj = Produto::with(['preco'])
            ->whereHas('estoque', function ($query) {
                $query->where('quantidade', '>', 0);
            })->get();
        
        $produtos = [];

        foreach($produtoObj as $produto){
            if(isset($produto->preco)){
                $produtos[] = [
                    'descricao' => $produto->descricao,
                    'preco' => $this->parserValor($produto->preco->real),
                    'foto' => $produto->foto,
                    'codigo' => $produto->codigo
                ];
            }
        }
        return view('home')->with(['produtos' => $produtos]);
    }

   public function parserValor($value){
        $value = floatval($value);
        return number_format($value, 2, ",", ".");
    }

    public function inserirDados(){    

        $user = new User;
        $user->name = 'Danilo';
        $user->email = 'danilofelixbahia@gmail.com';
        $user->password = '$2y$10$IZzydxfV3ui5bnka8ATLte8zRjzbmXpZ9v14Ko5XWwcCHWyvwcM5O';
        $user->save();
        $user = new User;
        $user->name = 'João';
        $user->email = 'danilofelixbahia@hotmail.com';
        $user->password = '$2y$10$IZzydxfV3ui5bnka8ATLte8zRjzbmXpZ9v14Ko5XWwcCHWyvwcM5O';
        $user->save();

        $userPerfil = new UserPerfil;
        $userPerfil->descricao = 'Administrador';
        $userPerfil->created_by = 1;
        $userPerfil->save();
        $userPerfil = new UserPerfil;
        $userPerfil->descricao = 'Cliente';
        $userPerfil->created_by = 1;
        $userPerfil->save();

        $userUpdate = User::where('email','danilofelixbahia@gmail.com')->first();
        $userUpdate->users_perfis_id = 1;
        $userUpdate->save();
        $userUpdate = User::where('email','danilofelixbahia@hotmail.com')->first();
        $userUpdate->users_perfis_id = 2;
        $userUpdate->save();

        $categoria = new Categoria;
        $categoria->descricao = 'Brincos';
        $categoria->created_by = 1;
        $categoria->save();
        $categoria = new Categoria;
        $categoria->descricao = 'Anéis';
        $categoria->created_by = 1;
        $categoria->save();
        $categoria = new Categoria;
        $categoria->descricao = 'Colares';
        $categoria->created_by = 1;
        $categoria->save();
        $categoria = new Categoria;
        $categoria->descricao = 'Pulseiras';
        $categoria->created_by = 1;
        $categoria->save();

        $produtos = new Produto;
        $produtos->categoria_id = 1;
        $produtos->codigo = Keygen::alphanum(4)->generate();
        $produtos->descricao = 'Brinco Ouro 18k Argola Redonda C/Coração Verde 0.70 gramas';
        $produtos->foto = '/foto/brinco.jpg';
        $produtos->created_by = 1;
        $produtos->save();
        $produtos = new Produto;
        $produtos->categoria_id = 2;
        $produtos->codigo = Keygen::alphanum(4)->generate();
        $produtos->descricao = 'Alianças Casamento Linha Classic Ouro 5mm Abaulada Polida';
        $produtos->foto = '/foto/alianca.jpg';
        $produtos->created_by = 1;
        $produtos->save();
        $produtos = new Produto;
        $produtos->categoria_id = 3;
        $produtos->codigo = Keygen::alphanum(4)->generate();
        $produtos->descricao = 'Colar Encanto Azul em Prata 925 Esterlina 45cm';
        $produtos->foto = '/foto/colar.jpg';
        $produtos->created_by = 1;
        $produtos->save();
        $produtos = new Produto;
        $produtos->categoria_id = 4;
        $produtos->codigo = Keygen::alphanum(4)->generate();
        $produtos->descricao = 'Pulseira Life Infinito Prata';
        $produtos->foto = '/foto/pulseira.jpg';
        $produtos->created_by = 1;
        $produtos->save();

        $compra = new Compra;
        $compra->produto_id = 1;
        $compra->quantidade = 10;
        $compra->valor_unitario_real = 292;
        $compra->valor_total_real = 292 * 10;
        $compra->data_compra = Carbon::now();
        $compra->created_by = 1;
        $compra->save();
        $compra = new Compra;
        $compra->produto_id = 2;
        $compra->quantidade = 25;
        $compra->valor_unitario_real = 2050.92;
        $compra->valor_total_real = 2050.92 * 25;
        $compra->data_compra = Carbon::now();
        $compra->created_by = 1;
        $compra->save();
        $compra = new Compra;
        $compra->produto_id = 3;
        $compra->quantidade = 15;
        $compra->valor_unitario_real = 75.92;
        $compra->data_compra = Carbon::now();
        $compra->valor_total_real = 75.92 * 15;
        $compra->created_by = 1;
        $compra->save();
        $compra = new Compra;
        $compra->produto_id = 4;
        $compra->quantidade = 30;
        $compra->valor_unitario_real = 160.92;
        $compra->valor_total_real = 160.92 * 30;
        $compra->data_compra = Carbon::now();
        $compra->created_by = 1;
        $compra->save();
       
        $preco = new Preco;
        $preco->produto_id = 1;
        $preco->compra_id = 1;
        $preco->real = 292;
        $preco->created_by = 1;
        $preco->save();
        $preco = new Preco;
        $preco->produto_id = 2;
        $preco->compra_id = 2;
        $preco->real = 4045.92;
        $preco->created_by = 1;
        $preco->save();
        $preco = new Preco;
        $preco->produto_id = 3;
        $preco->compra_id = 3;
        $preco->real = 169.60;
        $preco->created_by = 1;
        $preco->save();
        $preco = new Preco;
        $preco->produto_id = 4;
        $preco->compra_id = 4;
        $preco->real = 343;
        $preco->created_by = 1;
        $preco->save();

        $preco = new Estoque;
        $preco->produto_id = 1;
        $preco->quantidade = 10;
        $preco->created_by = 1;
        $preco->save();
        $preco = new Estoque;
        $preco->produto_id = 2;
        $preco->quantidade = 25;
        $preco->created_by = 1;
        $preco->save();
        $preco = new Estoque;
        $preco->produto_id = 3;
        $preco->quantidade = 15;
        $preco->created_by = 1;
        $preco->save();
        $preco = new Estoque;
        $preco->produto_id = 4;
        $preco->quantidade = 30;
        $preco->created_by = 1;
        $preco->save();

        $cliente = new DadosCliente;
        $cliente->nome = 'João';
        $cliente->cpf = '671.253.660-07';
        $cliente->telefone = '(11) 99426-4264';
        $cliente->data_nascimento = '1989-01-19';
        $cliente->created_by = 2;
        $cliente->save();

        $status = new PedidoStatus;
        $status->descricao = 'Aguardando Pagamento';
        $status->created_by = 1;
        $status->save();
        $status = new PedidoStatus;
        $status->descricao = 'Pago';
        $status->created_by = 1;
        $status->save();
        $status = new PedidoStatus;
        $status->descricao = 'Entregue';
        $status->created_by = 1;
        $status->save();
    }

    public function verificarPagamento(){
       
        $pedidos = Pedido::with(['pedidoItem.produto.estoque', 'pedidoItem', 'pedidoItem.carrinho'])->where('status_id', 1)->get();

        foreach($pedidos as $pedido){
            $pedido->status_id = 2;
            $pedido->updated_by = 1;
            $pedido->save();

            foreach($pedido->pedidoItem as $item){
                $item->produto->estoque->quantidade -= $item->carrinho->quantidade;
                $item->produto->estoque->updated_by = 1;
                $item->produto->estoque->save();
            }
        }
    }

    public function verificarEntrega(){
       
        $pedidos = Pedido::where('status_id', 2)->get();

        foreach($pedidos as $pedido){
            $pedido->status_id = 3;
            $pedido->updated_by = 1;
            $pedido->save();
        }
    }
}
