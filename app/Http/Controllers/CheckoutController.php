<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use Session;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use CodeCommerce\Category;
use Auth;
use CodeCommerce\Events\CheckoutEvent;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

class CheckoutController extends Controller
{
    public function place(Order $orderModel, OrderItem $orderItem, Category $category, CheckoutService $checkoutService)
    {
        if (!Session::has('cart')){
            return redirect()->route('store');
        }

        $categories = $category->all();

        $cart = Session::get('cart');

        if ($cart->getTotal() > 0){


            //pagseguro
            $checkout = $checkoutService->createCheckoutBuilder();



            $order = $orderModel->create(['user_id'=>Auth::user()->id, 'total'=>$cart->getTotal()]);

            foreach ($cart->all() as $k=>$item) {

                //pagseguro
                $checkout->addItem(new Item($k, $item['name'], number_format($item['price'], 2, '.', ''), $item['qtd']));

                $item = ['product_id'=>$k, 'price'=>$item['price'], 'qtd'=>$item['qtd']];
                $order->items()->create($item);

            }

            $cart->clear();

            event(new CheckoutEvent(Auth::user(), $order));

            //return view('store.checkout', compact('order', 'categories'));

            //pagseguro            
            $response = $checkoutService->checkout($checkout->getCheckout());
            return redirect($response->getRedirectionUrl());

        }


        return view('store.checkout', ['cart'=>'empty', 'categories'=>$categories]);
    }

    public function teste(CheckoutService $checkoutService)
    {
        $checkout = $checkoutService->createCheckoutBuilder()
            ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
            ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
            ->getCheckout();

        $response = $checkoutService->checkout($checkout);

        return redirect($response->getRedirectionUrl());
    }
}
