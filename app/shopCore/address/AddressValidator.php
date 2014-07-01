<?php
namespace ShopCore\address;

use ShopCore\core\MyValidator;

class AddressValidator extends MyValidator
{


	public function __construct()
	{
		parent::__construct();
		$this->setRules(array(
			'name' => 'required',
			'phone' => 'numeric',
			'address' => 'required',
			'city' => 'required',
			'postcode' => 'required',
			'user_id' => 'required',
			'province' => 'required'
		));
	}
}

