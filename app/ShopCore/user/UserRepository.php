<?php
namespace ShopCore\user;

class UserRepository extends \Eloquent
{
	protected $fillable = [];
	protected $table = 'users';

	public function getUserGroupId($userId)
	{
		return $this->find($userId)->group_id;
	}
}