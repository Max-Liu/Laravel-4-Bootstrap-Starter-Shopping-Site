<?php

class Permission extends \Eloquent {
	protected $fillable = [];


	function group(){
		return $this->belongsTo('group');
	}
}