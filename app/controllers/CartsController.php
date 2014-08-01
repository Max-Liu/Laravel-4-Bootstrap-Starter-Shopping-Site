<?php

class CartsController extends \BaseController
{

    protected $cart;

    function __construct(Illuminate\Session\Store $session)
    {
	    parent::__construct();
	    $this->cart = new \ShopCore\Cart($session);
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $carts = $this->cart->contents();
        $totalItems = $this->cart->totalItems();
        $totalPrice = $this->cart->totalPrice();

        $this->responser['viewPath'] =  'carts.list';
        $this->responser['data'] = compact('carts','totalItems','totalPrice');
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
        $product = array_except(Input::all(), array('_token'));
        $product['price'] = $this->cart->product->data->find($product['id'])->price;
        $product['name'] = $this->cart->product->data->find($product['id'])->name;

        $this->cart->insert($product);
	    $this->responser['msg']= trans('message.insert_success');
	    $this->responser['redirect']= route('carts.index');
		return  $this->responses();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
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
        if ($id == 'destroy') {
            $this->cart->destroy();
        } else {
            $this->cart->remove($id);
        }
	    $this->responser['redirect'] =route('carts.index');
	    $this->responser['msg']= trans('message.delete_success');
	   return $this->responses();
    }

}