<?php
namespace ShopCore\permission;

class PermissionRepository extends \Eloquent
{
	protected $fillable = [];
	protected $table = 'permissions';

	function group()
	{
		return $this->belongsTo('group');
	}
}