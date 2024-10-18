@extends('layout')

@section('content')
    <h1>Editar Usuário</h1>
  
    <!-- Exibir mensagens de erro, se houver -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuario.atualizar', $usuario->id) }}" method="POST">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ $usuario->nome }}">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $usuario->email }}">
        
        <button type="submit">Atualizar</button>
    </form>
@endsection
