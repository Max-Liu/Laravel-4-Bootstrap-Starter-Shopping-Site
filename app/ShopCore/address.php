<?php
namespace ShopCore;

class Address
{

	public function __construct(address\AddressValidator $validator, address\AddressRepository $data)
	{
		$this->validator = $validator;
		$this->data = $data;
	}

	public function setDefault($addressId, $userId)
	{
		$address = $this->data->find($addressId);
		if ($address->exists) {
			$address->where('user_id', '=', $userId)->update(array('is_default' => 0));
			$address->is_default = 1;
			$address->save();
		}
	}
}