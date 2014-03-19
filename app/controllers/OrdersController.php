<?php

class OrdersController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index()
    {
        $orders = Order::with(['address'])->where('user_id', '=', $this->userId)->orderBy('created_at', 'desc')->get();
        $this->responser['data'] = compact('orders');
        $this->responser['viewPath'] = 'orders.list';
        return $this->responses();
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

        if ($address = Address::find($input['ship_to'])) {
            if ($address->user_id != $this->userId) {
                $this->responser['error'] = true;
                $this->responser['msg'] = '该地址不属于此用户';
                $this->responser['redirect'] = url('checkout');
            }

            $order = new Order();
            $order->newOrder($input['ship_to']);

            $this->responser['redirect'] = route('orders.index');

        } else {

            $this->responser['error'] = true;
            $this->responser['msg'] = '该地址不存在';
            $this->responser['redirect'] = url('checkout');
        }

        return $this->responses();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $orderItems = OrderItem::where('order_id', '=', $id)->get();

        $this->responser['viewPath'] = 'orders.info';
        $this->responser['data'] = compact('orderItems','order');

        return $this->responses();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCheckout()
    {

        $cart = new Cart();
        $cartList = $cart->contents();

        if(!$cartList){
            $this->responser['msg'] = '无法下单，购物车为空';
            $this->responser['error'] = true;
            $this->responser['redirect'] = route('products.index');
            return $this->responses();
        }

        $totalItems = $cart->totalItems();
        $totalPrice = $cart->totalPrice();
        $addressList = Address::where('user_id', '=', $this->userId)->get()->toArray();

        $addressViewList = array();

        foreach ($addressList as $address){
            if($address['is_default'] == 1){
                $defaultAddressKey = $address['id'];
            }
            $addressViewList = array_add($addressViewList,$address['id'],$address['name'].' '.$address['address']);
        }
        $this->responser['viewPath']= 'orders.checkout';
        $this->responser['data'] = compact('cartList', 'addressList', 'totalItems', 'totalPrice','defaultAddressKey','addressViewList');

        return $this->responses();
    }
}