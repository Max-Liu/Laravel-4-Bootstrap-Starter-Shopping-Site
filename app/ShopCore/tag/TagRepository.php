<?php
namespace ShopCore\tag;

class TagRepository extends \Eloquent
{
	protected $table = 'tags';

	function products()
	{
		return $this->belongsToMany('ShopCore\product\ProductRepository', 'products_tags', 'tag_id', 'product_id');
	}
}

