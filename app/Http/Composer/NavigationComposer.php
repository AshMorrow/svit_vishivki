<?php

namespace App\Http\Composer;


use Illuminate\View\View;

class NavigationComposer
{

    public function compose(View $view){

        return $view->with('name','test');

    }

}