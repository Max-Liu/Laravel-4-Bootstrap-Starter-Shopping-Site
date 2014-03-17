<?php

class ProductsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = array();
        $products = Product::with('category')->paginate(15);
        $this->responser['data'] = compact('products');
        $this->responser['viewPath'] = 'products.list';

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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        $product = Product::with(['images'])->find($id);
        $this->responser['data'] = compact('product');
        $this->responser['viewPath'] = 'products.info';
        return $this->responses();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $product = Product::with(['images'])->find($id);
        $this->responser['data'] = compact('product');
        $this->responser['viewPath'] = 'products.edit';
        return $this->responses();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $input = Input::only('name','price','status','stock','description');

        $product = Product::find($id);
        $result = $product->updateProduct($input);

        if (is_object($result)) {
            $this->responser['error'] = true;
            $this->responser['msg'] = $result->messages()->first();
        } else {
            $this->responser['msg']= '修改成功';
        }
        $this->responser['redirect'] = route('products.edit', $id);
        return $this->responses();
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

}