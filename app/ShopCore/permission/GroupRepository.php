<?php
namespace ShopCore\permission;

class GroupRepository extends \Eloquent
{
	protected $fillable = [];
	protected $table = 'groups';

	function getGroupName($groupId)
	{
		return $this->find($groupId)->name;
	}
}