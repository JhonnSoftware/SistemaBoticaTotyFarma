@extends('layouts.plantilla')

@section('title', 'Editar Usuario')

@section('content')
    <h2>Editar Usuario</h2>

    <form action="{{ route('users.actualizar', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" value="{{ $user->email }}" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control" value="{{ $user->password }}" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </form>
@endsection
