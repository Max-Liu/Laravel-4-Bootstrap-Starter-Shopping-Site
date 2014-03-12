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
        $addressList = Address::where('user_id', '=', $this->userId)->paginate(5);

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
        $input = Input::only(array('name', 'phone', 'address', 'city', 'postcode'));

        $address = new Address();
        $result = $address->createNewAddress($input);

        if (is_object($result)) {
            return Redirect::route('address.create')->withErrors($result);
        } else {
            return Redirect::route('address.index');
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
        echo 131;
        exit;
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
        $input = Input::only(array('name', 'phone', 'address', 'city', 'postcode'));

        $address = Address::find($id);
        $result = $address->updateAddress($input);

        if (is_object($result)) {
            return Redirect::route('address.edit', $id)->withErrors($result);
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

}