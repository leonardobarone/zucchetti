@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inserisci un post</h1>
    {{-- istruzioni form --}}
    <form action="{{route('admin.posts.store')}}" method="POST">
    {{-- csrf / methods --}}
    @csrf

        {{-- title --}}
        <div class="form-group">
          <label for="titolo">Titolo</label>
          {{-- is-invalid error --}}
          <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="titolo" placeholder="Inserisci titolo" value="{{old('title')}}">
          {{-- messaggio errore  --}}
          @error('title')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        
        <div class="form-group">
            <label for="category">Categoria</label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">--- Seleziona una categoria ---</option>
                @foreach ($categories as $category)
                    <option {{ old('category_id') == $category['id'] ? 'selected' : null }} value="{{$category['id']}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- content --}}
        <div class="form-group">
            <label for="contenuto">Descrizione</label>
            {{-- is-invalid error --}}
            <textarea name="content" class="form-control @error('content') is-invalid @enderror"" id="contenuto" rows="3" placeholder="Inserisci una descrizione">{{old('content')}}</textarea>
            {{-- messaggio errore  --}}
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>    
        {{-- button --}}
        <button type="submit" class="btn btn-primary">Crea</button>
        
    </form>
</div>
@endsection
