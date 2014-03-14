<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected $layout = 'layouts.master';

    protected $userId;

    protected $responser = array(
        'msg'=>'',
        'error'=>false,
        'data'=>array(),
        'redirect'=> '',
        'viewPath'=>''
    );


    public function __construct(){
        if (Auth::check()){
            $this->userId = Auth::user()->getAuthIdentifier();
        }
    }

    protected function responses(){
        $responser =  $this->responser;

        if(Request::wantsJson() OR Request::ajax()){
            if($responser['error']){
                return Response::json(array(
                    'msg'=>$responser['msg'],
                    'error'=>$responser['error'],
                    'data'=>$responser['data'])
                );
            }else{

                foreach ($responser['data'] as &$item){
                    if(is_object($item)){
                        $item = $item->toArray();
                    }
                }
                return Response::json(array(
                    'msg'=>$responser['msg'],
                    'error'=>$responser['error'],
                    'data'=>$responser['data']
                ));
            }
        }else{
            if($responser['error']){
                return Redirect::to($responser['redirect'])->with(array('error'=>$responser['msg']));
            }else{
                if (!$this->responser['redirect']){
                    $this->layout->content = View::make($responser['viewPath'], $responser['data']);
                }else{
                    return Redirect::to($responser['redirect']);
                }
            }
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