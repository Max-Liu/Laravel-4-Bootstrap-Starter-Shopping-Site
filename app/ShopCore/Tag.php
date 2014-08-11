<?php
namespace ShopCore;

class Tag
{
	public function __construct(tag\TagRepository $tag, tag\TagRelationRepository $tagRelation)
	{
		$this->$tagData = $tag;
		$this->$tagRelationData = $tagRelation;
	}
}