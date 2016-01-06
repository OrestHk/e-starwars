<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\Category;
use View;
use App\Tag;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // Get all categories
        View::composer('partials.main_menu', function ($view) {
            $view->with('categories', Category::all());
        });
        // Get all tags
        View::composer('front.partials.menu', function ($view){
            $view->with('allTags', Tag::all());
        });
    }

}
