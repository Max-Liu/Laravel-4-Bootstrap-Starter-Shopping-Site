<?php
namespace ShopCore\image;

use ShopCore\core\MyValidator;

class ImageValidator extends MyValidator
{
	public function __construct()
	{
		parent::__construct();
		$this->setRules(
			array(
				'parent_id' => 'required',
				'image' => 'required|mimes:jpeg,png'
			)
		);
	}
}

