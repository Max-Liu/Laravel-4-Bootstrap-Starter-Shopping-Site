<?php
namespace ShopCore;

class User
{

	public function __construct(user\UserRepository $data)
	{
		$this->$data = $data;
	}
}