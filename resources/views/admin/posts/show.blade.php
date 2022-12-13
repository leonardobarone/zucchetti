@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$post->id}}) {{$post->title}}</h1>
    <p>{{$post->content}}</p>
    @if (isset($post['category']['name']))
        <span>Questo post è presente nella categoria: {{$post['category']['name']}}</span>    
    @endif
</div>
@endsection