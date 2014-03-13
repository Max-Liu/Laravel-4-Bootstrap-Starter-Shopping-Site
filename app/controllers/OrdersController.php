<?php

class OrdersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $orders = Order::with(['address'])->where('user_id','=',$this->userId)->orderBy('created_at','desc')->get();
        $this->layout->content = View::make('orders.list',compact('orders'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $input = Input::only(['ship_to']);

        if($address = Address::find($input['ship_to'])){
            if($address->user_id != $this->userId){
              return $this->responses('该地址不属于用户',true,array(),url('checkout'));
            }

            $order = new Order();
            $order->newOrder($input['ship_to']);
            return Redirect::route('orders.index');

        }else{
            return $this->responses('该地址不存在',true,array(),url('checkout'));
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
       $order = Order::find($id);
       $orderItems =  OrderItem::where('order_id','=',$id)->get();
       $this->layout->content = View::make('orders.info',compact('orderItems','order'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function getCheckout(){

        $cart = new Cart();
        $cartList = $cart->contents();
        $totalItems = $cart->totalItems();
        $totalPrice = $cart->totalPrice();
        $address = Address::where('is_default','=',1)->where('user_id','=',$this->userId)->first();


        $this->layout->content = View::make('orders.checkout',compact('cartList','address','totalItems','totalPrice'));
    }

}