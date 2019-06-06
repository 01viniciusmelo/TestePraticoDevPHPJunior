<?php
namespace App\Http\Controllers;

use App\Models\Cidades;
use App\Models\Estados;
use Illuminate\Http\Request;

class CidadesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidades = Cidades::join('estados', 'estados.id', '=', 'cidades.estado_id')
            ->select('cidades.*', 'estados.nome as nome_estado')
            ->where([
                [
                    'cidades.status',
                    '1',
                ],
            ])
            ->orderBy('id', 'desc')
            ->get();

        return view('cidades.index', [
            'cidades' => $cidades,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista_estados = Estados::pluck('nome', 'id');
        return view('cidades.create', [
            'lista_estados' => $lista_estados,
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
            'nome' => 'required',
        ],
            ['nome.required' => 'O nome é obrigatório.']
        );

        $cidade = new Cidades();

        $cidade->nome = ucfirst($request->input('nome'));

        $estado = Estados::where([
            [
                'uf',
                $request->input('estado_id'),
            ],
        ])
            ->first();

        $cidade->estado_id = $estado->id;

        $cidade->save();

        return redirect('cidades')->with('success', 'Nova Cidade adicionada.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cidade = Cidades::findOrFail($id);
        $lista_estados = Estados::pluck('nome', 'id');
        return view('cidades.edit', [
            'cidade' => $cidade,
            'id' => $id,
            'lista_estados' => $lista_estados,
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
        $cidade = Cidades::findOrFail($id);

        $this->validate(request(), [
            'nome' => 'required',
        ], [
            'nome.required' => 'O nome é obrigatório.',
        ]);

        $cidade->nome = ucfirst($request->get('nome'));
        $cidade->estado_id = $request->get('estado_id');

        $cidade->save();

        return redirect('cidades')->with('success', 'Uma Cidade foi atualizada.');
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
        $cidades = Cidades::where('status', '1')->get();

        if ($cidades->count() == 1) {
            return redirect('cidades')->withErrors([
                'message' => 'Não é permitido excluir a cidade selecionada.',
            ]);
        }

        $cidade = Cidades::findOrFail($id);
        $cidade->status = 0;
        $cidade->save();

        return redirect('cidades')->with('success', 'Uma Cidade foi excluída.');
    }
}
