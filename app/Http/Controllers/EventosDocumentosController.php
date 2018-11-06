<?php namespace App\Http\Controllers;

use App\Documentos;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Upload;
use Input;
use Route;
use File;

class EventosDocumentosController extends Controller
{
    public function init()
    {
    }

    public function index()
    {
        $itens = Documentos::where('DocEveCodigo', Route::input('id_eve'))->get();

        if (Input::has("busca")) {
            $itens = $itens->where('DocTitulo', 'like', '%' . Input::get("busca") . '%')
                ->paginate(500);
        }

        return view("painel.eventos.documentos.index", compact('itens'));
    }


    public function update()
    {
        $item = Documentos::where('DocCodigo', '=', Route::input('id_doc'))->firstOrFail();

        return view("painel.eventos.documentos.update", compact('item'));
    }

    public function update2()
    {

        $update = Documentos::find(Route::input('id_doc'));

        $update->DocTitulo = Input::get('titulo');
        $update->DocLiberado = Input::get('liberado');

        $update->save();

        return redirect(url("painel") ."/eventos" . Route::input('id_eve') ."/documentos")->with('success', 'Registro alterado com sucesso!');
    }

    public function destroy()
    {
        Documentos::find(Route::input('id_doc'))->delete();

        return redirect(url("painel") ."/eventos" . Route::input('id_eve') ."/documentos")->with('success', 'Registro excluido com sucesso!');
    }

    public function legenda()
    {

        $update = Documentos::find(Route::input('id_doc'));

        if (count(@$update) > 0) {
            $update->DocTitulo = Input::get('legenda');

            $update->save();

            return 1;
        } else {
            return 0;
        }

    }
}
