@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Carrinho</div>
                    <div class="panel-body" style="font-family: Arial, Helvetica, sans-serif">
                        @if(!empty($itens))
                                <table class="table table-bordered">
                                    <thead>
                                        <thr>
                                            <th>Código</th>
                                            <th>Descrição</th>
                                            <th>Quantidade</th>
                                            <th>Preço</th>
                                            <th></th>
                                        </thr>
                                    </thead>
                                    <tbody>
                                        @foreach($itens as $item)
                                                <tr>
                                                    <td>{{ $item['codigo'] }}</td>
                                                    <td>{{ $item['descricao'] }}</td>
                                                    <td>{{ $item['quantidade'] }}</td>
                                                    <td>{{ $item['preco'] }}</td>
                                                    <td>
                                                        <form enctype="multipart/form-data" name="itens" action="{{route('carrinho.excluir')}}" method="POST">
                                                            {{ csrf_field() }}    
                                                            <input type="hidden" id="id" name="id" value="{{ $item['id'] }}">
                                                            <button type="submit" name="item" class="btn btn-danger">Exluir</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </form>
                                        @endforeach
                                    </tbody> 
                                </table>
                                <form enctype="multipart/form-data" name="itens" action="{{route('gerar.pedido')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-3 col-md-offset-3"></div>
                                        <input type="hidden" id="valor_total" name="valor_total" value="{{ $valor_total_sql }}">
                                        <div class="col-md-3 col-md-offset-3"><b>{{ $valor_total }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-md-offset-3"><b>Frete</b></div>
                                        <input type="hidden" id="frete" name="frete" value="{{ $frete_sql }}">
                                        <div class="col-md-3 col-md-offset-3"><b>{{ $frete }}</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-md-offset-3"><b>Total</b></div>
                                        <input type="hidden" id="total" name="total" value="{{ $total_sql }}">
                                        <div class="col-md-3 col-md-offset-3"><b>{{ $total }}</b></div>
                                    </div>
                                    <div class="row">
                                        <p>
                                            <div class="col-md-4 col-md-offset-9">
                                                    <button type="submit" name="finalizar" class="btn btn-success">Finalizar Compra</button>
                                                </form>
                                            </div>
                                        </p>
                                    </div>
                                </form>
                        @else
                            <h3>O seu carrinho esta vazio</h3>
                        @endif
                    </div>    
            </div>
        </div>
    </div>
</div>
@endsection
