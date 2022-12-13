@extends('layouts.app')

@section('content')
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">
            x
        </button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Categorie</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
        
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>
                    {{ $post['category']['name'] ?? '' }}
                </td>
                <td>
                    <a href="{{route('admin.posts.show', $post['id'])}}">
                        <button type="button" class="btn btn-primary">
                            Visualizza
                        </button>
                    </a>
                    <br>
                    <br>
                    <a href="{{route('admin.posts.edit', ['post' => $post['id']])}}">
                        <button type="button" class="btn btn-success">
                            Modifica
                        </button>
                    </a>
                    <br>
                    <br>
                    <!-- Button trigger modal -->
                    <button data-id="{{$post->id}}" type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#exampleModal">
                        Elimina
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Conferma Eliminazione</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.posts.destroy', 'id')}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" id="delete-id" name="id">
            <div class="modal-body">
                Sei sicuo di voler cancellare il form?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Si</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection






  
