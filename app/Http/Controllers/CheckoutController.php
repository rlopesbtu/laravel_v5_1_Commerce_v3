<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Events\CheckoutEvent;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use CodeCommerce\Cart;


class CheckoutController extends Controller {


	//Quando acessar o m�todo e pegar o carrinho de compras � esse m�todo que vai ajudar

    public function place(Order $orderModel, OrderItem $orderIem)
    {
        if(!Session::has('cart')){
            return false;
        }

        $cart = Session::get('cart');

        if($cart->getTotal() > 0) {
            //order vai receber o id da ordem
            $order = $orderModel->create(['user_id'=>Auth::user()->id,'total'=>$cart->getTotal()]);

            foreach ($cart->all() as $k=>$item ) {


                $order->items()->create(['product_id'=>$k,'price'=>$item['price'], 'qtd'=>$item['qtd']]);

            }

            $cart->clear();

       //     event(new CheckoutEvent($order, Auth::user()));

            return view ('store.checkout',compact('order'));
        }

        $categories = Category::all();



        return view('store.checkout', ['cart'=>'empty', 'categories'=>$categories]);

    }


}
