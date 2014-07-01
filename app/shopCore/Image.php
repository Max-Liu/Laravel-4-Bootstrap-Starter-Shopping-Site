<?php
namespace ShopCore;

use ShopCore\product\ProductRepository;

class Image
{
	public $imagePath = 'uploads/images';

	public function __construct(image\ImageValidator $validator, image\ImageRepository $data, ProductRepository $fatherEntity)
	{
		$this->validator = $validator;
		$this->data = $data;
		$this->fatherEntity = $fatherEntity;
	}

	public function update($input)
	{
		$image = $this->data->find($input['id']);
		$image->parent_id = $input['parent_id'];
		unlink(substr($image->path, 1));
		$newImage = $input['image'];

		$image->name = md5(time() . $newImage->getClientOriginalName()) . '.' . $newImage->getClientOriginalExtension();
		$image->mime_type = $newImage->getClientMimeType();
		$image->size = $newImage->getClientSize();
		$image->path = '/' . $this->imagePath . '/' . $image->name;
		$newImage->move($this->imagePath . '/', $image->name);
		return $image->save();
	}

	public function insert($input)
	{
		$newImage = $input['image'];
		$this->data->parent_id = $input['parent_id'];
		$this->data->name = md5(time() . $newImage->getClientOriginalName()) . '.' . $newImage->getClientOriginalExtension();
		$this->data->mime_type = $newImage->getClientMimeType();
		$this->data->size = $newImage->getClientSize();
		$this->data->path = '/' . $this->imagePath . '/' . $this->data->name;
		$newImage->move($this->imagePath . '/', $this->data->name);
		$this->data->save();
	}

	public function destroy($id)
	{
		$image = $this->data->find($id);
		unlink(substr($image->path, 1));
		$this->data->destroy($id);
	}
}