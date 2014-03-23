<?php

class ImagesController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->responser['viewPath'] = 'images.create';
        $this->responses($this->responser);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $image = new Image();
        $result = $image->newImage();

        if (is_object($result)) {
            $this->responser['error'] = true;
            $this->responser['msg'] = $result->messages()->first();
        } else {
            $this->responser['msg'] = '修改成功';
        }
        $this->responser['redirect'] = route('products.edit', Input::input('id'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $image = new Image();
        $result = $image->updateImage();

        if (is_object($result)) {
            $this->responser['error'] = true;
            $this->responser['msg'] = $result->messages()->first();
        } else {
            $this->responser['msg'] = '修改成功';
        }
        $this->responser['redirect'] = route('products.edit', Input::input('parent_id'));
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
        $image = Image::find($id);
        unlink(substr($image->path, 1));
        $image::destroy($id);
        $this->responser['redirect'] = route('products.edit', Input::input('parent_id'));
        return $this->responses();
    }

}