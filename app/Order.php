<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'total',
        'status_id'
    ];

	public function items()
    {
        return $this->hasMany('CodeCommerce\OrderItem');
    }

    public function user()
    {
        return $this->belongsTo('CodeCommerce\User');
    }

    public function status()
    {
        return $this->belongsTo('CodeCommerce\OrderStatus');
    }



}
