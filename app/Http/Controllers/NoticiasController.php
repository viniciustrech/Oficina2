<?php namespace App\Http\Controllers;

use App\Noticias;
use Route;
use Input;
use File;


class NoticiasController extends Controller
{
    public function init()
    {
    }

    public function index()
    {
        $itens = Noticias::orderBy('NotData', 'desc');

        if (Input::has("busca")) {
            $itens = $itens->where(function ($query) {
                $query->where('NotTitulo', 'like', '%' . Input::get("busca") . '%')
                    ->orWhere('NotResumo', 'like', '%' . Input::get("busca") . '%');
            });
        }

        $itens = $itens->paginate(15);

        return view("painel.noticias.index", compact('itens'));
    }

    public function create()
    {
        return view("painel.noticias.create");
    }

    public function create2()
    {
        $create = new Noticias;

        $create->NotData = implode("-", array_reverse(explode("/", Input::get('data'))));
        $create->NotTitulo = Input::get('titulo');
        $create->NotResumo = Input::get('resumo');
        $create->NotConteudo = Input::get('conteudo');
        $create->NotFonte = Input::get('fonte');
        $create->NotLiberado = Input::get('liberado');

        $create->save();

        return redirect(url('painel') . "/noticias")->with('success', 'Registro incluído com sucesso!');
    }

    public function update()
    {
        $item = Noticias::where('NotCodigo', '=', Route::input('id_not'))
            ->firstOrFail();

        return view("painel.noticias.update", compact('item'));
    }

    public function update2()
    {
        $update = Noticias::find(Route::input('id_not'));

        $update->NotData = implode("-", array_reverse(explode("/", Input::get('data'))));
        $update->NotTitulo = Input::get('titulo');
        $update->NotResumo = Input::get('resumo');
        $update->NotConteudo = Input::get('conteudo');
        $update->NotFonte = Input::get('fonte');
        $update->NotLiberado = Input::get('liberado');

        $update->save();

        $query_string = array(
            "busca" => Input::get("busca"),
            "page" => Input::get("page")
        );

        return redirect(url('painel') . "/noticias?" . http_build_query($query_string))->with('success', 'Registro alterado com sucesso!');
    }

    public function destroy()
    {
        Noticias::where('NotCodigo', '=', Route::input('id_not'))->delete();


        $query_string = array(
            "busca" => Input::get("busca"),
            "page" => Input::get("page")
        );

        return redirect(url('painel') . "/noticias?" . http_build_query($query_string))->with('success', 'Registro excluido com sucesso!');
    }

    public function liberado()
    {
        $update = Noticias::find(Route::input('id_not'));

        if (count(@$update) > 0) {
            $update->NotLiberado = ($update->NotLiberado == 1)? "0":"1";
            $update->save();

            return $update->NotLiberado;
        }
    }

}
