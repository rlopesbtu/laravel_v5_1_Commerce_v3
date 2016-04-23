<?php namespace CodeCommerce\Events;

use CodeCommerce\Events\Event;

use Illuminate\Queue\SerializesModels;

class CheckoutEvent extends Event {

	use SerializesModels;
	private $order;
	private $user;

	/**
	 * @return mixed
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @param mixed $user
	 */
	public function setUser($user)
	{
		$this->user = $user;
	}

	/**
	 * @return mixed
	 */
	public function getOrder()
	{
		return $this->order;
	}

	/**
	 * @param mixed $order
	 */
	public function setOrder($order)
	{
		$this->order = $order;
	}


	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($user,$order)
	{
		$this->user = $user;
		$this->order = $order;
	}

}
