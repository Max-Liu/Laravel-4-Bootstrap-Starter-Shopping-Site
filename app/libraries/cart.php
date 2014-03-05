<?php

/**
 *
 */
class Cart
{

	public $product_name_safe = true;
	/**
	 *
	 * These are the regular expression rules that we use to validate the product ID and product name
	 * alpha-numeric, dashes, underscores, or periods
	 *
	 * @var string
	 */
	public $product_id_rules = '\.a-z0-9_-';

	/**
	 * These are the regular expression rules that we use to validate the product ID and product name
	 * alpha-numeric, dashes, underscores, colons or periods
	 *
	 * @var string
	 */
	public $product_name_rules = '\.\:\-_ a-z0-9';

	protected $_cartContents = array();

	function __construct()
	{
		$this->_cartContents = Session::get('cartContents');

		if (!$this->_cartContents) {
			$this->_cartContents = array('totalItems' => 0);
		}
	}

	public function insert($items = array())
	{
		if (!is_array($items) OR count($items) === 0) {
			Log::warning('items must be array and containing data');
			return false;
		}

		// You can either insert a single product using a one-dimensional array,
		// or multiple products using a multi-dimensional one. The way we
		// determine the array type is by looking for a required array key named "id"
		// at the top level. If it's not found, we will assume it's a multi-dimensional array.

		$save_cart = false;
		if (isset($items['id'])) {
			if (($rowId = $this->_insert($items))) {
				$save_cart = true;
			}
		} else {
			foreach ($items as $val) {
				if (is_array($val) && isset($val['id'])) {
					if ($this->_insert($val)) {
						$save_cart = true;
					}
				}
			}
		}

		// Save the cart data if the insert was successful
		if ($save_cart === true) {
			$this->_saveCart();
			return isset($rowId) ? $rowId : true;
		} else {
			return Log::warning('invalid items struct');
		}
	}

	protected function _insert($items = array())
	{
		if (!is_array($items) OR count($items) === 0) {
			Log::warning('items must be array and containing data');
			return false;
		}

		if (!isset($items['id'], $items['qty'], $items['price'], $items['name'])) {
			Log::warning('The cart array must contain prodoct id ,quntiy,price,name');
			return false;
		}

		$items['qty'] = (float)$items['qty'];

		if (!is_numeric($items['qty']) OR $items['qty'] <= 0) {
			Log::warning('quantity must be none zero positive number');
			return false;
		}

		if (!preg_match('/^[' . $this->product_id_rules . ']+$/i', $items['id'])) {
			Log::warning('Invalid product ID.  The product ID can only contain alpha-numeric characters, dashes, and underscores');
			return false;
		}

		if ($this->product_name_safe && !preg_match('/^[' . $this->product_name_rules . ']+$/i', $items['name'])) {
			Log::warning('An invalid name was submitted as the product name: ' . $items['name'] . ' The name can only contain alpha-numeric characters, dashes, underscores, colons, and spaces');
			return false;
		}

		// Prep the price. Remove leading zeros and anything that isn't a number or decimal point.
		$items['price'] = (float)$items['price'];

		// Is the price a valid number?
		if (!is_numeric($items['price'])) {
			Log::warning('An invalid price was submitted for product ID: ' . $items['id']);
			return false;
		}

		// --------------------------------------------------------------------

		// We now need to create a unique identifier for the item being inserted into the cart.
		// Every time something is added to the cart it is stored in the master cart array.
		// Each row in the cart array, however, must have a unique index that identifies not only
		// a particular product, but makes it possible to store identical products with different options.
		// For example, what if someone buys two identical t-shirts (same product ID), but in
		// different sizes?  The product ID (and other attributes, like the name) will be identical for
		// both sizes because it's the same shirt. The only difference will be the size.
		// Internally, we need to treat identical submissions, but with different options, as a unique product.
		// Our solution is to convert the options array to a string and MD5 it along with the product ID.
		// This becomes the unique "row ID"
		if (isset($items['options']) && count($items['options']) > 0) {
			$rowId = md5($items['id'] . serialize($items['options']));
		} else {
			// No options were submitted so we simply MD5 the product ID.
			// Technically, we don't need to MD5 the ID in this case, but it makes
			// sense to standardize the format of array indexes for both conditions
			$rowId = md5($items['id']);
		}


		// Now that we have our unique "row ID", we'll add our cart items to the master array
		// grab quantity if it's already there and add it on
		$old_quantity = isset($this->_cartContents[$rowId]['qty']) ? (int)$this->_cartContents[$rowId]['qty'] : 0;

		// Re-create the entry, just to make sure our index contains only the data from this submission
		$items['rowid'] = $rowId;
		$items['qty'] += $old_quantity;
		$this->_cartContents[$rowId] = $items;

		return $rowId;
	}


	protected function _saveCart()
	{
		$this->_cartContents['totalItems'] = $this->_cartContents['cartTotal'] = 0;

		foreach ($this->_cartContents as $key => $val) {
			// We make sure the array contains the proper indexes
			if (!is_array($val) OR !isset($val['price'], $val['qty'])) {
				continue;
			}

			$this->_cartContents['cartTotal'] += ($val['price'] * $val['qty']);
			$this->_cartContents['totalItems'] += $val['qty'];
			$this->_cartContents[$key]['subtotal'] = ($this->_cartContents[$key]['price'] * $this->_cartContents[$key]['qty']);

			// Is our cart empty? If so we delete it from the session
		}
		if (count($this->_cartContents) <= 2) {
			Session::forget('cartContents');
			Log::warning('cart is empty,nothing to save');
			return false;
		}

		Session::put('cartContents', $this->_cartContents);
		return true;
	}

	public function total()
	{
		return $this->_cartContents['cartTotal'];
	}


	public function remove($rowId)
	{
		unset($this->_cartContents[$rowId]);
		$this->_saveCart();
		return true;
	}

	public function totalItems()
	{
		return $this->_cartContents['totalItems'];
	}


	public function contents($newest_first = FALSE)
	{
		// do we want the newest first?
		$cart = ($newest_first) ? array_reverse($this->_cartContents) : $this->_cartContents;

		// Remove these so they don't create a problem when showing the cart table
//		unset($cart['totalItems']);
//		unset($cart['cartTotal']);

		return $cart;
	}


	public function has_options($rowId = '')
	{
		return (isset($this->_cartContents[$rowId]['options']) && count($this->_cartContents[$rowId]['options']) !== 0);
	}

	public function product_options($rowId = '')
	{
		return isset($this->_cartContents[$rowId]['options']) ? $this->_cartContents[$rowId]['options'] : array();
	}

	public function destroy()
	{
		$this->_cartContents = array('cartTotal' => 0, 'totalItems' => 0);
		Session::forget('cartContents');
	}
}
