<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPerfil extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'mysql';
    protected $table = 'users_perfis';
    protected $fillable = [
        'id', 'descricao', 'created_by', 'updated_by', 'deleted_by'
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
}
