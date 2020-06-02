@extends('layouts.app')


@section('content')

<div class="container">

    <a href="{{route('admin.categorias.create')}}" class="btn btn-lg btn-success">Criar Categoria</a>

    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{$categoria->id}}</td>
                    <td>{{$categoria->name}}</td>
                    <td width="15%">
                        <div class="btn-group">
                            <a href="{{route('admin.categorias.edit', ['categoria' => $categoria->id])}}" class="btn btn-sm btn-warning">EDITAR</a>
                            <form action="{{route('admin.categorias.destroy', ['categoria' => $categoria->id])}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$categorias->links()}}

</div>
@endsection
