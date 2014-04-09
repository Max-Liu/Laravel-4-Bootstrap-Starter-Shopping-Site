<?php

class AddressesController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $addressList = Address::where('user_id', '=', $this->userId)->orderBy('id','desc')->paginate(5);

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
        $address = new Address();
        $result = $address->createNewAddress($input);

        if (is_object($result)) {
	        $this->responser['redirect'] = route('address.create');
	        $this->responser['error'] = true;
	        $this->responser['msg'] = $result->errors()->first();
	        $this->responser['data'] = $input;
	        return $this->responses();
        } else {
	        $this->responser['redirect'] = route('address.index');
	        return $this->responses();
        }
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
        $address = Address::find($id);
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

        $address = Address::find($id);
        $result = $address->updateAddress($input);

        if (is_object($result)) {
	        $this->responser['viewPath'] = route('address.edit');
	        $this->responser['error'] = true;
	        $this->responser['msg'] = $result->errors()->first();
	        return $this->responses();
        } else {
            return Redirect::route('address.edit', $id);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Address::find($id)->exists()) {
            if (Address::find($id)->user_id == $this->userId) {
                Address::destroy($id);
            }
        }
        return Redirect::to(route('address.index'));
    }

    public function setDefault($id){
        $address = Address::find($id);

        if ($address->exists AND $address->user_id == $this->userId){
            Address::where('user_id','=',$this->userId)->update(array('is_default'=>0));
            $address->is_default = 1;
            $address->save();
        }
        return Redirect::to(route('address.index'));
    }
}