<?php namespace App\Http\Controllers;

use App\Documentos;
use App\Eventos;
use App\EventosFotos;
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

        $itens = $itens->paginate(5);

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
            $update->EveLiberado = ($update->EveLiberado == 1) ? "0" : "1";
            $update->save();

            return $update->EveLiberado;
        }
    }


    public function multiploupload()
    {

        if (Input::hasFile('file')) {

            $create = new Documentos();

            $create->DocEveCodigo = Route::input('id_eve');
            $create->updated_at = date('Y-m-d h:i:s');

            $create->save();

            $_UP['pasta'] = 'upload/documentos/';
            $_UP['extensoes'] = array('xls', 'doc', 'docx', 'esl', 'pdf', 'zip', 'rar');

            $_UP['erros'][0] = 'Não houve erro';
            $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
            $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
            $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
            $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

            if ($_FILES['file']['error'] != 0) {
                return 0;
            }

            $nome = explode('.', $_FILES['file']['name']);
            $extensao = strtolower($nome[count($nome) - 1]);

            if (array_search($extensao, $_UP['extensoes']) === false) {
                return 0;
            }

            $nome_final = $create->DocCodigo . '.' . $extensao;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $_UP['pasta'] . $nome_final)) {

                $arquivo2 = Documentos::find($create->DocCodigo);

                $arquivo2->DocArquivo = $nome_final;
                $arquivo2->updated_at = date('Y-m-d h:i:s');

                $arquivo2->save();
                return 1;
            } else {
                return 0;
            }

            return 1;
        } else {
            return 0;
        }
    }
}
