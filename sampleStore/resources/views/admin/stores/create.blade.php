@extends('layouts.app')

@section('content')

<h1>Criar Loja</h1>
<form action="{{route('admin.stores.store')}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="form-group">
        <label>Nome da Loja</label>
    <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" value="{{old('name')}}">

       <!--dentro da diretiva $message da a real msg de erro --><!-- abaixo msg feita na mao, porem podemos tratar as msgs de erro em storerequest-->
        @error('name')
        <div class="invalid-feedback">
          <!--  {{ $message }} -->
            <span>campo nome é obrigatório</span>
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" class="form-control @error('description')is-invalid @enderror" value="{{old('description')}}">
        @error('description')
        <div class="invalid-feedback">
                {{ $message }}
         <!--<span>campo descrição é obrigatório com um mínimo de 10 caracteres</span>-->
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label>Telefone</label>
        <input type="text" name="phone" class="form-control @error('phone')is-invalid @enderror" value="{{old('phone')}}">
        @error('phone')
        <div class="invalid-feedback">
                {{ $message }}
        <!--<span>campo telefone é obrigatório</span>-->
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Fotos do Produto</label>
        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" multiple>
        @error('logo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <button type="submit" class=" btn btn-lg btn-primary">Criar Loja</button>
    </div>
</form>

</body>
</html>

@endsection

