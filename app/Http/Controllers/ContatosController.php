<?php namespace App\Http\Controllers;

use App\Contatos;
use Mail;
use Route;
use Input;
use File;


class ContatosController extends Controller
{
    public function init(){}
    public function index()
    {
        $itens = Contatos::orderBy('created_at', 'desc');

        if (Input::has("busca")) {
            $itens = $itens->where(function ($query) {
                $query->where('ConNome', 'like', '%' . Input::get("busca") . '%')
                    ->orWhere('ConConteudo', 'like', '%' . Input::get("busca") . '%');
            });
        }

            $itens = $itens->paginate(15);

            return view("painel.contatos.index", compact('itens'));
    }

    public function view()
    {
        $item = Contatos::where('ConCodigo', '=', Route::input('id_con'))
            ->first();

            return view("painel.contatos.view", compact('item'));

    }

    public function destroy()
    {
        Contatos::where('ConCodigo', '=', Route::input('id_con'))->delete();

        return redirect(url('painel') . "/contatos?")->with('success', 'Registro excluido com sucesso!');
    }


}
