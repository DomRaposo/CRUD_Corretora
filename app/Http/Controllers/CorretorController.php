<?php

namespace App\Http\Controllers;

use App\Models\Corretor;
use Illuminate\Http\Request;
use App\Services\CpfValidatorService;

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
        // Remove caracteres não numéricos do CPF antes da validação
        $cpf = preg_replace('/\D/', '', $request->cpf);

        // Validação dos dados
        $request->validate([
            'nome' => 'required|min:2',
            'cpf' => [
                'required',
                'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/', // Valida formato 000.000.000-00
                function ($attribute, $value, $fail) use ($cpf) {
                    if (!CpfValidatorService::validarCPF($cpf)) {
                        $fail('O CPF informado é inválido.');
                    }
                },
                'unique:corretores,cpf'
            ],
            'creci' => 'required|min:2',
        ]);

        // Criar e salvar o corretor
        Corretor::create([
            'nome' => $request->nome,
            'cpf' => $cpf, // Salva sem pontuação no banco
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
        $request->validate([
        'nome' => 'required|min:2',
        'cpf' => 'required|size:11|unique:corretores,cpf,' . $corretor->id,
        'creci' => 'required|min:2',]);

        $corretor->update($request->all());

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
