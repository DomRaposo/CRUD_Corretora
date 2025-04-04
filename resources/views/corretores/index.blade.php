@extends('layouts.app')

@section('title', 'Cadastro de Corretor')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 flex-column">
    <div class="col-md-4">
        <h2 class="text-center">Cadastro de Corretor</h2>
        <form action="{{ route('corretores.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 pe-1">
                    <input type="text" name="cpf" class="form-control" placeholder="Digite seu CPF" minlength="11" required>
                </div>
                <div class="col-md-6 ps-1">
                    <input type="text" name="creci" class="form-control" placeholder="Digite seu Creci" minlength="2" required>
                </div>
            </div>
            <div class="mb-3">
                <input type="text" name="nome" class="form-control" placeholder="Digite seu nome" minlength="2" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>

    <!-- Exibição da Tabela -->
    <div class="col-md-6 mt-4">
        <h3 class="text-center">Corretores Cadastrados</h3>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Creci</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($corretores as $corretor)
                <tr>
                    <td>{{ $corretor->id }}</td>
                    <td>{{ $corretor->nome }}</td>
                    <td>{{ $corretor->cpf }}</td>
                    <td>{{ $corretor->creci }}</td>
                    <td>
                        <td>
                            <!-- Botão Editar -->
                            <a href="{{ route('corretores.edit', $corretor->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <!-- Botão Excluir -->
                            <form action="{{ route('corretores.destroy', $corretor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este corretor?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

     </div>
