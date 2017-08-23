<?php

namespace App\Http\Composer;


use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class NavigationComposer
{

    /**
     * Creating main menu navigation array
     * @param $mess
     * @return array|bool
     */
    public function form_tree($mess)
    {
        if (!is_array($mess)) {
            return false;
        }
        $tree = array();
        foreach ($mess as $value) {
            $tree[$value->parent_id][] = $value;
        }
        return $tree;
    }

    public function compose(View $view)
    {
        $menu_data = (array)DB::table('main_menu')
            ->orderBy('parent_id')
            ->get()
            ->toArray();
        $tree = $this->form_tree($menu_data);
        
        return $view->with('cats', $tree);
    }

}