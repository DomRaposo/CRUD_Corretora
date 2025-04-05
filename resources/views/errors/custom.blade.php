@extends('layouts.app')

@section('title', 'Erro')

@section('content')
<div class="container text-center mt-5">
    <h2 class="text-danger">Erro!</h2>
    <p>{{ $message }}</p>
    <a href="{{ url()->previous() }}" class="btn btn-dark mt-3">Voltar</a>
</div>
@endsection
