@extends('admin')
@section('title', 'Товары')
@section('content')
    <div class="box-wrap">
        <div class="box-header row">
            <div class="col-md-3">
                <a href="products/create" class="btn btn-flat btn-warning">Создать товар</a>
            </div>
            <div class="filter-group col-md-9 text-right">
                <form>
                    <label class="">
                      <select class="form-control input-md" name="activity">
                          <option value="all" {{Request::get('activity') == 'all'? 'selected': ''}}>Все</option>
                          <option value="active" {{Request::get('activity') == 'active'? 'selected': ''}}>Активные</option>
                          <option value="no_active" {{Request::get('activity') == 'no_active'? 'selected': ''}}>Не активные</option>
                      </select>
                    </label>
                    <label>
                        <input type="text" name="search" placeholder="Артикул" class="form-control input-md" value="{{$_GET['search']??''}}">
                    </label>
                    <input type="submit" class="btn btn-flat btn-info" value="Фильтровать">
                </form>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <tr>
                    <th></th>
                    <th>Имя</th>
                    <th>Артикул</th>
                    <th>Цена</th>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td class="pl-image">
                            <div>
                                <img src="/storage/productImages/thumbs/{{ $product->id }}/1.jpg" alt="" />
                            </div>
                        </td>
                        <td>{{ $product->name_ru }}</td>
                        <td>{{ $product->vendor_code }}</td>
                        <td>{{ $product->price }} грн.</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer f-box-footer">
            <ul class="pagination">
                {{ $products->links('pagination.adminPagination',['result' => $products]) }}
            </ul>
        </div>
    </div>
@endsection