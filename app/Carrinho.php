<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrinho extends Model
{
    
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $connection = 'mysql';
    protected $fillable = [
        'id', 'produto_id', 'quantidade', 'finalizado',  'created_by', 'updated_by', 'deleted_by'
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
    public function produto(){
        return $this->hasOne('App\Produto', 'id', 'produto_id');
    }
}
