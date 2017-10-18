<ul class="options-list">
    @foreach($options as $option)
        @php
            $name = $option->name_ru;
            $type = $option->type;
            $optionId = explode(',', $option->char_values_id);
            $optionValues = explode(',', $option->char_values);
        @endphp
        <li>
            <div class="option-head">
                <div class="collapse-btn">
                    <div class="option-name">
                        {{$name}}
                    </div>
                    <div class="collapse-arrow collapse-arrow-rotated">
                        <i class="glyphicon glyphicon-triangle-left"></i>
                    </div>
                </div>
            </div>
            <ul class="option-values-container">
                @foreach($optionId as $key => $value)
                    <li>
                        <label>
                            <input type="checkbox" name="options[]" value="{{$value}}">
                            <div class="option-value">
                                @if($type == 5)
                                    <div {{$type == 5? "style=background:$optionValues[$key]": ''}}>
                                    </div>
                                @else
                                    <div>
                                        {{$optionValues[$key]}}
                                    </div>
                                @endif
                            </div>
                        </label>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>