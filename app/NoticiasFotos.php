<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoticiasFotos extends Model
{
    use SoftDeletes;

    protected $table = 'tnoticiasfotos';
    protected $primaryKey = 'FotCodigo';
    protected $dates = ['deleted_at'];
}
