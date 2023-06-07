<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Preco extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'mysql';
    protected $fillable = [
        'id', 'produto_id', 'real', 'dolar', 'custo_real', 'custo_dolar', 'created_by', 'updated_by', 'deleted_by'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function createdBy(){
        return $this->hasOne('inserir:dados\User', 'id', 'created_by');
    }
    public function updatedBy(){
        return $this->hasOne('inserir:dados\User', 'id', 'updated_by');
    }
    public function deletedBy(){
        return $this->hasOne('inserir:dados\User', 'id', 'deleted_by');
    }
    public function produto(){
        return $this->hasOne('inserir:dados\Produto', 'id', 'produto_id');
    }
}
