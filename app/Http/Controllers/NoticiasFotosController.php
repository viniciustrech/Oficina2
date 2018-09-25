<?php namespace App\Http\Controllers;

use App\Noticias;
use App\NoticiasFotos;
use App\Services\Upload;
use Route;
use Input;
use File;


class NoticiasFotosController extends Controller
{
    public function init(){}

    public function index()
    {
        $itens = NoticiasFotos::where('FotNotCodigo', '=', Route::input('id_not'))
            ->orderBy('FotDestaque', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view("painel.noticias.fotos.index", compact('itens'));
    }

    public function upload(Upload $upload)
    {
        if (Input::hasFile('file')) {

            $upload->resize(Input::file("file"), public_path() . "/upload/noticias/g_" . Route::input('id_fot') . ".jpg", getenv("TamGW"), getenv("TamGH"));
            $upload->resize(Input::file("file"), public_path() . "/upload/noticias/p_" . Route::input('id_fot') . ".jpg", getenv("TamPW"), getenv("TamPH"));

            $foto = NoticiasFotos::find(Route::input('id_fot'));
            $foto->updated_at = date('Y-m-d H:i:s');
            $foto->save();

            $this->save_log("UP", "tNoticiasFotos", Route::input('id_fot'));

            return 1;
        } else {
            return 0;
        }
    }

    public function multiploupload(Upload $upload)
    {
        if (Input::hasFile('file')) {

            $destaque = NoticiasFotos::selectRaw('FotCodigo')
                ->where('FotNotCodigo', '=', Route::input('id_not'))->get();

            $foto = new NoticiasFotos();
            $foto->FotNotCodigo = Route::input('id_not');
            $foto->updated_at = date('Y-m-d H:i:s');

            if (count(@$destaque) < 1) {
                $foto->FotDestaque = 1;
            }

            $foto->save();

            $codigo = $foto->FotCodigo;

            $this->save_log("C", "tNoticiasFotos", $codigo);

            $upload->resize(Input::file('file'), public_path() . "/upload/noticias/g_" . $codigo . ".jpg", getenv("TamGW"), getenv("TamGH"));
            $upload->resize(Input::file('file'), public_path() . "/upload/noticias/p_" . $codigo . ".jpg", getenv("TamPW"), getenv("TamPH"));

            if ($foto->FotDestaque == 1) {

                $noticia = Noticias::find(Route::input('id_not'));

                $noticia->updated_at = date('Y-m-d H:i:s');
                $noticia->save();
            }

            return 1;
        } else {
            return 0;
        }
    }

    public function destroy()
    {
        NoticiasFotos::where('FotCodigo', '=', Route::input('id_fot'))->delete();

        $this->save_log("D", "tNoticiasFotos", Route::input('id_fot'));

        $query_string = array(
            "busca" => Input::get("busca"),
            "page" => Input::get("page")
        );

        return redirect(getenv("PAINEL") . '/noticias/' . Route::input('id_not') . '/fotos?' . http_build_query($query_string))->with('success', 'Registro excluido com sucesso!');
    }

    public function destaque()
    {

        $fotos = NoticiasFotos::where('FotNotCodigo', '=', Route::input('id_not'))->get();

        if (count(@$fotos) > 0) {
            foreach ($fotos as $update) {

                if ($update->FotDestaque == 1 && Route::input('id_fot') != $update->FotCodigo) {
                    $update->FotDestaque = 0;
                }

                if (Route::input('id_fot') == $update->FotCodigo) {
                    $update->FotDestaque = 1;
                }

                $this->save_log("U", $update->getTable(), $update);
                $update->save();
            }

            $noticia = Noticias::where('NotCodigo', '=', Route::input('id_not'))->first();
            $noticia->updated_at = date('Y-m-d H:i:s');
            $noticia->save();

            return redirect(getenv("PAINEL") . '/noticias/' . Route::input('id_not') . '/fotos')->with('success', 'Registro alterado com sucesso!');
        }
        return redirect(getenv("PAINEL") . '/noticias/' . Route::input('id_not') . '/fotos')->with('error', 'Não foi possível alterar foto destaque!');
    }

    public function legenda()
    {

        $update = NoticiasFotos::find(Route::input('id_fot'));

        if (count(@$update) > 0) {
            $update->FotLegenda = Input::get('legenda');

            $update->save();

            $this->save_log("U", $update->getTable(), $update);

            if ($update->FotDestaque == 1) {

                $noticia = Noticias::where('NotCodigo', '=', Route::input('id_not'))->first();

                $noticia->updated_at = date('Y-m-d H:i:s');
                $noticia->save();
            }

            return 1;
        } else {
            return 0;
        }

    }

}
