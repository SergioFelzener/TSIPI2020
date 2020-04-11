@extends('layouts.app')

@section('content')


<!--chamando action pelo apelido da rota <name> -->
    <h1>Atualizar produto</h1>
    <form action="{{route('admin.produtos.update',['produto' => $produtos->id])}}" method="POST" enctype="multipart/form-data">

        <!-- simplificando escrita abaixo-->
        <!--<input type="hidden" name="_token" value="{{csrf_token()}}">-->
        <!--<input type="hidden" name="_method" value="PUT">-->
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome do Produto</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$produtos->name}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Descrição do produto</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$produtos->description}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$produtos->body}}></textarea>
        </div>



        <div class="form-group">
            <label>Preço</label>
            <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{$produtos->price}}">
            @error('price')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>



        <div class="form-group">
            <label>Categorias</label>
            <select name="categorias[]" id="" class="form-control" multiple>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}"
                        @if($produtos->categorias->contains($categoria)) selected @endif>{{ $categoria->name }}
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="">Fotos do Produto</label>
            <input type="file" name="fotos[]" class="form-control @error('fotos.*') is-invalid @enderror" multiple>
            @error('fotos')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$produtos->slug}}">
        </div>
        <div>
            <button type="submit" class=" btn btn-lg btn-primary">Atualilzar Produto</button>
        </div>
    </form>

    <hr>

    <div class="row">
        @foreach($produtos->fotos as $foto)
            <div class="col-4 text-center">
                <img src="{{asset('storage/' . $foto->image)}}" alt="" class="img-fluid">
                <form action="{{route('admin.photo.remove')}}" method="POST">

                    @csrf

                    <input type="hidden" name="photoName" value="{{$foto->image}}">
                    <button type="submit" class="btn btn-sm btn-danger mt-3">remover</button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>

@endsection

@section('scripts')

<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>

<script>

    $('#price').maskMoney({prefix: '', allowNegative: false, thousands: '.', decimal: ','});

</script>

@endsection

