@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
        <div class="col-12">
            <h1>{{$category->id}}) {{$category->name}}</h1>
            <p>{{$category->slug}}</p>
        </div>
        <div class="col-12">
            <h2>Lista dei post associati a questa categoria</h2>
                <ul>
                    @forelse ($category['posts'] as $post)
                    <li>{{ $post->title }}</li> 
                    @empty
                    <li>Non ci sono post associati a questa categoria!</li> 
                    @endforelse
                </ul>
        </div>
   </div>
    
</div>
@endsection