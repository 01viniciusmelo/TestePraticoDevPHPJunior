<?php
namespace App\Http\Controllers;

use App\Models\Cidades;
use App\Models\Enderecos;
use App\Models\Estados;
use App\User;
use Illuminate\Http\Request;

class EnderecosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::findOrFail(\Auth::user()->id);

        $enderecos = Enderecos::join('users', 'enderecos.user_id', '=', 'users.id')
            ->join('cidades', 'enderecos.cidade_id', '=', 'cidades.id')
            ->join('estados', 'enderecos.estado_id', '=', 'estados.id')
            ->select('enderecos.*', 'users.name as nome_usuario', 'cidades.nome as nome_cidade', 'estados.nome as nome_estado')
            ->where([
                [
                    'enderecos.status',
                    '1',
                ],
            ])
            ->orderBy('id', 'desc')
            ->get();

        return view('enderecos.index', [
            'enderecos' => $enderecos,
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
        return view('enderecos.create', [
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
            'endereco' => 'required',
            'bairro' => 'required',
        ],
            [
                'tipo.required' => 'O Tipo é obrigatório.',
                'endereco.required' => 'O Endereço é obrigatório.',
                'bairro.required' => 'O Bairro é obrigatório.',
            ]
        );

        $endereco = new Enderecos();

        $estado = Estados::where([
            [
                'uf',
                $request->input('estado_id'),
            ],
        ])
            ->first();

        $cidade = Cidades::where([
            [
                'nome',
                $request->input('cidade'),
            ],
        ])
            ->first();

        $endereco->user_id = $request->input('user_id');
        $endereco->estado_id = $estado->id;
        $endereco->cidade_id = $cidade->id;
        $endereco->tipo = $request->input('tipo');
        $endereco->endereco = $request->input('endereco');
        $endereco->complemento = $request->input('complemento');
        $endereco->bairro = $request->input('bairro');

        $endereco->save();

        return redirect('enderecos')->with('success', 'Novo Endereço adicionado.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $endereco = Enderecos::findOrFail($id);
        $lista_usuarios = User::pluck('name', 'id');
        return view('enderecos.edit', [
            'endereco' => $endereco,
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
        $endereco = Enderecos::findOrFail($id);

        $this->validate(request(), [
            'tipo' => 'required',
            'endereco' => 'required',
            'bairro' => 'required',
        ],
            [
                'tipo.required' => 'O Tipo é obrigatório.',
                'endereco.required' => 'O Endereço é obrigatório.',
                'bairro.required' => 'O Bairro é obrigatório.',
            ]
        );

        $estado = Estados::where([
            [
                'uf',
                $request->get('estado_id'),
            ],
        ])
            ->first();

        $cidade = Cidades::where([
            [
                'nome',
                $request->get('cidade'),
            ],
        ])
            ->first();

        $endereco->user_id = $request->get('user_id');
        $endereco->estado_id = $estado->id;
        $endereco->cidade_id = $cidade->id;
        $endereco->tipo = $request->get('tipo');
        $endereco->endereco = $request->get('endereco');
        $endereco->complemento = $request->get('complemento');
        $endereco->bairro = $request->get('bairro');

        $endereco->save();

        return redirect('enderecos')->with('success', 'Um Endereço foi atualizado.');
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
        $enderecos = Enderecos::where('status', '1')->get();

        if ($enderecos->count() == 1) {
            return redirect('enderecos')->withErrors([
                'message' => 'Não é permitido excluir o endereço selecionado.',
            ]);
        }

        $endereco = Enderecos::findOrFail($id);
        $endereco->status = 0;
        $endereco->save();

        return redirect('enderecos')->with('success', 'Um Endereço foi excluído.');
    }
}
