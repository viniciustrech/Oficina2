<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paginas extends Model
{
    use SoftDeletes;

    protected $table = 'tpaginas';
    protected $primaryKey = 'PagCodigo';
    protected $dates = ['deleted_at'];

    public function fotos(){
        return $this->hasMany('App\PaginasFotos', 'FotPagCodigo', 'PagCodigo');
    }
}
