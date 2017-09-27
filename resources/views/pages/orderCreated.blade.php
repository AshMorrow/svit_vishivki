@extends('main');
@section('title', Lang::get('order.title'))
@section('content')
    <div class="container">
        <div class="success_order_wrapper">
            <span class="icon"></span>

            {{--<span class="text text-thx">@lang('order.thanks')</span><br/>--}}
            <span class="text">@lang('order.successText', ['id' => 4])</span>
        </div>
    </div>
@endsection