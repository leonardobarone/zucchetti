@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1>Inserisci una categoria post</h1>
    
    {{-- istruzioni form --}}
    <form action="{{route('admin.categories.store')}}" method="POST">
    
    {{-- csrf / methods --}}
    @csrf

        {{-- name --}}
        <div class="form-group">
          <label for="titolo">Name</label>
          {{-- is-invalid error --}}
          <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="titolo" placeholder="Inserisci nome categoria" value="{{old('name')}}">
          {{-- messaggio errore  --}}
          @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
    
        {{-- button --}}
        <button type="submit" class="btn btn-primary">Crea</button>
        
    </form>
</div>
@endsection
