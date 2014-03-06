<?php

class CartsController extends \BaseController
{

    protected $cart;

    function __construct()
    {

        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->cart = new Cart();
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

        $this->layout->content = View::make('carts.list', compact('carts', 'totalItems', 'totalPrice'));

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
        $product['price'] = Product::find($product['id'])->price;
        $product['name'] = Product::find($product['id'])->name;

        $this->cart->insert($product);

        return Redirect::route('carts.index');
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
        return Redirect::route('carts.index');
    }

}