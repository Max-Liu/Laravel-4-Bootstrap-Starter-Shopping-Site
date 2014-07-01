<?php

class ImagesController extends \BaseController
{
	public function __construct(ShopCore\Image $image){
		parent::__construct();
		$this->image = $image;
	}
		/**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->responser['viewPath'] = 'images.create';
        $this->responses($this->responser);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
	    $input = Input::all();
	    $validate = $this->image->validator->validateForInsert($input);

	    if($validate){
			$this->image->insert($input);
		    $this->responser['redirect']=route('products.edit',$input['parent_id']);
	    }else{
		    $this->responser['redirect'] = route('products.create');
		    $this->responser['error'] = true;
		    $this->responser['msg'] = $this->image->validator->errors()->first();
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
	    $input = Input::all();

	    $validated = $this->image->validator->validateForUpdate($input);
	    if($validated){
		    $this->image->update($input);
		    $this->responser['msg'] = '修改成功';
		    $this->responser['redirect']=route('products.edit',$input['parent_id']);

	    }else{
		    $this->responser['error'] = true;
		    $this->responser['msg'] = $this->image->validator->messages()->first();
		    $this->responser['redirect'] = route('products.edit', Input::input('parent_id'));
	    }


        return $this->responses();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
	    $this->image->destroy($id);
	    $this->responser['redirect'] = route('products.edit', Input::input('parent_id'));
        return $this->responses();
    }
}