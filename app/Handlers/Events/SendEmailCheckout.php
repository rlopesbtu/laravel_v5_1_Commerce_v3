<?php namespace CodeCommerce\Handlers\Events;

use CodeCommerce\Events\CheckoutEvent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Mail;

class SendEmailCheckout {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  CheckoutEvent  $event
	 * @return void
	 */
	public function handle(CheckoutEvent $event)
	{
		$user = $event->getUser();
		$order = $event->getOrder();

		Mail::send('emails.checkout', ['user' => $user, 'order'=>$order], function ($m) use ($user) {
			$m->from('checkout@codecommerce.com', 'CodeCommerce');

			$m->to('riaplopes@gmail.com', $user->name)->subject('Confirmação de compra CodeCommerce!');
		});



	}

}
