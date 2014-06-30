<?php
namespace ShopCore\order;

class OrderRepository extends \Eloquent
{

	protected $fillable = ['status','price_total','ship_to'];
	protected $table = 'orders';




	public function address(){
		return $this->hasOne('address','id','ship_to');
	}


	public function user()
	{
		return $this->belongsTo('user')->select(array('id', 'username'));
	}


	public function orderItems(){
		return $this->hasMany('orderItem');
	}

	public function getUserOrderList($userId){
		return $this->with(['address'])->where('user_id', '=', $userId)->orderBy('created_at', 'desc')->get();
	}
}