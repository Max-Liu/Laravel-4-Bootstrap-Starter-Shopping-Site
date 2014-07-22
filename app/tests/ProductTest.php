<?php

class ProductTest extends TestCase {


	private $fakeData = array(
		'productName',
		888,
		123,
		'description',
		1,
		400
	);
	private $product;
	function __construct(){

	}


	public function testProductCreate(){
		$this->product= new ShopCore\product\ProductRepository();
		$this->generateFakeData($this->product,$this->fakeData);
		$response = $this->action('post','products.store',array(),$this->product->toArray(),array(),array('HTTP_Accept'=>'application/json'));
		$productId = $response->getData()->data;
		$createdProduct = $this->product->find($productId);
		$this->validInsert($createdProduct,$this->fakeData);
		$this->product->find($createdProduct->id)->delete();
		$this->assertResponseOk();
	}

	public function testProductList(){
		$this->call('GET', 'products');
		$this->assertResponseOk();
	}


	public function testProductUpdate(){
		$this->product= new ShopCore\product\ProductRepository();
		$this->generateFakeData($this->product,$this->fakeData);
		$response = $this->action('post','products.store',array(),$this->product->toArray(),array(),array('HTTP_Accept'=>'application/json'));
		$productId = $response->getData()->data;
		$createdProduct = $this->product->find($productId);
		$this->validUpdate($createdProduct,$this->fakeData);
		$this->product->find($createdProduct->id)->delete();
		$this->assertResponseOk();
	}
}