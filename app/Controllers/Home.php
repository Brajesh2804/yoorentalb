<?php

namespace App\Controllers;
use App\Libraries\Cart;

class Home extends BaseController
{
    public $commonmodel;
    public function __construct()
    {
        $this->commonmodel = model('App\Models\CommonModel', false);
    }
    public function index(): string
    {
        // $data['products'] = $this->commonmodel->getAllRecord('tbl_product',['status'=>1, 'is_front'=>1]);
        // echo "<pre>"; print_r($data['products']); exit;
        // return view('home', $data);
        return view('welcome_message');
    }
    
  
}
