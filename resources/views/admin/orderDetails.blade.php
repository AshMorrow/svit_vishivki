@extends('admin')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Зказ № {{ $orderData[0]->id }}</h3>
        </div>
        <div class="box-body">
            <table class="table">
                <tbody>
            @foreach($orderData as $data)
                <tr>

                    <td class="img">
                        <img src="/storage/productImages/thumbs/{{ $data->product_id }}/1.jpg">
                    </td>
                    <td>
                        optijons
                    </td>
                    <td>
                        <input name="quantiry" value="{{ $data->product_id }}">
                    </td>
                    <td>
                        <span>{{ $data->price_per_one }} грн</span>
                    </td>
                </tr>

            @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection