<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'mysql';
    protected $fillable = [
        'id', 'numero', 'cliente_id', 'valor_total_produtos', 'frete', 'valor_total', 'status_id', 'created_by', 'updated_by', 'deleted_by'
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
    public function cliente(){
        return $this->hasOne('App\DadosCliente', 'id', 'cliente_id');
    }
    public function pedidoItem(){
        return $this->hasMany('App\PedidoItem', 'pedido_id', 'id');
    }
    public function status(){
        return $this->hasOne('App\PedidoStatus', 'id', 'status_id');
    }
}
