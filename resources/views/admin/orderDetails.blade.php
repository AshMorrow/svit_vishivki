@extends('admin')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Зказ № {{ $orderData[0]->id }}</h3>
        </div>
        <div class="box-body">
            <div class="col-md-4">
            <label>
                <span>Имя: </span>
                <input class="form-control" value="{{$orderData[0]->name}}">
            </label>
            <label>
                <span>Фамилия: </span>
                <input class="form-control" value="{{$orderData[0]->last_name}}">
            </label>
            <label>
                <span>Email: </span>
                <input class="form-control" value="{{$orderData[0]->email}}">
            </label>
            <label>
                <span>Коментарий: </span>
                <textarea class="form-control" value="{{$orderData[0]->comment}}">{{$orderData[0]->comment}}</textarea>
            </label>
            </div>
            <div class="col-md-8">
                <table class="table products-in-order">
                    <tbody>
                    @foreach($orderData as $data)
                        <tr>

                            <td class="img">
                                <img src="/storage/productImages/thumbs/{{ $data->product_id }}/1.jpg">
                            </td>
                            <td class="product_options">
                                @php
                                    $name = 'name_'.App::getLocale();
                                    foreach(explode(',',$data->options) as $option_id){
                                        foreach($options as $option){
                                                if(!in_array($option_id,$option->char_values_id)) continue;
                                                echo '<div class="option_group"><span>'.$option->$name.'</span>';
                                            foreach($option->char_values_id as $key => $id){
                                                if($option_id == $id && $option->type != 5){
                                                    echo '<div data-option-type="'.$option->type.'">'.
                                                    $option->char_values[$key].'</div>';
                                                }elseif (($option_id == $id && $option->type == 5)){
                                                    echo '<div class="product_color"
                                                    style="background-color:'.$option->char_values[$key].'"> </div>';
                                                }
                                            }
                                            echo '</div>';
                                        }
                                    }
                                @endphp
                            </td>
                            <td>
                                <input name="quantiry" class="form-control input-mini" value="{{ $data->product_id }}">
                            </td>
                            <td>
                                <span>{{ $data->price_per_one }} грн</span>
                            </td>
                            <td>
                                <i class="glyphicon glyphicon-remove"></i>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Товары</h3>
        </div>
        <div class="box-body">

        </div>
    </div>
@endsection