<?php namespace App\Http\Controllers;

use App\Eventos;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\NoticiasFotos;
use Illuminate\Http\Request;
use App\Services\Upload;
use App\Noticias;
use Route;
use Input;
use File;


class EventosController extends Controller
{
    public function init()
    {
    }

    public function index()
    {
        $itens = Eventos::orderBy('created_at', 'desc');

        if (Input::has("busca")) {
            $itens = $itens->where(function ($query) {
                $query->where('EveTitulo', 'like', '%' . Input::get("busca") . '%')
                    ->orWhere('EveResumo', 'like', '%' . Input::get("busca") . '%')
                    ->orWhere('EveConteudo', 'like', '%' . Input::get("busca") . '%');
            });
        }

        $itens = $itens->paginate(15);

        return view("painel.eventos.index", compact('itens'));
    }

    public function create()
    {
        return view("painel.eventos.create");
    }

    public function create2()
    {
        $create = new Eventos();

        $create->EveTitulo = Input::get('titulo');
        $create->EveResumo = Input::get('resumo');
        $create->EveConteudo = Input::get('conteudo');
        $create->EveData = implode("-", array_reverse(explode("/", Input::get('data'))));
        $create->EveLiberado = Input::get('liberado');

        $create->save();

        return redirect(url('painel') . "/eventos")->with('success', 'Registro incluído com sucesso!');
    }

    public function update()
    {
        $item = Eventos::where('EveCodigo', '=', Route::input('id_eve'))
            ->firstOrFail();

        return view("painel.eventos.update", compact('item'));
    }

    public function update2()
    {
        $update = Eventos::find(Route::input('id_eve'));

        $update->EveTitulo = Input::get('titulo');
        $update->EveResumo = Input::get('resumo');
        $update->EveConteudo = Input::get('conteudo');
        $update->EveData = implode("-", array_reverse(explode("/", Input::get('data'))));
        $update->EveLiberado = Input::get('liberado');

        $update->save();

         return redirect(url('painel') . "/eventos")->with('success', 'Registro alterado com sucesso!');
    }

    public function destroy()
    {
        Eventos::where('EveCodigo', '=', Route::input('id_eve'))->delete();

        return redirect(url('painel') . "/eventos?")->with('success', 'Registro excluido com sucesso!');
    }

    public function liberado()
    {
        $update = Eventos::find(Route::input('id_eve'));

        if (count(@$update) > 0) {
            $update->EveLiberado = ($update->EveLiberado == 1)? "0":"1";
            $update->save();

            return $update->EveLiberado;
        }
    }
}
