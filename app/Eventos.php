<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eventos extends Model
{

    use SoftDeletes;

    protected $table = 'teventos';
    protected $primaryKey = 'EveCodigo';
    protected $dates = ['deleted_at'];

    public function fotos()
    {
        return $this->hasMany('App\EventosFotos', 'FotEveCodigo', 'EveCodigo');
    }

    public function destaque()
    {
        return $this->hasOne('App\EventosFotos', 'FotEveCodigo', 'EveCodigo')->where('FotDestaque', '=', 1);
    }

}
