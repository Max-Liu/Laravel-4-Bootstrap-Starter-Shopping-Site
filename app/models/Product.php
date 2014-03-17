<?php

class Product extends \Eloquent {
    protected $fillable = ['name','price','stock','description'];


    protected $validationRole = array(
        'name' =>'required|min:5',
        'price'=>'numeric|required',
        'stock'=>'required|numeric',
        'description'=>'required',
    );


	public function category(){
		return $this->belongsTo('category');
	}

    public function tags(){
        return $this->belongsToMany('tag','products_tags','product_id','tag_id');
    }

    public function images(){
        return $this->hasMany('image','parent_id','id');
    }

    public function updateProduct($input){
        $validator = Validator::make($input,$this->validationRole);
        if ($validator->fails()){
            return $validator;
        }else{
            $this->fill($input);
            $this->save();
            return true;
        }
    }

    public static function getStatusString($id){
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