<?php
namespace ShopCore\address;

use Illuminate\Validation\Validator;
use Symfony\Component\Translation\Translator;

class AddressValidator extends Validator
{


	public function __construct()
	{
		$this->setRules(array(
			'name' => 'required|min:5',
			'phone' => 'numeric',
			'address' => 'required',
			'city' => 'required',
			'postcode' => 'required',
			'user_id' => 'required',
			'province' => 'required'
		));
		$this->setTranslator(new Translator(\Config::get('app.locale')));
	}


	public function user()
	{
		return $this->belongsTo('User');
	}


	public function validateForInsert($input)
	{
		$this->setData($input);
		if ($this->fails()) {
			return false;
		} else {
			return true;
		}
	}

	public function validForUpdate($input)
	{
		$this->setData($input);
		if ($this->fails()) {

			return false;
		} else {
			return true;
		}
	}
}

