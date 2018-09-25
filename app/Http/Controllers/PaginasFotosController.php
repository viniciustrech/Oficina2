<?php namespace App\Http\Controllers;

use App\Paginas;
use Illuminate\Http\Request;
use App\Services\Upload;
use App\PaginasFotos;
use Input;
use File;
use Route;


class PaginasFotosController extends Controller
{

    public function init()
    {
    }

    public function index()
    {
        $itens = PaginasFotos::where('FotPagCodigo', '=', Route::input('id_pag'))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view("painel.paginas.fotos.index", compact('itens'));
    }

    public function update()
    {
        $item = PaginasFotos::where('FotCodigo', '=', Route::input('id_fot'))
            ->firstOrFail();

        return view("painel.paginas.fotos.update", compact('item'));
    }

    public function update2(Request $request)
    {
        $update = PaginasFotos::find(Route::input('id_fot'));
        $update->FotLegenda = $request->input('legenda');
        $update->save();

        $this->save_log("U", $update->getTable(), $update);

        $query_string = array(
            "busca" => Input::get("busca"),
            "page" => Input::get("page")
        );

        return redirect(getenv("PAINEL") . '/paginas/' . Route::input('id_pag') . '/fotos?' . http_build_query($query_string))->with('success', 'Registro alterado com sucesso!');
    }

    public function destroy()
    {
        PaginasFotos::where('FotCodigo', '=', Route::input('id_fot'))->delete();

        $this->save_log("D", "tpaginasfotos", Route::input('id_fot'));

        $query_string = array(
            "busca" => Input::get("busca"),
            "page" => Input::get("page")
        );

        return redirect(getenv("PAINEL") . '/paginas/' . Route::input('id_pag') . '/fotos?' . http_build_query($query_string))->with('success', 'Registro excluido com sucesso!');
    }

    public function upload(Upload $upload)
    {
        if (Input::hasFile('file')) {

            $upload->resize(Input::file("file"), public_path() . "/upload/paginas/g_" . Route::input('id_fot') . ".jpg", getenv("TamGW"), getenv("TamGH"));
            $upload->resize(Input::file("file"), public_path() . "/upload/paginas/p_" . Route::input('id_fot') . ".jpg", getenv("TamPW"), getenv("TamPH"));

            $foto = PaginasFotos::find(Route::input('id_fot'));
            $foto->updated_at = date('Y-m-d H:i:s');
            $foto->save();

            $this->save_log("UP", "tpaginasfotos", Route::input('id_fot'));

            return 1;
        } else {
            return 0;
        }
    }

    public function multiploupload(Upload $upload)
    {
        if (Input::hasFile('file')) {

            $destaque = PaginasFotos::selectRaw('FotCodigo')
                ->where('FotPagCodigo', '=', Route::input('id_pag'))->get();

            $foto = new PaginasFotos();
            $foto->FotPagCodigo = Route::input('id_pag');
            $foto->updated_at = date('Y-m-d H:i:s');

            if (count(@$destaque) < 1) {
                $foto->FotDestaque = 1;
            }

            $foto->save();

            $codigo = $foto->FotCodigo;

            $this->save_log("C", "tPaginasFotos", $codigo);

            $upload->resize(Input::file('file'), public_path() . "/upload/paginas/g_" . $codigo . ".jpg", getenv("TamGW"), getenv("TamGH"));
            $upload->resize(Input::file('file'), public_path() . "/upload/paginas/p_" . $codigo . ".jpg", getenv("TamPW"), getenv("TamPH"));

            if ($foto->FotDestaque == 1) {

                $noticia = Paginas::find(Route::input('id_pag'));

                $noticia->updated_at = date('Y-m-d H:i:s');
                $noticia->save();
            }

            return 1;
        } else {
            return 0;
        }
    }

    public function destaque()
    {

        $fotos = PaginasFotos::where('FotPagCodigo', '=', Route::input('id_pag'))->get();

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

            $noticia = Paginas::find(Route::input('id_pag'));
            $noticia->updated_at = date('Y-m-d H:i:s');
            $noticia->save();

            return redirect(getenv("PAINEL") . '/paginas/' . Route::input('id_pag') . '/fotos')->with('success', 'Registro alterado com sucesso!');
        }
        return redirect(getenv("PAINEL") . '/paginas/' . Route::input('id_pag') . '/fotos')->with('error', 'Não foi possível alterar foto destaque!');
    }

    public function legenda()
    {

        $update = PaginasFotos::find(Route::input('id_fot'));

        if (count(@$update) > 0) {
            $update->FotLegenda = Input::get('legenda');

            $update->save();

            $this->save_log("U", $update->getTable(), $update);

            if ($update->FotDestaque == 1) {

                $pagina = Paginas::find(Route::input('id_pag'));

                $pagina->updated_at = date('Y-m-d H:i:s');
                $pagina->save();
            }

            return 1;
        } else {
            return 0;
        }

    }

}
