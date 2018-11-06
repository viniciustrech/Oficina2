<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contatos extends Model
{

    use SoftDeletes;

    protected $table = 'tcontatos';
    protected $primaryKey = 'ConCodigo';
    protected $dates = ['deleted_at'];
}
