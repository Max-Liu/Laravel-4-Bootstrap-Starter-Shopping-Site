<?php

class BaseController extends Controller
{

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected $layout = 'layouts.master';

	protected $userId;


	protected $responser = array(
		'msg' => '',
		'error' => false,
		'data' => array(),
		'redirect' => '',
		'viewPath' => ''
	);


	public function __construct()
	{
		$permission = new ShopCore\Permission(new ShopCore\permission\PermissionRepository(), new ShopCore\user\UserRepository());

		if (Auth::check()) {
			$this->userId = Auth::user()->getAuthIdentifier();
			$currentRouteName =  Route::getCurrentRoute()->getName();

			if($permission->hasPermission($this->userId,$currentRouteName)){


			}else{
//				$this->responser['error'] = true;
//				$this->responser['msg']='没有权限';
				app::abort(403);
			};

		}
	}
	protected function responses()
	{
		$responser = $this->responser;

		if (Request::wantsJson() OR Request::ajax()) {
			if ($responser['error']) {
				return Response::json(array(
						'msg' => $responser['msg'],
						'error' => $responser['error'],
						'data' => $responser['data'])
					, 400);
			} else {

				if (is_array($responser['data'])) {
					foreach ($responser['data'] as &$item) {
						if (is_object($item)) {
							$item = $item->toArray();
						}
					}
				}

				return Response::json(array(
					'msg' => $responser['msg'],
					'error' => $responser['error'],
					'data' => $responser['data']
				));
			}
		} else {
			if ($responser['error']) {
				if (!$responser['redirect']) {
					$responser['redirect'] = URL::previous();
				}
				return Redirect::to($responser['redirect'])->with(array('error' => $responser['msg'], 'data' => $responser['data']));
			} else {
				if (!$this->responser['redirect']) {
					$this->layout->content = View::make($responser['viewPath'], $responser['data']);
				} else {
					Session::flash('info', $this->responser['msg']);
					return Redirect::to($responser['redirect']);
				}
			}
		}
	}

	protected function setupLayout()
	{
		if (!is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}

}