<?php
namespace ShopCore\order;

class OrderItemRepository extends \Eloquent {
	protected $fillable = [];
	protected $table = 'order_items';

	public function order(){
		$this->belongsTo('order');
	}
}