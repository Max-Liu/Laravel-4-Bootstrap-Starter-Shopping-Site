<?php

class ProductsController extends \BaseController {


	public function __construct(ShopCore\Product $product){
		parent::__construct();
		$this->product = $product;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $products =$this->product->data->getProductList();
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
		$input = Input::only(array('name', 'stock', 'description', 'category_id', 'price','status'));
		$input['user_id']= $this->userId;

		$validate = $this->product->validator->validateForInsert($input);

		if($validate){
			$this->responser['data']=$this->product->data->createNewProduct($input);
			$this->responser['redirect'] = route('addresses.index');
			$this->responser['msg']= trans('message.insert_success');
		}else{
			$this->responser['redirect'] = route('addresses.create');
			$this->responser['error'] = true;
			$this->responser['msg'] = $this->product->validator->messages()->first();
			$this->responser['data'] = $input;
		}
		return $this->responses();
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
		$product = $this->product->data->with(['images'])->find($id);
		$tags = $product->tags()->get();
        $this->responser['data'] = compact('product','tags');
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
		$product = $this->product->data->with(array('images'))->find($id);
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
		$input = Input::only('name','price','status','stock','description','category_id');
		$isValid = $this->product->validator->validateForUpdate($input);

		if ($isValid){
			$this->product->data->find($id)->fill($input)->save();
			$this->responser['msg']= '修改成功';
		}else{
			$this->responser['error']= true;
			$this->responser['msg'] = $this->product->validator->messages()->first();
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