<?php

class Tag extends \Eloquent {
    protected $fillable = [];

    public function products(){
        return $this->belongsToMany('product','products_tags','tag_id','product_id');
    }
}