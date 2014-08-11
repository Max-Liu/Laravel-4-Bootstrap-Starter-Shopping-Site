<?php
namespace ShopCore\address;

class AddressRepository extends \Eloquent
{

	protected $fillable = ['name', 'phone', 'address', 'city', 'postcode', 'user_id', 'province'];
	protected $table = 'addresses';

	public function getAddressList($userId)
	{
		return $this->where('user_id', '=', $userId)->orderBy('id', 'desc')->paginate(5);
	}

	public function createNewAddress($input)
	{
		$this->create($input);
	}

	public function updateAddress($input, $addressId)
	{
		$address = $this->find($addressId);
		$address->fill($input);
		$address->save();
	}

	public function user()
	{
		return $this->belongsTo('User');
	}
}

