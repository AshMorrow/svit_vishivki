@if(is_array($cats) && isset($cats[$parent_id]))
    @if($parent_id != 0) <div class="menu_child"> @endif
        @foreach ($cats[$parent_id] as $cat)
            <div>
                <a href="#">{{$cat->name_ru}}</a>
                @include('pages.include._mainNavCild',['cats' => $cats, 'parent_id' => $cat->id])
            </div>
        @endforeach
        @if($parent_id != 0) </div> @endif
@endif