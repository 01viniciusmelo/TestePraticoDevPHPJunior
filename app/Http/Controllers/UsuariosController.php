<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::get();

        return view('usuarios.index', [
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ], [
            'name.required' => 'O Usuário é obrigatório.',
            'email.required' => 'O E-mail é obrigatório.',
            'password.required' => 'A Senha é obrigatória.',
            'password.min' => 'A Senha deve ter pelo menos 6 caracteres incluindo letras e números.',
            'password.confirmed' => 'As senhas não conferem.',
            'password_confirmation.required' => 'A Confirmação de Senha é obrigatória.',
            'password_confirmation.min' => 'A Confirmação de Senha deve ter pelo menos 6 caracteres incluindo letras e números.',
        ]);

        $usuario = $request->all();
        $usuario['password'] = bcrypt($usuario['password']);

        User::create($usuario);

        return redirect('usuarios')->with('success', 'Novo Usuário adicionado.');
    }

    /**
     * Show data.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.show', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', [
            'usuario' => $usuario,
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ], [
            'name.required' => 'O Usuário é obrigatório.',
            'email.required' => 'O E-mail é obrigatório.',
            'password.required' => 'A Senha é obrigatória.',
            'password.min' => 'A Senha deve ter pelo menos 6 caracteres incluindo letras e números.',
            'password.confirmed' => 'As senhas não conferem.',
            'password_confirmation.required' => 'A Confirmação de Senha é obrigatória.',
            'password_confirmation.min' => 'A Confirmação de Senha deve ter pelo menos 6 caracteres incluindo letras e números.',
        ]);

        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->cpf = $request->get('cpf');
        $usuario->data_nascimento = $request->get('data_nascimento');
        $usuario->password = bcrypt($request->get('password'));

        $usuario->save();

        return redirect('usuarios')->with('success', 'Um Usuário foi atualizado.');
    }

    /**
     * Desativar registro
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        return redirect('usuarios')->with('success', 'Um Usuário foi excluído.');
    }
}
