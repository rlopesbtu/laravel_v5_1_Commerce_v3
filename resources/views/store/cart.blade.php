@extends('store.store')


@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <tr class="cart_menu">
                        <td class="image">Produto</td>
                        <td class="description">Descricao</td>
                        <td class="price">Valor</td>
                        <td class="price">Item</td>
                        <td class="price">Qtde</td>
                        <td class="price">Total</td>
                        <td></td>
                    </tr>
                    </thead>

                    <tbody>
                @forelse($cart->all() as $k=>$item)

                    <tr>
                        <td class="cart_product">
                            <a href="{{ route('store.product', ['id'=>$k]) }}">
                                Imagem
                            </a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="{{ route('store.product', ['id'=>$k]) }}">{{ $item['name'] }}</a> </h4>
                            <p>Codigo: {{ $k }}</p>
                        </td>
                        <td class="cart_price">
                            R$ {{ number_format($item['price'], 2, ',', '.') }}
                        </td>
                        <td class="cart_item">
                            <div class="input-group" style="width: 45px">
                                {{ $item['qtd'] }}
                            </div>
                        </td>
                        <td class="cart_quantity">
                            <div class="input-group" style="width: 45px">
                                <table>
                                    <tr>
                                        <td>
                                            <a href="{{ route('cart.update', ['id'=>$k, 'refresh'=> 1]) }}" title="" class="cart_quantity_plus">
                                               <i class="fa fa-plus-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                         <a href="{{ route('cart.update', ['id'=>$k, 'refresh'=> 0 ]) }}" title="" class="cart_quantity_plus">
                                            <i class="fa fa-minus-circle"></i>
                                         </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td class="cart_total">

                            <p class="cart_total_price"> R$ {{ $item['price'] * $item['qtd'] }}</p>
                        </td>
                        <td class="cart_delete">
                            <a href="{{route('cart.destroy',['id'=>$k])}}" class="cart_quantity_button">Delete</a>
                        </td>
                    </tr>
                 @empty
                    <tr>
                        <td class="" colspan="6">
                            <p>Nenhum item encontrado!</p>
                        </td>
                    </tr>
                    {!! Form::close() !!}
                 @endforelse
                    <tr class="cart_menu">
                        <td colspan="8">

                            <div class="pull-right">


                                <span style="margin-right: 100px">
                                    TOTAL: R$ {{ $cart->getTotal() }}
                                </span>

                                <a href="{{ route('checkout.place') }}" class="btn btn-success">Fechar a conta</a>

                            </div>
                        </td>
                    </tr>

                    </tbody>

                </table>

            </div>
        </div>
    </section>
@stop