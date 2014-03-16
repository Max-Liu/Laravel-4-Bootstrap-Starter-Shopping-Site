<?php
return array(

    'title' => 'Products',
    /**
     * The singular name of your model
     *
     * @type string
     */
    'single' => 'Product',


    /**
     * The class name of the Eloquent model that this config represents
     *
     * @type string
     */
    'model' => 'Product',


    /**
     * The columns array
     *
     * @type array
     */
    'columns' => array(
        'name'=>array(
            'title'=>'商品名称',
        ),
        'price'=>array(
            'title'=>'价格'
        ),
        'satus'=>array(
            'title'=>'商品状态'
        ),
        'created_at'=>array(
            'title'=>'创建时间',
        ),
        'updated_at'=>array(
            'title'=>'修改时间',
        )
    ),

    'edit_fields' => array(
        'name' => array(
            'title' => '商品名称',
            'type' => 'text'
        ),
        'price'=>array(
            'title'=>'价格',
            'type'=>'text'
        ),

    ),
);