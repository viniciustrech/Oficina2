<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventosFotos extends Model
{
    use SoftDeletes;

    protected $table = 'teventosfotos';
    protected $primaryKey = 'FotCodigo';
    protected $dates = ['deleted_at'];
}
