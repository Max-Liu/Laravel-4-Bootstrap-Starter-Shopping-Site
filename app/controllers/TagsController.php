<?php

class TagsController extends \BaseController
{
	function __construct(ShopCore\tag\TagRepository $tag, ShopCore\tag\TagRelationRepository $tagRelation)
	{
		parent::__construct();
		$this->tag = $tag;
		$this->tagRelation = $tagRelation;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tags = $this->tag->all();

		$this->responser['data'] = compact('tags');
		$this->responser['viewPath'] = 'tags.list';
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
	 * @param  int $id
	 * @return Response
	 */
	public function show($id = 1)
	{
		$tag = $this->tag->find($id);
		$products = $tag->products()->get();
		$this->responser['data'] = compact('products', 'tag');
		$this->responser['viewPath'] = 'tags.info';
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
		$this->tagRelation->where('tag_id', "=", $id)->delete();
		$this->responser['msg'] = trans('message.delete_success');
		return $this->responses();
	}

}