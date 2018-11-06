<?php namespace App\Http\Controllers;

use App\Eventos;
use App\EventosFotos;
use App\Services\Upload;
use Route;
use Input;
use File;


class EventosFotosController extends Controller
{
    public function init(){}

    public function index()
    {
        $itens = EventosFotos::where('FotEveCodigo', '=', Route::input('id_eve'))
            ->orderBy('FotDestaque', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view("painel.eventos.fotos.index", compact('itens'));
    }

    public function upload(Upload $upload)
    {
        if (Input::hasFile('file')) {

            $upload->resize(Input::file("file"), public_path() . "/upload/eventos/g_" . Route::input('id_fot') . ".jpg", getenv("TamGW"), getenv("TamGH"));
            $upload->resize(Input::file("file"), public_path() . "/upload/eventos/p_" . Route::input('id_fot') . ".jpg", getenv("TamPW"), getenv("TamPH"));

            $foto = EventosFotos::find(Route::input('id_fot'));
            $foto->updated_at = date('Y-m-d H:i:s');
            $foto->save();

            return 1;
        } else {
            return 0;
        }
    }

    public function multiploupload(Upload $upload)
    {
        if (Input::hasFile('file')) {

            $destaque = EventosFotos::selectRaw('FotCodigo')
                ->where('FotEveCodigo', '=', Route::input('id_eve'))->get();

            $foto = new EventosFotos();
            $foto->FotEveCodigo = Route::input('id_eve');
            $foto->updated_at = date('Y-m-d H:i:s');

            if (count(@$destaque) < 1) {
                $foto->FotDestaque = 1;
            }

            $foto->save();

            $codigo = $foto->FotCodigo;

            $upload->resize(Input::file('file'), public_path() . "/upload/eventos/g_" . $codigo . ".jpg", getenv("TamGW"), getenv("TamGH"));
            $upload->resize(Input::file('file'), public_path() . "/upload/eventos/p_" . $codigo . ".jpg", getenv("TamPW"), getenv("TamPH"));

            if ($foto->FotDestaque == 1) {

                $evento = Eventos::find(Route::input('id_eve'));

                $evento->updated_at = date('Y-m-d H:i:s');
                $evento->save();
            }

            return 1;
        } else {
            return 0;
        }
    }

    public function destroy()
    {
        EventosFotos::where('FotCodigo', '=', Route::input('id_fot'))->delete();

        return redirect(url('painel') . '/eventos/' . Route::input('id_eve') . '/fotos?')->with('success', 'Registro excluido com sucesso!');
    }

    public function destaque()
    {

        $fotos = EventosFotos::where('FotEveCodigo', '=', Route::input('id_eve'))->get();

        if (count(@$fotos) > 0) {
            foreach ($fotos as $update) {

                if ($update->FotDestaque == 1 && Route::input('id_fot') != $update->FotCodigo) {
                    $update->FotDestaque = 0;
                }

                if (Route::input('id_fot') == $update->FotCodigo) {
                    $update->FotDestaque = 1;
                }

                $update->save();
            }

            $evento = Eventos::where('EveCodigo', '=', Route::input('id_eve'))->first();
            $evento->updated_at = date('Y-m-d H:i:s');
            $evento->save();

            return redirect(url('painel') . '/eventos/' . Route::input('id_eve') . '/fotos')->with('success', 'Registro alterado com sucesso!');
        }
        return redirect(url('painel') . '/eventos/' . Route::input('id_eve') . '/fotos')->with('error', 'Não foi possível alterar foto destaque!');
    }

    public function legenda()
    {

        $update = EventosFotos::find(Route::input('id_fot'));

        if (count(@$update) > 0) {
            $update->FotLegenda = Input::get('legenda');

            $update->save();

            if ($update->FotDestaque == 1) {

                $evento = Eventos::where('EveCodigo', '=', Route::input('id_eve'))->first();

                $evento->updated_at = date('Y-m-d H:i:s');
                $evento->save();
            }

            return 1;
        } else {
            return 0;
        }

    }

}
