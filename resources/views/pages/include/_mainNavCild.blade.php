@if(is_array($cats) && isset($cats[$parent_id]))
    @if($parent_id != 0)
        <div class="menu_child menu_child_{{$i}}">
            @endif
            @foreach ($cats[$parent_id] as $cat)
                <div  @if($i == 0) onmouseover="showMenu(this)" @endif @if($i == 1) class="col-sm-3" @endif>
                    <a href="{{$url.'/'.$cat->url}}">
                        {{$cat->name_ru}}
                    </a>
                    @include('pages.include._mainNavCild',[
                        'cats' => $cats,
                        'parent_id' => $cat->id,
                        'i' => ++$i,
                        'url' => $url.'/'.$cat->url
                    ])
                </div>
                @php
                    $i -= 1;
                @endphp
            @endforeach
            @if($parent_id != 0) </div> @endif
@endif