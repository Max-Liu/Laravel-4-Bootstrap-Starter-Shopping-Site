<?php
namespace ShopCore;

class Product
{

	public function __construct(product\ProductValidator $validator, product\ProductRepository $data)
	{
		$this->validator = $validator;
		$this->data = $data;
	}


}