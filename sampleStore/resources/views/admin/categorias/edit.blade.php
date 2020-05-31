@extends('layouts.app')


@section('content')
    <h1 class="mt-2">Atualizar Categoria</h1>
    <form action="{{route('admin.categorias.update', ['categoria' => $categoria->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group mt-5">
            <label>Nome</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$categoria->name}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control" value="{{$categoria->descricao}}">
        </div>
        <div class="form-group">
            <p>
                <img class="img-store" src="{{asset('storage/'. $categoria->img)}}" alt="">
            </p>
            <label for="img">Foto da Categoria</label>

        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$categoria->slug}}" readonly>
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Atualizar Categoria</button>
        </div>
    </form>
@endsection

