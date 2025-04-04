@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Editar Corretor</h2>

    <form action="{{ route('corretores.update', $corretor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $corretor->nome }}" required>
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" value="{{ $corretor->cpf }}" required>
        </div>

        <div class="mb-3">
            <label for="creci" class="form-label">Creci</label>
            <input type="text" name="creci" class="form-control" value="{{ $corretor->creci }}" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('corretores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
