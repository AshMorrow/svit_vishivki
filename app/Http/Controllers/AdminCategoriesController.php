<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Categories;
use App\Main_menu;

class AdminCategoriesController extends Controller
{
    public function show(){


        $mesh = Main_menu::allCategories();
        $categories = Categories::formTree($mesh);
        return view('admin.categoriesList', ['categories' => $categories]);

    }
}
