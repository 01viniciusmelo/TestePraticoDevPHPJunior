<?php
namespace App\Http\Controllers;

use App\Models\Telefones;
use App\User;
use Illuminate\Http\Request;

class TelefonesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::findOrFail(\Auth::user()->id);

        $telefones = Telefones::join('users', 'telefones.user_id', '=', 'users.id')
            ->select('telefones.*', 'users.name as nome_usuario')
            ->where([
                [
                    'telefones.status',
                    '1',
                ],
            ])
            ->orderBy('id', 'desc')
            ->get();

        return view('telefones.index', [
            'telefones' => $telefones,
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
        return view('telefones.create', [
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
            'tipo' => 'required',
            'ddd' => 'required',
            'telefone' => 'required',
        ],
            [
                'tipo.required' => 'O Tipo é obrigatório.',
                'ddd.required' => 'O DDD é obrigatório.',
                'telefone.required' => 'O Telefone é obrigatório.',
            ]
        );

        $telefone = new Telefones();

        $telefone->user_id = $request->input('user_id');
        $telefone->tipo = $request->input('tipo');
        $telefone->ddd = $request->input('ddd');
        $telefone->telefone = $request->input('telefone');

        $telefone->save();

        return redirect('telefones')->with('success', 'Novo Telefone adicionado.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $telefone = Telefones::findOrFail($id);
        $lista_usuarios = User::pluck('name', 'id');
        return view('telefones.edit', [
            'telefone' => $telefone,
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
        $telefone = Telefones::findOrFail($id);

        $this->validate(request(), [
            'tipo' => 'required',
            'ddd' => 'required',
            'telefone' => 'required',
        ],
            [
                'tipo.required' => 'O Tipo é obrigatório.',
                'ddd.required' => 'O DDD é obrigatório.',
                'telefone.required' => 'O Telefone é obrigatório.',
            ]
        );

        $telefone->user_id = $request->get('user_id');
        $telefone->tipo = $request->get('tipo');
        $telefone->ddd = $request->get('ddd');
        $telefone->telefone = $request->get('telefone');

        $telefone->save();

        return redirect('telefones')->with('success', 'Um Telefone foi atualizado.');
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
        $telefones = Telefones::where('status', '1')->get();

        if ($telefones->count() == 1) {
            return redirect('telefones')->withErrors([
                'message' => 'Não é permitido excluir o telefone selecionado.',
            ]);
        }

        $telefone = Telefones::findOrFail($id);
        $telefone->status = 0;
        $telefone->save();

        return redirect('telefones')->with('success', 'Um Telefone foi excluído.');
    }
}
