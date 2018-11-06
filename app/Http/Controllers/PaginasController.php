<?php namespace App\Http\Controllers;

use App\Services\Upload;
use App\Paginas;
use App\PaginasFotos;
use Input;
use File;
use Route;


class PaginasController extends Controller
{

    public function init()
    {
    }

    public function index()
    {

        $itens = Paginas::orderBy('created_at', 'desc');

        if (Input::has("busca")) {
            $itens = Paginas::where(function ($query) {
                $query->where('PagTitulo', 'like', '%' . Input::get("busca") . '%')
                    ->orWhere('PagResumo', 'like', '%' . Input::get("busca") . '%');
            });
        }

        $itens = $itens->paginate(15);

        return view("painel.paginas.index", compact('itens'));

    }

    public function create()
    {
        return view("painel.paginas.create");
    }

    public function create2()
    {
        $url = str_ireplace(array("á", "à", "ã", "â", "é", "ê", "í", "ó", "ô", "õ", "ú", "ü", "ç", "Á", "À", "Ã", "Â", "É", "Ê", "Í", "Ó", "Ô", "Õ", "Ú", "Ü", "Ç", ",", " ", "?", "!", "@", "#", "$", "%", "¨", "&", "*", "(", ")", "=", "+", "/", "|", "[", "{", "}", "]"),
            array("a", "a", "a", "a", "e", "e", "i", "o", "o", "o", "u", "u", "c", "a", "a", "a", "a", "e", "e", "i", "o", "o", "o", "u", "u", "c", "", "-", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""), Input::get('titulo'));


        $create = new Paginas;

        $create->PagTitulo = Input::get('titulo');
        $create->PagResumo = Input::get('resumo');
        $create->PagConteudo = Input::get('conteudo');

        $create->save();

        return redirect(url('painel') . '/paginas')->with('success', 'Registro incluído com sucesso!');
    }

    public function update()
    {
        $item = Paginas::where('PagCodigo', '=', Route::input('id_pag'))->first();

        return view("painel.paginas.update", compact('item'));
    }

    public function update2()
    {
        $update = Paginas::find(Route::input('id_pag'));

        $update->PagTitulo = Input::get('titulo');
        $update->PagResumo = Input::get('resumo');
        $update->PagConteudo = Input::get('conteudo');

        $update->save();

        $query_string = array(
            "busca" => Input::get("busca"),
            "page" => Input::get("page")
        );

        return redirect(url('painel') . '/paginas?' . http_build_query($query_string))->with('success', 'Registro alterado com sucesso!');
    }

    public function destroy()
    {
        $itens = PaginasFotos::where('FotPagCodigo', '=', Route::input('id_pag'))->get();

        foreach ($itens as $item) {
            PaginasFotos::where('PagCodigo', '=', $item->FotCodigo)->delete();
        }

        Paginas::where('PagCodigo', '=', Route::input('id_pag'))->delete();


        $query_string = array(
            "busca" => Input::get("busca"),
            "page" => Input::get("page")
        );

        return redirect(url('painel') . '/paginas?' . http_build_query($query_string))->with('success', 'Registro excluido com sucesso!');
    }

}
