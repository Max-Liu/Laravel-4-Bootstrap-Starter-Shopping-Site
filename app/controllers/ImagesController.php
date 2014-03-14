<?php

class ImagesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    protected $imagePath = 'uploads/images';
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
        $this->responser['viewPath']= 'images.create';
		$this->responses($this->responser);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $input = Input::file('image');

        $image = new Image;
        $image->parent_id = 1;
        $image->name = md5(time().$input->getClientOriginalName());
        $image->mime_type =  $input->getClientMimeType();
        $image->extension = $input->getClientOriginalExtension();
        $image->size = $input->getClientSize();
        $input->move($this->imagePath.'/',$image->name.'.'.$input->getClientOriginalExtension());
        $image->save();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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

}