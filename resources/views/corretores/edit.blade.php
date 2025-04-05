@extends('layouts.app')

@section('title', 'Editar Corretor')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Editar Corretor</h2>

    <form action="{{ route('corretores.update', $corretor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $corretor->nome) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" id="cpf" value="{{ old('cpf', $corretor->cpf) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="creci" class="form-label">Creci</label>
            <input type="text" name="creci" id="creci" value="{{ old('creci', $corretor->creci) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('corretores.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
