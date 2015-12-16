<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;


class FrontController extends Controller
{
  public function index(){
    $products = Product::all()->take(5);
    return \view('front.index',compact('products'));
  }
}
