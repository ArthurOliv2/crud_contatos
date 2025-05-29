<?php

namespace App\Http\Controllers;

use App\Models\Contato;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contato::query();

        if ($request->filled('busca')) {
            $query->where('nome', 'ILIKE', '%' . $request->busca . '%');
        }

        $contatos = $query->orderBy('id', 'asc')->get();

        return view('contatos.index', compact('contatos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contatos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'idade' => 'required|integer|min:1',
            'telefone' => 'required|string|max:20',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'cep' => 'required|string|max:15',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:50',
        ]);

        Contato::create($request->all());

        return redirect()->route('index')->with('success', 'Contato cadastrado com sucesso !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contato $contato)
    {
        return view('contatos.edit', compact('contato'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contato $contato)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'idade' => 'required|integer|min:1',
            'telefone' => 'required|string|max:20',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'cep' => 'required|string|max:15',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|max:50',
        ]);
        
        $contato->update($request->all());

        return redirect()->route('index')->with('success', 'Contato atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contato $contato)
    {
        $contato->delete();

        return redirect()->route('index')->with('success', 'Contato excluido com sucesso');
    }
}
