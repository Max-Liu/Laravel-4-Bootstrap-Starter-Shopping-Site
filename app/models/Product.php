<?php

class Product extends \Eloquent {
    protected $fillable = [];


	public function category(){
		return $this->belongsTo('category');
	}

    public function tags(){
        return $this->belongsToMany('tag','products_tags','product_id','tag_id');
    }

    public function images(){
        return $this->hasMany('image','parent_id','id');
    }
}