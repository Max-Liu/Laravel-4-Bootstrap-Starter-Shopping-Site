<?php

class AddressesController extends \BaseController
{

	public function __construct(ShopCore\Address $address){
		parent::__construct();
		$this->address = $address;
	}
		/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
	    $addressList = $this->address->data->getAddressList($this->userId);
        $this->layout->content = View::make('address.list', compact('addressList'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->layout->content = View::make('address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::only(array('name', 'phone', 'address', 'city', 'postcode','province'));
		$input['user_id']= $this->userId;

	    $validate = $this->address->validator->validateForInsert($input);
	    if($validate){
		    $this->address->data->createNewAddress($input);
		    $this->responser['redirect'] = route('addresses.index');
	    }else{
		    $this->responser['redirect'] = route('addresses.create');
		    $this->responser['error'] = true;
		    $this->responser['msg'] = $this->address->validator->errors()->first();
		    $this->responser['data'] = $input;
	    }
	    return $this->responses();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $address = $this->address->data->find($id);
        $this->layout->content = View::make('address.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $input = Input::only(array('name', 'phone', 'address', 'city', 'postcode','province'));
	    $input['user_id']= $this->userId;


	    $validate= $this->address->validator->validForUpdate($input);


	    if($validate){
		    $this->address->data->updateAddress($input,$id);
		    $this->responser['redirect'] = route('addresses.index');
	    }else{
		    $this->responser['redirect'] = route('addresses.create');
		    $this->responser['error'] = true;
		    $this->responser['msg'] = $this->address->validator->errors()->first();
		    $this->responser['data'] = $input;
	    }
	    return $this->responses();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
	    $address = $this->address->data->find($id);
        if ($address->exists) {
            if ($address->user_id == $this->userId) {
                $this->address->data->destroy($id);
            }
        }
        return Redirect::to(route('addresses.index'));
    }

    public function setDefault($id){

	    $this->address->setDefault($id,$this->userId);
	    return Redirect::to(route('addresses.index'));
    }
}