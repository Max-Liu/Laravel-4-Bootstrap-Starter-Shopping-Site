<?php

class Image extends \Eloquent
{
    protected $fillable = ['parent_id'];

    public static $imagePath = 'uploads/images';

    public function updateImage()
    {
        $input = Input::all();
        $validationRole = array(
            'id' => 'required|exists:'.$this->getTable(),
            'parent_id' => 'required|exists:'.$this->getTable(),
            'image'=>'required|mimes:jpeg,png'
        );

        $validator = Validator::make($input, $validationRole);

        if ($validator->fails()) {
            return $validator;
        } else {
            $image = $this->find($input['id']);
            $image->parent_id = $input['parent_id'];

            unlink(substr($image->path, 1));

            $newImage = Input::file('image');

            $image->name = md5(time() . $newImage->getClientOriginalName()) . '.' . $newImage->getClientOriginalExtension();
            $image->mime_type = $newImage->getClientMimeType();
            $image->size = $newImage->getClientSize();
            $image->path = '/' . self::$imagePath . '/' . $image->name;
            $newImage->move($this::$imagePath . '/', $image->name);
            return $image->save();
        }
    }

    public function newImage()
    {
        $input = Input::all();

        $product = new Product();

        $validationRole = array(
            'image' => 'required|mimes:jpeg,png',
            'id' => 'required|exists:'.$product->getTable()
        );

        $validator = Validator::make($input, $validationRole);

        if ($validator->fails()) {
            return $validator;
        } else {
            $newImage = $input['image'];

            $this->parent_id = $input['id'];
            $this->name = md5(time() . $newImage->getClientOriginalName()) . '.' . $newImage->getClientOriginalExtension();
            $this->mime_type = $newImage->getClientMimeType();
            $this->size = $newImage->getClientSize();
            $this->path = '/' . Image::$imagePath . '/' . $this->name;
            $newImage->move(Image::$imagePath . '/', $this->name);
            $this->save();
        }
    }
}