<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Checkout CodeCommerce</title>
    <link rel="stylesheet" href="">
    <link href="{{elixir('css/all.css')}}" rel="stylesheet">
</head>
<body>

<h3>Checkout CodeCommerce</h3>

<p>Ola {{ $user->name }}, sua compra foi realizada com sucesso!</p>
<p>Estamos processando seu pedido!.</p>

<table border="1" width="100%">
    <thead>
    <tr>
        <th width="10%">#ID</th>
        <th width="70%">Items</th>
        <th width="10%">Valor</th>
        <th width="10%">Status</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td>{{$order->id}}</td>
        <td>
            @echo 'Aqui',exit;
            @foreach($order->items as $item)

                <small>{{ $item->product->name }}</small><br>
            @endforeach
        </td>
        <td>{{$order->total}}</td>
        <td>
           xxx
        </td>
    </tr>

    </tbody>
</table>

</body>
</html>