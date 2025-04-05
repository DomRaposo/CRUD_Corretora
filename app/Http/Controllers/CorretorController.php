<?php

namespace App\Http\Controllers;

use App\Models\Corretor;
use Illuminate\Http\Request;
use App\Rules\CpfValido;
use Illuminate\Validation\Rule;



class CorretorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $corretores = Corretor::all();
        return view('corretores.index', compact('corretores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('corretores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:2',
            'cpf' => ['required', 'unique:corretores,cpf', new CpfValido],
            'creci' => 'required|min:2',
    ],[
            'cpf.regex' => 'O CPF deve estar no formato 000.000.000-00, com pontuação.',
        ]);

        Corretor::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'creci' => $request->creci,
        ]);

        return redirect()->route('corretores.index')->with('success', 'Corretor cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Corretor $corretor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Corretor $corretor)
    {
        return view('corretores.edit', compact('corretor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Corretor $corretor)
{
    //dd($request->all());

    $request->validate([
        'nome' => 'required|min:2',
        'cpf' => 'required',
        'creci' => 'required|min:2',
    ]);

    $corretor->update($request->only(['cpf', 'nome', 'creci']));

    return redirect()->route('corretores.index')->with('success', 'Corretor atualizado com sucesso!');

}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Corretor $corretor)
    {
        $corretor->delete();
        return redirect()->route('corretores.index')->with('success', 'Corretor excluído com sucesso!');
    }
}
