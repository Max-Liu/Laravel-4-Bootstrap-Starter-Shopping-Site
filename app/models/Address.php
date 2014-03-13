<?php

class Address extends \Eloquent {
    protected $fillable = ['name','phone','address','city','postcode','is_default'];



    protected $validationRole = array(
        'name' =>'required|min:5',
        'phone'=>'numeric',
        'address'=>'required',
        'city'=>'required',
        'postcode'=>'required',
    );

    public function user(){
        return $this->belongsTo('User');
    }


    public function createNewAddress($input){

        $validator = Validator::make($input,$this->validationRole);


        if ($validator->fails()){
            return $validator;
        }else{
            $this->create($input);
        }
    }

    public function updateAddress($input){
        $validator = Validator::make($input,$this->validationRole);
        if ($validator->fails()){
            return $validator;
        }else{
            $this->fill($input);
            $this->save();
            return true;
        }
    }
}