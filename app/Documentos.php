<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documentos extends Model {

    use SoftDeletes;

    protected $table = 'tdocumentos';
    protected $primaryKey = 'DocCodigo';
    protected $dates = ['deleted_at'];
}
