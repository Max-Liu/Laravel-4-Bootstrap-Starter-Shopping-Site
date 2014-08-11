<?php
namespace ShopCore\core;

use Illuminate\Validation\Validator;
use Symfony\Component\Translation\Translator;

class MyValidator extends Validator
{
	public function __construct()
	{
		$this->setTranslator(new Translator(\Config::get('app.locale')));
		$this->setFallbackMessages(trans('validation'));
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

	public function validateForUpdate($input)
	{
		$this->setData($input);
		if ($this->fails()) {
			return false;
		} else {
			return true;
		}

	}
}

