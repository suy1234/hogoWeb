<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends AdminBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
    	return view('admin.index');
    }
}


