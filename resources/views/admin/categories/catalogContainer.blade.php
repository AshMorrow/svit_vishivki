<div id="product-categories-container">
    <ul>
        @include('admin.categories.inner',
        [
            'cats' => $categories,
            'parent_id' => 0,
             'i' => 0,
             'lan' => 'name_'.App::getLocale()
        ])
    </ul>
</div>