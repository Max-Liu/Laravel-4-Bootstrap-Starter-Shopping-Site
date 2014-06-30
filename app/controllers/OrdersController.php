<?php

class OrdersController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


	public function __construct(Illuminate\Session\Store $session,\ShopCore\Order $order){
		parent::__construct();

		$this->order = $order;
		$this->session = $session;
		$this->cart = new \ShopCore\Cart($this->session);
		$this->address = new ShopCore\address\AddressRepository();
		$this->orderItem = new \ShopCore\order\OrderItemRepository();
	}


    public function index()
    {
	    $dataObjects =$this->order->data->getUserOrderList($this->userId);

	    $order = $this->order;

        $this->responser['data'] = compact('dataObjects','order');
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

        if ($address = $this->address->find($input['ship_to'])) {
            if ($address->user_id != $this->userId) {
                $this->responser['error'] = true;
                $this->responser['msg'] = '该地址不属于此用户';
                $this->responser['redirect'] = url('checkout');
            }

	        $this->order->newOrder($input['ship_to'],$this->userId,$this->cart);
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
	    $orderObject = $this->order->data->find($id);
        $orderItems = $this->orderItem->where('order_id', '=', $id)->get();
	    $order = $this->order;

        $this->responser['viewPath'] = 'orders.info';
        $this->responser['data'] = compact('orderItems','orderObject','order');

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

        $cartList = $this->cart->contents();
        if(!$cartList){
            $this->responser['msg'] = '无法下单，购物车为空';
            $this->responser['error'] = true;
            $this->responser['redirect'] = route('products.index');
            return $this->responses();
        }

	    if($this->address->where('user_id','=',$this->userId)->get()->count() == 0){
		    $this->responser['msg']='请先填写收货地址';
		    $this->responser['error']=true;
		    $this->responser['redirect']=route('addresses.index');
		    return $this->responses();
	    }

        $totalItems = $this->cart->totalItems();
        $totalPrice = $this->cart->totalPrice();
        $addressList = $this->address->where('user_id', '=', $this->userId)->get()->toArray();

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