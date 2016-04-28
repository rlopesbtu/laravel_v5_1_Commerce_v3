@extends('app')

@section('content')
    <h1>Show Order: {{ $order->id }}</h1>
    <br>

    <p><b>User:</b> {{$order->user->name}}</p>
    <p><b>Valor:</b> {{$order->total}}</p>
    <p><b>Status:</b> {{$order->status_id ? "Pendente" : "Aprovado"}}</p>
    <p><b>Itens:</b><p>
        <table class="table">
            <tr>
                <td>#ID</td>
                <td>Nome</td>
                <td>Qtd</td>
                <td>Valor unitário</td>
            </tr>
            @foreach($order->items as $item)
            <tr>
                <td><a href="{{ route('orders.show',['id'=>$item->product->id]) }}">{{ $item->product->id }}</a></td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->qtd }}</td>
                <td>{{ $item->price }}</td>
            </tr>
            @endforeach
        </table>

    <br>
    <table>
      <tr>
        <td>
            <a href="{{ route('orders.edit', ['id'=>$order->id]) }}" class='btn btn-primary '>Edit</a>
        </td>
        <td>
            <br>
            <a href="{{ route('orders.index') }}" class='btn btn-default '>Back</a>
        </td>
      </tr>
    </table>

@endsection