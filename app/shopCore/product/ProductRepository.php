<?php
namespace ShopCore\product;

class ProductRepository  extends \Eloquent implements ProductInterface {

	protected $fillable = ['name','price','stock','description'];
	protected $table = 'products';

	function getProductList(){
		return $this->with('category')->paginate(15);
	}

	public function category(){
		return $this->belongsTo('category');
	}

	public function tags(){
		return $this->belongsToMany('tag','products_tags','product_id','tag_id');
	}

	public function images(){
		return $this->hasMany('ShopCore\image\ImageRepository','parent_id','id')->orderBy('id','desc');
	}

	public function getStatusString($id){
		switch($id) {
			case 0:{
				return '草稿';
			}
			case 1:{
				return '线上';
			}
		}
	}
}

