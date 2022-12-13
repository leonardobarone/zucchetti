@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifica categoria N° {{$category->id}}</h1>
    {{-- istruzioni form --}}
    <form action="{{route('admin.categories.update', $category->id)}}" method="POST">
    {{-- csrf / methods --}}
    @csrf
    @method('PUT')

        {{-- name --}}
        <div class="form-group">
          <label for="nome">Nome</label>
          {{-- is-invalid error --}}
          <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="nome" placeholder="Modifica nome" value="{{old('name') ? old('name') : $category->name}}">
          {{-- messaggio errore  --}}
          
          @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        {{-- button --}}
        <button type="submit" class="btn btn-primary">Modifica</button>
        
    </form>
</div>
@endsection
