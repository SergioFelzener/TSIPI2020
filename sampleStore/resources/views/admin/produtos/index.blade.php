@extends('layouts.app')

@section('content')
<a href="{{route('admin.produtos.create')}}" class="btn btn-lg btn-success">Criar Produto</a>
    <table class="table table-striped table-dark">
        <thead>
            <tr class="table-active">
                <th>#</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Loja</th>
                <th>Administrador</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->name}}</td>
                    <td> R${{number_format($produto->price, 2, ',', '.')}}</td>
                    <td>{{$produto->store->name}}
                    <td>
                    <a href="{{route('admin.produtos.edit', ['produto' => $produto->id])}}" class="btn btn-sm btn-warning float-left mr-2">EDITAR</a>
                    <form action="{{route('admin.produtos.destroy', ['produto' => $produto->id])}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-sm btn-danger float-left">REMOVER</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
{{$produtos->links()}}

@endsection
