@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Pedidos</div>
                    <div class="panel-body" style="font-family: Arial, Helvetica, sans-serif">
                        @if(!empty($pedidos))
                            @foreach($pedidos as $pedido)
                                <h4>Numero Pedido: {{ $pedido['numero'] }}</h4>
                                <h4>Status Pedido: {{ $pedido['status'] }}</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <thr>
                                            <th>Codigo</th>
                                            <th>Descrição</th>
                                            <th>Quantidade</th>
                                            <th>Valor</th>
                                        </thr>
                                    </thead>
                                    <tbody>
                                        @foreach($pedido['itens'] as $item)
                                            <tr>
                                                <td>{{ $item['codigo'] }}</td>
                                                <td>{{ $item['descricao'] }}</td>
                                                <td>{{ $item['quantidade'] }}</td>
                                                <td>{{ $item['valor'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            <th></th>
                                            <th></th>
                                            <th>{{ $pedido['total'] }}</th>
                                        </tr>
                                    </tfoot> 
                                </table>
                            @endforeach
                        @else
                            <h3>Não há nenhum pedido!</h3>
                        @endif
                    </div>    
            </div>
        </div>
    </div>
</div>
@endsection
