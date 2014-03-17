<?php

class Image extends \Eloquent {
	protected $fillable = ['parent_id'];

    protected $validationRole = array(
        'id' =>'required',
        'parent_id'=>'required',
    );

    public static $imagePath = 'uploads/images';

    public function updateImage($input){

        $validator = Validator::make($input,$this->validationRole);
        if($validator->fails()) {
            return $validator;
        }else{
            $image = $this->find($input['id']);
            $image->parent_id = $input['parent_id'];

            unlink(substr($image->path,1));

            $newImage = Input::file('image');

            $image->name = md5(time().$newImage->getClientOriginalName()).'.'.$newImage->getClientOriginalExtension();
            $image->mime_type =  $newImage->getClientMimeType();
            $image->size = $newImage->getClientSize();
            $image->path = '/'.self::$imagePath.'/'.$image->name;
            $newImage->move($this::$imagePath.'/',$image->name);
            return $image->save();
        }
    }
}