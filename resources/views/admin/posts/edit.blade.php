@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifica post N° {{$post->id}}</h1>
    {{-- istruzioni form --}}
    <form action="{{route('admin.posts.update', $post->id)}}" method="POST">
    {{-- csrf / methods --}}
    @csrf
    @method('PUT')

        {{-- title --}}
        <div class="form-group">
          <label for="titolo">Titolo</label>
          {{-- is-invalid error --}}
          <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="titolo" placeholder="Modifica titolo" value="{{old('title') ? old('title') : $post->title}}">
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
                <option {{ old('category_id') !== null && old('category_id') == $category['id'] || isset($post['category']) && $post['category']['id'] == $category['id'] ? 'selected' : null }} value="{{$category['id']}}">{{$category['name']}}</option>
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
            <textarea name="content" class="form-control @error('content') is-invalid @enderror"" id="contenuto" rows="3" placeholder="Modifica la descrizione">{{ old('content') ? old('content') : $post->content}}</textarea>
            {{-- messaggio errore  --}}
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>    
        {{-- button --}}
        <button type="submit" class="btn btn-primary">Modifica</button>
        
    </form>
</div>
@endsection
