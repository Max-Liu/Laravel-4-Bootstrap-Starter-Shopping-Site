<?php
namespace ShopCore;


class Permission  {
	protected $table = 'permissions';

	function __construct(permission\PermissionRepository $data,user\UserRepository $user){
		$this->data = $data;
		$this->user = $user;
	}

	public function hasPermission($userId,$currentRouteName){
		$groupId = $this->user->find($userId)->getAttribute('group_id');
		$permissionInfo = $this->data->where('group_id','=',$groupId)->get()->toArray();
		foreach ($permissionInfo as $permission){
			$roles = unserialize($permission['roles']);
			foreach($roles as $key=>$role){
				if($permission['module'].'.'.$key == $currentRouteName){
					if ($role == 0 ){
						return false;
					}
				}
			}
		}
		return true;
	}
}