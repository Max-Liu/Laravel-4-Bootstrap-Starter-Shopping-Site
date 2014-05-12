<?php
namespace ShopCore\product;
use Illuminate\Validation\Validator;
use Symfony\Component\Translation\Translator;

class ProductValidator  extends Validator{


	public function __construct(){
		$this->setRules( array(
			'name' =>'required|min:5',
			'price'=>'numeric|required',
			'stock'=>'required|numeric',
			'description'=>'required',
		));
		$this->setTranslator(new Translator(\Config::get('app.locale')));
	}

	public function validForUpdate($input){
		$this->setData($input);
		if ($this->fails()){
			return false;
		}else{
			return true;
		}
	}
}
