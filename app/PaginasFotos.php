<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaginasFotos extends Model
{
    use SoftDeletes;

    protected $table = 'tpaginasfotos';
    protected $primaryKey = 'FotCodigo';
    protected $dates = ['deleted_at'];

//    protected $fillable = ['FotCodigo', 'FotPagCodigo', 'FotLegenda'];
}
