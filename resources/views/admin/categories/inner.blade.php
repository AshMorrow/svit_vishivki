@if(is_array($categories) && isset($categories[$parent_id]))
    @if($parent_id != 0)
        <ul {{$i > 0? 'style=display:none;': ''}}>
            @endif
            @foreach ($categories[$parent_id] as $category)
                <li>
                    <div>
                        <label class="category-select-btn c-checkbox-container">
                            <input class="input-required" type="radio" name="category" value="{{$category->id}}">
                            <div>
                                <div></div>
                            </div>
                        </label>
                        <div class="collapse-btn">
                        <div class="category-name">
                            {{$category->$lan }}
                        </div>
                        @if(isset($categories[$category->id]))
                            <div class="collapse-arrow">
                                <i class="glyphicon glyphicon-triangle-left"></i>
                            </div>
                        @endif
                        </div>
                    </div>
                    @include('admin.categories.inner',[
                    'cats' => $categories,
                    'parent_id' => $category->id,
                    'i' => ++$i,
                    'lan' => 'name_'.App::getLocale()
                ])

                </li>
                @php
                    $i -= 1;
                @endphp
            @endforeach
            @if($parent_id != 0) </ul> @endif
@endif