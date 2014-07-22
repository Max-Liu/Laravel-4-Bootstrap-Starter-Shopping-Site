<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	public function generateFakeData(Illuminate\Database\Eloquent\Model $entity,$data){
		foreach (array_combine($entity->getFillable(),$data) as $key=>$value){
			$entity->$key = $value;
		}
	}


	public function validInsert(Illuminate\Database\Eloquent\Model $entity,$data){
		foreach($entity->getFillable() as $key =>$value){
			$this->assertTrue($entity->$value == $data[$key]);
		}
	}

	public function validUpdate(Illuminate\Database\Eloquent\Model $entity,$data){
		foreach($entity->getFillable() as $key => $value){
				$entity->$value = $data[$key];
		}
		$entity->save();
		$updatedData = $entity->find($entity->id);
		foreach($updatedData->getFillable() as $key =>$value){
			$this->assertTrue($entity->$value == $data[$key]);
		}
	}
}
