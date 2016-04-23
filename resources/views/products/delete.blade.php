@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1>ATENCAO!!!</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>Tem certeza que quer apagar <strong>{{ $product->name }}</strong>?</p>
                <blockquote class="text-danger"><strong>Esta operacao nao pode ser desfeita!</strong></blockquote>
                {!! Form::open(['route' => ['delete_product', $product->id], 'method' => 'delete']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                <a href="{{ route('products') }}" class="btn btn-primary">Cancel</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection