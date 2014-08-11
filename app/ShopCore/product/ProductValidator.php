<?php
namespace ShopCore\product;

use ShopCore\core\MyValidator;

class ProductValidator extends MyValidator
{
	public function __construct()
	{
		parent::__construct();
		$this->setRules(array(
			'name' => 'required|min:5',
			'price' => 'numeric|required',
			'stock' => 'required|numeric',
			'description' => 'required',
		));
	}
}
