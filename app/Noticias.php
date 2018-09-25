<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noticias extends Model
{

    use SoftDeletes;

    protected $table = 'tnoticias';
    protected $primaryKey = 'NotCodigo';
    protected $dates = ['deleted_at'];

    public function fotos()
    {
        return $this->hasMany('App\NoticiasFotos', 'FotNotCodigo', 'NotCodigo');
    }

    public function destaque()
    {
        return $this->hasOne('App\NoticiasFotos', 'FotNotCodigo', 'NotCodigo')->where('FotDestaque', '=', 1);
    }

}
