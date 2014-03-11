<?php

class Order extends \Eloquent
{
    protected $fillable = ['*'];

    const UNPAID = 0;
    const PAID = 1;


    public function user()
    {
        return $this->belongsTo('user')->select(array('id', 'username'));
    }

    public function orderItems(){
        return $this->hasMany('orderItem');
    }

    static function getOrderStatusStr($id){
        switch ($id){
            case self::PAID:{
                return '已支付';
            }
            case self::UNPAID:{
                return '未支付';
            }
        }
    }


    public function newOrder()
    {

        $order = new Order();
        $order->user_id = Auth::user()->getAuthIdentifier();
        $order->status = self::UNPAID;
        $order->save();


        $cart = new Cart();
        $cartContents = $cart->contents();

        $cartProductIdList = array();

        foreach ($cartContents as $cartProduct) {
            $cartProductIdList[] = $cartProduct['id'];
        }

        $productList = Product::whereIn('id', $cartProductIdList)->get();
        $orderPriceTotal = 0;

        foreach ($productList as $orderProduct) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $orderProduct->id;
            $orderItem->name = $orderProduct->name;
            $orderItem->price = $orderProduct->price;
            $orderItem->qty = $cartContents[md5($orderProduct->id)]['qty'];
            $orderItem->save();
            $orderPriceTotal = +$orderItem->price * $orderItem->qty;
        }

        $order->price_total = $orderPriceTotal;
        $order->save();
    }
}