@extends('admin')
@section('content')
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Заказы</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <form id="filter_form" method="get" action="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_length" id="example1_length">
                                    <label>Сортировать по
                                        <select name="orderBy" aria-controls="example1" class="form-control input-sm" onchange="$('#filter_form').submit()">
                                            <option value="created_at" {{isset($_GET['orderBy']) && $_GET['orderBy'] == 'created_at'? 'selected': ''}}>Дата создания</option>
                                            <option value="id" {{isset($_GET['orderBy']) && $_GET['orderBy'] == 'id'? 'selected': ''}}>Id</option>

                                        </select></label></div>
                            </div>
                            <div class="col-sm-6">
                                <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search"
                                                                                                         class="form-control input-sm"
                                                                                                         placeholder=""
                                                                                                         name="search"
                                                                                                         aria-controls="example1"></label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                   aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th rowspan="1" colspan="1"
                                        aria-label="Id заказа">
                                        Id Заказа
                                    </th>
                                    <th rowspan="1" colspan="1"
                                        aria-label="Имя заказчика">Имя
                                    </th>
                                    <th rowspan="1" colspan="1"
                                        aria-label="Фамилия заказчика">Фамилия
                                    </th>
                                    <th rowspan="1" colspan="1"
                                        aria-label="Номер телефона">Телефон
                                    </th>
                                    <th rowspan="1" colspan="1"
                                        aria-label="Номер телефона">Сумма
                                    </th>
                                    <th rowspan="1" colspan="1"
                                        aria-label="Тип доставки">Тип доставки
                                    </th>
                                    <th rowspan="1" colspan="1"
                                        aria-label="Статус">Статус
                                    </th>
                                    <th rowspan="1" colspan="1"
                                        aria-label="Дата заказа">Дата заказа
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr role="row" onclick="window.location = '/admin/orders/{{$order->id}}'"
                                        @if($order->order_status == 1)
                                        class="info"
                                        @elseif($order->order_status == 2)
                                        class="success"
                                        @elseif($order->order_status == 3)
                                        class="danger"
                                        @else
                                        class="warning"
                                            @endif


                                    >
                                        <td class="sorting_1">{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->last_name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->total_price ?? 0 }} грн</td>
                                        <td>{{ $order->delivery_type }}</td>
                                        <td>{{ $order->order_status }}</td>
                                        <td>{{ $order->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1
                                to 10 of 57 entries
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button previous disabled" id="example2_previous"><a href="#"
                                                                                                            aria-controls="example2"
                                                                                                            data-dt-idx="0"
                                                                                                            tabindex="0">Previous</a>
                                    </li>
                                    <li class="paginate_button active"><a href="#" aria-controls="example2"
                                                                          data-dt-idx="1" tabindex="0">1</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="2"
                                                                    tabindex="0">2</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="3"
                                                                    tabindex="0">3</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="4"
                                                                    tabindex="0">4</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="5"
                                                                    tabindex="0">5</a></li>
                                    <li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="6"
                                                                    tabindex="0">6</a></li>
                                    <li class="paginate_button next" id="example2_next"><a href="#"
                                                                                           aria-controls="example2"
                                                                                           data-dt-idx="7" tabindex="0">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
@endsection