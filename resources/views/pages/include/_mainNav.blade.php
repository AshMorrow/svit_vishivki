<nav id="main_menu" class="nav container">
    @include('pages.include._mainNavCild',
    [
        'cats' => $cats,
        'parent_id' => 0,
         'i' => 0,
         'url' => '/category'
    ])
</nav>