@extends('app')

@section('content')
    <h1>Edit Product: {{ $product->name }}</h1>
    @if($errors->any())
        <ul class="alert">
            @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    @endif

    {!! Form::model($product, ['route'=>['products.update', $product->id], 'method' => 'put']) !!}
    @include('products._form')
    <div class="form-group">
        {!! Form::submit('Save Product', ['class'=>'btn btn-primary']) !!}
        <a href="{{ route('products') }}" class='btn btn-default '>Back</a>
    </div>
    {!! Form::close() !!}

@endsection