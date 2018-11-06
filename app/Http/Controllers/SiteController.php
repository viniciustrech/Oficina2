<?php namespace App\Http\Controllers;

use App\Contatos;
use App\Documentos;
use App\Eventos;
use App\EventosFotos;
use App\Noticias;
use App\NoticiasFotos;
use App\Paginas;
use App\PaginasFotos;
use Illuminate\Support\Facades\Mail;
Use Route;
Use Input;
Use Request;

class SiteController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('site.home');
	}

	public function eventos(){

	    $eventos = Eventos::where('EveLiberado', 1);
	    $titulo = "Eventos";
        $conteudo = Paginas::where('PagTitulo', 'Eventos')->first();

        if (Input::has("busca")) {
            $eventos = $eventos->where(function ($query) {
                $query->where('EveTitulo', 'like', '%' . Input::get("busca") . '%')
                    ->orWhere('EveResumo', 'like', '%' . Input::get("busca") . '%')
                    ->orWhere('EveConteudo', 'like', '%' . Input::get("busca") . '%')
                    ->orWhere('EveData', 'like', '%' . Input::get("busca") . '%');
            });

            $eventos = $eventos->paginate(15);
        }else{
            $eventos = $eventos->paginate(15);
        }

	    return view('site.eventos', compact('eventos', 'titulo', 'conteudo'));
    }

    public function evento()
    {

        $evento = Eventos::where('EveLiberado', 1)
            ->where('EveCodigo', '=', Route::input("id_eve"))
            ->first();

        $itens = EventosFotos::where('FotEveCodigo', '=', Route::input('id_eve'))
            ->orderBy('FotCodigo', 'desc')
            ->get();

        $documentos = Documentos::where('DocEveCodigo', Route::input('id_eve'))->get();


        return view("site.evento", compact('evento', 'itens', 'documentos'));

    }

    public function noticias()
    {
        $titulo = "Notícias";

        $noticias = Noticias::where('NotLiberado', '=', 1)->orderBy('NotCodigo', 'desc')->paginate(15);
        $conteudo = Paginas::where('PagTitulo', 'Noticias')->first();

        return view("site.noticias", compact('noticias', 'titulo', 'conteudo'));
    }

    public function noticia()
    {
        $noticia = Noticias::where('NotLiberado', 1)
            ->where('NotCodigo', '=', Route::input("id_not"))
            ->first();

        $itens = NoticiasFotos::where('FotNotCodigo', '=', Route::input('id_not'))
            ->orderBy('FotCodigo', 'desc')
            ->get();

        return view("site.noticia", compact('noticia', 'itens'));

    }

    public function contato()
    {
        $titulo = "Contato";
        $pagina = Paginas::where("PagTitulo", "like", "Contato")->first();

        return view("site.contato", compact('titulo', 'pagina'));
    }

    public function contato2(\Illuminate\Http\Request $request)
    {
        //verify captcha
        $recaptcha_secret = "6LdPyHIUAAAAANL-6RgkNylYnZlaSm76q61fG0Qy";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
            'secret' => $recaptcha_secret,
            'response' => @$request->input('g-recaptcha-response'),
            'remoteIp' => $_SERVER['REMOTE_ADDR']
        )));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

        if ($response["success"]) {

            $create = new Contatos();

            $create->ConNome = $request->input('nome');
            $create->ConEmail = $request->input('email');
            $create->ConTelefone = $request->input('telefone');
            $create->ConMensagem = $request->input('mensagem');
            $create->ConConteudo = view("emails.contato", [
                'nome' => $request->input("nome"),
                'email' => $request->input("email"),
                'telefone' => $request->input("telefone"),
                'mensagem' => $request->input("mensagem")
            ]);

            $create->save();

            Mail::send('emails.contato', ['nome' => $request->input("nome"), 'email' => $request->input("email"), 'telefone' => $request->input("telefone"), 'mensagem' => $request->input("mensagem")], function ($m) use ($request) {
                $m->from(getenv("MAIL_USERNAME"), $request->input("nome"))->replyTo(getenv("MAIL_USERNAME"));

                $m->to(getenv("MAIL_USERNAME"), null)->subject('Mensagem do Site - ' . getenv("SITE"));
            });
            return redirect(url("contato"))->with('success', "Mensagem enviada com Sucesso");
        } else {
            return redirect(url("contato"))->with('error', "Mensagem não enviada, problema no recaptcha!");
        }
    }

    public function sobre()
    {
        $titulo = "Sobre";
        $pagina = Paginas::where("PagTitulo", "like", "Sobre")->first();

        return view("site.sobre", compact('titulo', 'pagina'));
    }

    public function downloads()
    {
        $downloads = Documentos::where('DowLiberado', '=', 1)
            ->whereNotNull('DowArquivo')
            ->orderBy('DowCodigo', 'desc')
            ->get();


        return view("site.documentos", compact('downloads'));
    }
}
