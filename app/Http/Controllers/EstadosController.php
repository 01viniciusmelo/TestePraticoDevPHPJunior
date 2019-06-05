<?php
namespace App\Http\Controllers;

use App\Models\Estados;
use Illuminate\Http\Request;

class EstadosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estados::where([
            [
                'status',
                '1',
            ],
        ])
            ->orderBy('id', 'desc')
            ->get();

        return view('estados.index', [
            'estados' => $estados,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('estados.create');
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
            'uf' => 'required',
        ],
            [
                'nome.required' => 'O nome é obrigatório.',
                'uf.required' => 'A UF é obrigatória.',
            ]
        );

        $estado = new Estados();

        $estado->nome = ucfirst($request->input('nome'));
        $estado->uf = strtoupper($request->input('uf'));

        $estado->save();

        return redirect('estados')->with('success', 'Novo Estado adicionado.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estado = Estados::findOrFail($id);
        return view('estados.edit', [
            'estado' => $estado,
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
        $estado = Estados::findOrFail($id);

        $this->validate(request(), [
            'nome' => 'required',
            'uf' => 'required',
        ],
            [
                'nome.required' => 'O nome é obrigatório.',
                'uf.required' => 'A UF é obrigatória.',
            ]
        );

        $estado->nome = ucfirst($request->get('nome'));
        $estado->uf = strtoupper($request->input('uf'));

        $estado->save();

        return redirect('estados')->with('success', 'Um Estado foi atualizado.');
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
        $estados = Estados::where('status', '1')->get();

        if ($estados->count() == 1) {
            return redirect('estados')->withErrors([
                'message' => 'Não é permitido excluir o estado selecionado.',
            ]);
        }

        $estado = Estados::findOrFail($id);
        $estado->status = 0;
        $estado->save();

        return redirect('estados')->with('success', 'Um Estado foi excluído.');
    }
}
