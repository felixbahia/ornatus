<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'mysql';
    protected $fillable = [
        'id', 'categoria_id', 'codigo', 'descricao', 'foto', 'created_by', 'updated_by', 'deleted_by'
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
    public function categoria(){
        return $this->hasOne('App\User', 'id', 'categoria_id');
    }
    public function estoque(){
        return $this->hasOne('App\Estoque', 'produto_id', 'id');
    }
    public function preco(){
        return $this->hasOne('App\Preco', 'produto_id', 'id');
    }
}
