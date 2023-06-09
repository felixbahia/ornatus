<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoItem extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'mysql';
    protected $table = 'pedidos_itens';
    protected $fillable = [
        'id', 'pedido_id', 'produto_id', 'carrinho_id', 'valor', 'created_by', 'updated_by', 'deleted_by'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function createdBy(){
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    public function updatedBy(){
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
    public function deletedBy(){
        return $this->hasOne('App\User', 'id', 'deleted_by');
    }
    public function pedido(){
        return $this->hasOne('App\Pedido', 'id', 'pedido_id');
    }
    public function produto(){
        return $this->hasOne('App\Produto', 'id', 'produto_id');
    }
    public function carrinho(){
        return $this->hasOne('App\Carrinho', 'id', 'carrinho_id');
    }
}
