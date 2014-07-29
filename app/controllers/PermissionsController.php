<?php

class PermissionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct(ShopCore\Permission $permission,ShopCore\user\UserRepository $user){

		parent::__construct();
		$this->permission = $permission;
	}

	public function index()
	{
		$groupInput = Input::get('group');
		$group = new ShopCore\permission\GroupRepository();
		$groupList = $group->all();


		$permissionList = $this->permission->data->with(['group'])->where('group_id','=',$groupInput)->get();
		$this->responser['data'] = compact('permissionList','groupList');
		$this->responser['viewPath'] = 'permissions.index';
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
		$permission = $this->permission->with(['group'])->find($id);
		$this->responser['data'] = compact('permission');
		$this->responser['viewPath'] = 'permissions.edit';
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
		$input = Input::only(array(
			'module',
			'group',
		));
		$roles = Input::only(array(
			'update',
			'show',
			'index',
			'create',
			'store',
			'edit',
			'destroy'
		));

		foreach ($roles as &$role){
			if(is_null($role)){
				$role =0;
			}
		}
		$permission = $this->permission->data->find($id);
		$permission->module = $input['module'];
		$permission->group_id = $input['group'];
		$permission->roles = serialize($roles);
		$permission->save();


		$this->responser['redirect'] = route('permissions.index').'?group='.$input['group'];
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