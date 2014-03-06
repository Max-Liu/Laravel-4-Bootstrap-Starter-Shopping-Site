<?php

class Product extends \Eloquent {
    protected $fillable = [];


	public function category(){
		return $this->belongsTo('category');
	}



}