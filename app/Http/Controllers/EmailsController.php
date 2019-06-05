<?php
namespace App\Http\Controllers;

use App\Models\Emails;
use App\User;
use Illuminate\Http\Request;

class EmailsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::findOrFail(\Auth::user()->id);

        $emails = Emails::join('users', 'emails.user_id', '=', 'users.id')
            ->select('emails.*', 'users.name as nome_usuario')
            ->where([
                [
                    'emails.status',
                    '1',
                ],
            ])
            ->orderBy('id', 'desc')
            ->get();

        return view('emails.index', [
            'emails' => $emails,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista_usuarios = User::pluck('name', 'id');
        return view('emails.create', [
            'lista_usuarios' => $lista_usuarios,
        ]);
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
            'email' => 'required',
        ],
            [
                'email.required' => 'O Email é obrigatório.',
            ]
        );

        $email = new Emails();

        $email->user_id = $request->input('user_id');
        $email->email = $request->input('email');

        $email->save();

        return redirect('emails')->with('success', 'Novo Email adicionado.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email = Emails::findOrFail($id);
        $lista_usuarios = User::pluck('name', 'id');
        return view('emails.edit', [
            'email' => $email,
            'id' => $id,
            'lista_usuarios' => $lista_usuarios,
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
        $email = Emails::findOrFail($id);

        $this->validate(request(), [
            'email' => 'required',
        ],
            [
                'email.required' => 'O Email é obrigatório.',
            ]
        );

        $email->user_id = $request->get('user_id');
        $email->email = $request->get('email');

        $email->save();

        return redirect('emails')->with('success', 'Um Email foi atualizado.');
    }

    /**
     * Desativar registro
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function desativar($id)
    {
        $emails = Emails::where('status', '1')->get();

        if ($emails->count() == 1) {
            return redirect('emails')->withErrors([
                'message' => 'Não é permitido excluir o email selecionado.',
            ]);
        }

        $email = Emails::findOrFail($id);
        $email->status = 0;
        $email->save();

        return redirect('emails')->with('success', 'Um Email foi excluído.');
    }
}
