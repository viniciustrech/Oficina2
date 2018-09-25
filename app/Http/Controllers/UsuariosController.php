<?php namespace App\Http\Controllers;

use App\User;
use Input;
use Hash;
use Auth;
use Route;

class UsuariosController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $itens = User::orderBy('created_at', 'desc');

        if (Input::has("busca")) {
            $itens = User::where(function ($query) {
                $query->where('name', 'like', '%' . Input::get("busca") . '%')
                    ->orWhere('email', 'like', '%' . Input::get("busca") . '%');
            });
        }

        $itens = $itens->paginate(15);

        return view('painel.usuarios.index', compact('itens'));
    }

    public function create()
    {
        return view('painel.usuarios.create');
    }

    public function create2()
    {
        $create = new User();

        $create->name = Input::get('name');
        $create->email = Input::get('email');

        if (Input::has('senha')) {
            $create->password = Hash::make(Input::get('senha'));
        }

        $create->save();

        return redirect('painel/usuarios')->with('success', 'Registro adicionado com sucesso!');
    }

    public function update()
    {
        $item = User::find(Route::input('id'));

        return view('painel.usuarios.update', compact('item'));
    }

    public function update2()
    {
        $update = User::find(Route::input('id'));

        $update->name = Input::get('name');
        $update->email = Input::get('email');

        if (Input::has('senha')) {
            $update->password = Hash::make(Input::get('senha'));
        }

        $update->save();

        return redirect('painel/usuarios')->with('success', 'Registro alterado com sucesso!');
    }

    public function destroy()
    {
        User::find(Route::input('id'))->delete();

        return redirect('painel/usuarios')->with('success', 'Registro excluido com sucesso!');
    }

}
