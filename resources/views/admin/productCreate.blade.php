@extends('admin')
@section('title', 'Создвние товара')
@section('content')
    <div class="box-wrap">

        <div class="product-tab-control nav-tabs-custom">
            <ul id="nav-tabs" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#main">Основная информация</a></li>
                <li><a data-toggle="tab" href="#categories-options">Категория и опции</a></li>
            </ul>
        </div>
        <form id="product-form" method="post">
            {{ csrf_field() }}
            <div class="scrolled-container tab-content" >
                <div id="main" class="tab-pane active">
                    <div class="box-header">
                        <div class="lan-change-btns col-md-5">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div {!! App::getLocale() == $properties['lan'] ? "class='active'": ''!!} onclick="chLanguage(this, '{{ $properties['lan'] }}')">
                    <span>
                        {{ $properties['lan'] }}
                    </span>
                                </div>
                            @endforeach
                        </div>
                        <div class="status-btn-group">
                            <label class="trigger-container">
                                <span>Активный</span>
                                <input type="checkbox" name="is_active" value="1">
                                <div class="trigger-bg">
                                    <div class="trigger-knob"></div>
                                </div>
                            </label>
                            <label class="trigger-container">
                                <span>Новый</span>
                                <input type="checkbox" name="is_new" value="1">
                                <div class="trigger-bg">
                                    <div class="trigger-knob"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="products-images-container">
                                <input id="input-image" type="file" style="display: none"
                                       onchange="ProductsImages.upload(event)">
                                <canvas id="canvas-image" style="display: none"></canvas>
                                <div class="big-image">
                                    <img src="" onerror="$(this).attr('src','/adminFiles/img/placeholder.png')">
                                </div>
                                <div class="pi-thumbnail">
                                    <div data-id="1" class="add-new"><i class="fa fa-file-image-o"></i></div>
                                    <div data-id="2"></div>
                                    <div data-id="3"></div>
                                    <div data-id="4"></div>
                                    <div data-id="5"></div>
                                    <div data-id="6"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <div id="lan-fields-{{ $properties['lan'] }}"
                                     class="lan-fields"
                                     style={{$properties['lan'] != 'ru'? 'display:none;': ''}}
                                >
                                    <div class="form-group">
                                        <label>
                                            <span>Название {{ $properties['lan'] }}</span>
                                        </label>
                                        <input type="text"
                                               id="product_name_{{$properties['lan']}}"
                                               class="form-control input-required"
                                               name="name_{{$properties['lan']}}"
                                               data-error="Заполните поле: Название {{$properties['lan']}}"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <span>Описание {{ $properties['lan'] }}</span>
                                        </label>
                                        <textarea id="description-{{ $properties['lan'] }}"
                                                  type="text"
                                                  class="form-control"
                                                  name="description_{{$properties['lan']}}"
                                        ></textarea>
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <label>
                                    <span>Артикул</span>
                                </label>
                                <input type="text" class="form-control input-required" name="vendor_code"
                                       data-error="Заполните поле: Артикул"
                                >
                            </div>
                            <div class="form-group">
                                <label>
                                    <span>Цена</span>
                                </label>
                                <input type="text" class="form-control input-required" name="price"
                                       data-error="Заполните поле: Цена"
                                >
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label>--}}
                                    {{--<span>URL</span>--}}
                                {{--</label>--}}
                                {{--<input id="product_url" type="text" class="form-control" name="url">--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <div id="categories-options" class="tab-pane">
                    <div class="box-body">
                        <div class="col-md-6 col-lg-5">
                            @include('admin.categories.catalogContainer')
                        </div>
                        <div class="col-md-6 col-lg-5">
                            @include('admin.include._options')
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer f-box-footer">
                <div>
                    <input type="button" class="btn btn-flat btn-success" value="Создать" onclick="ProductsForm.submit()">
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {

            categoriesCollapse();

            $('#nav-tabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            });

            $('.pi-thumbnail div').click(function (e) {
                if ($(this).hasClass('add-new')) {
                    $('#input-image').click();
                } else if ($(this).find('.thumb').length) {
                    var imgUrl = $(this).find('.thumb').find('img').attr('src');
                    $('.pi-thumbnail').find('.active').removeClass('active');
                    $(this).addClass('active');
                    $('.big-image').find('img').attr('src', imgUrl);
                }
            });
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            CKEDITOR.replace('description-{{ $properties['lan'] }}');
            @endforeach
        });
    </script>
@endsection