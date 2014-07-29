<?php
namespace ShopCore\image;
class ImageRepository extends \Eloquent
{
	protected $fillable = ['parent_id'];
	protected $table = 'images';



}