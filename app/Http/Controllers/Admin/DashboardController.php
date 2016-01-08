<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\History;
use App\Product;

class DashboardController extends Controller
{
      /**
      * @abstract middleware auth protected dashboard
      */
      public function __construct()
      {
        $this->middleware('auth');
      }

      /**
      * Display a listing of the resource.
      *
      * @return Response
      */
      public function index(){
        return redirect('admin/product');
      }

}
