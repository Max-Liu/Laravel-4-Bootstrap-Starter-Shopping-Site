<?php
namespace ShopCore;

use ShopCore\address\AddressRepository;
use ShopCore\order\OrderItemRepository;
use ShopCore\order\OrderRepository;
use ShopCore\product\ProductRepository;

class Order
{


	const UNPAID = 0;
	const PAID = 1;


	public function __construct(order\OrderValidator $validator,order\OrderRepository $data){
		$this->validator = $validator;
		$this->data = $data;
		$this->product = new ProductRepository();
		$this->address = new AddressRepository();

	}

	public function newOrder($shipTo, $userId,$cart)
	{
		$this->data->user_id = $userId;
		$this->data->status = self::UNPAID;
		$this->data->ship_to = $shipTo;
		$this->data->save();


		$cartContents = $cart->contents();

		$cartProductIdList = array();

		foreach ($cartContents as $cartProduct) {
			$cartProductIdList[] = $cartProduct['id'];
		}

		$productList = $this->product->whereIn('id', $cartProductIdList)->get();
		$orderPriceTotal = 0;
		foreach ($productList as $orderProduct) {
			$orderItem = new OrderItemRepository();
			$orderItem->order_id = $this->data->id;
			$orderItem->product_id = $orderProduct->id;
			$orderItem->name = $orderProduct->name;
			$orderItem->price = $orderProduct->price;
			$orderItem->qty = $cartContents[md5($orderProduct->id)]['qty'];
			$orderItem->save();
			$orderPriceTotal += $orderItem->price * $orderItem->qty;
		}

		$this->data->price_total = $orderPriceTotal;
		$this->data->save();
	}


	public  function getOrderStatusStr($id){
		switch ($id){
			case self::PAID:{
				return '已支付';
			}
			case self::UNPAID:{
				return '未支付';
			}
		}
	}


}