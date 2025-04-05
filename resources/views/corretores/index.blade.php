@extends('layouts.app')

@section('title', 'Cadastro de Corretor')

{{-- Bloco de erros --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Mensagem de sucesso --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
@endif


@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100 flex-column">
        <div class="col-md-4">
            <h2 class="text-center">Cadastro de Corretor</h2>
            <form action="{{ route('corretores.store') }}" method="POST">
                @csrf
                <div class="mt-3 mb-0">
                    <div class="d-flex mb-3" style="gap: 10px;"> <!-- d-flex com gap reduzido -->
                        <input type="text" name="cpf" class="form-control" placeholder="Digite seu CPF"
                            minlength="11" required style="width: 200px;">
                        <input type="text" name="creci" class="form-control ms-3" placeholder="Digite seu Creci"
                            minlength="2" required style="width: 300px;">
                    </div>

                </div>
                <div class="mb-2">
                    <input type="text" name="nome" class="form-control" placeholder="Digite seu nome" minlength="2"
                        required style="width: 530px;>
            </div>

            <div class="d-grid">
                    <button type="submit" class="btn btn-dark mt-4" style="width: 530px;">Enviar</button>
                </div>
            </form>
        </div>

        <!-- Tabela -->
        <div class="col-md-8 mt-4">
            <h3 class="text-center mb-3">Corretores Cadastrados</h3>
            <table class="table table-bordered table-hover align-middle shadow-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Creci</th>
                        <th style="width: 120px;">Ações</th> <!-- Ações com largura menor -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($corretores as $corretor)
                        <tr>
                            <td class="text-center">{{ $corretor->id }}</td>
                            <td>{{ $corretor->nome }}</td>
                            <td>{{ $corretor->cpf }}</td>
                            <td>{{ $corretor->creci }}</td>
                            <td class="text-center">
                                <a href="{{ route('corretores.edit', $corretor->id) }}"
                                    class="btn btn-warning btn-sm me-1">✏️</a>
                                <form action="{{ route('corretores.destroy', $corretor->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este corretor?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Nenhum corretor cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
