<?php

class OrderItem extends \Eloquent {
    protected $fillable = [];

    public function order(){
        $this->belongsTo('order');
    }
}