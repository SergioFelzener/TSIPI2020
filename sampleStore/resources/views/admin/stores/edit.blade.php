@extends('layouts.app')

@section('content')

<h1>Criar Loja</h1>
<!--chamando action pelo apelido da rota <name> -->
<form action="{{route('admin.stores.update', ['store' =>$store->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="form-group">
        <label>Nome da Loja</label>
        <input type="text" name="name" class="form-control" value="{{$store->name}}">
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" class="form-control" value="{{$store->description}}">
    </div>
    <div class="form-group">
        <label>Telefone</label>
        <input type="text" id="phone" name="phone" class="form-control" value="{{$store->phone}}">
    </div>
    <div class="form-group">
        <p>
            <img src="{{asset('storage/'. $store->logo)}}" alt="">
        </p>
        <label for="">Fotos do Produto</label>
        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" multiple>
        @error('logo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <button type="submit" class=" btn btn-lg btn-primary">Atualizar Loja</button>
    </div>
</form>

</body>
</html>

@endsection

@section('scripts')


<script>
    // Input mask no campo telefone com formatacao para celular brasil
    let imphone = new Inputmask('(99) 99999-9999');
    imphone.mask(document.getElementById('phone'));

</script>

@endsection
