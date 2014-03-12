<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected $layout = 'layouts.master';

    protected $userId;


    public function __construct(){

        if (Auth::check()){
            $this->userId = Auth::user()->getAuthIdentifier();
        }
    }

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}