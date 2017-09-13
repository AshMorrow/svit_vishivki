@extends('main')
@section('title','Товар 1')
@section('content')
    <section class="container product_container">
        <div id="product_photo_container">
            <div id="product_photo_thumbs">
                @foreach($galleryThumbImages as $index => $path)
                    <div class="gallery_thumbs pp_thumb_image_container {{ $index == 0? 'active': '' }}"
                         data-slide-index="{{ $index }}">
                        <img id="product_big_image" src="/storage/{{ $path }}">
                    </div>
                @endforeach
            </div>

            <div id="product_photo_full">
                @foreach($galleryFullImages as $index => $path)
                    <img data-index="{{ $index }}" class="{{$index == 0? 'active': ''}}" src="{{ '/storage/'.$path }}">
                @endforeach
            </div>
        </div>

        <div id="product_details_container">
            <h1 id="productLabel">{{ $product['name_'.$lan] }}</h1>
            <div class="pd_price_article">
                <div class="pd_price">{{ $product['price'] }} грн</div>
                <div class="pd_article">
                    <span>@lang('product.vendor_code'):</span>
                    <span>{{ $product['vendor_code'] }}</span>
                </div>
            </div>
            <div class="pd_characteristics noselect">
                @foreach($characteristics as $char)
                    @php
                        $char_values_id = explode(',', $char->char_values_id);
                        $char_values = explode(',', $char->char_values);
                    @endphp
                    @if($char->type == '4')
                        <div class="pd_c_size characteristic_group" data-type="4">
                            @foreach($char_values as $key => $value)
                                <label>
                                    <input data-id='{{ $char_values_id[$key] }}'
                                           type="radio"
                                           name="product_size" {{ $key == 0? 'checked': '' }}/>
                                    <div>{{ $value }}</div>
                                </label>
                            @endforeach
                        </div>
                    @elseif($char->type == '5')
                        <div class="pd_c_color characteristic_group" data-type="5">
                            @foreach($char_values as $key => $value)
                                <label>
                                    <input data-id='{{ $char_values_id[$key] }}'
                                           type="radio"
                                           name="product_color" {{ $key == 0? 'checked': '' }}/>
                                    <div class="pd_c_color_containter">
                                        <div class="pd_c_color_fill" style="background-color: {{ $value }}"></div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="add_to_cart">
                <button onclick="Cart.add({{ $product['id'] }}, '{{ $product['name_'.$lan] }}',true)">
                    @lang('buttons.add_to_basket')
                </button>
            </div>
            <div class="pd_tab_nav noselect">
                <label class="pd_tab_btn">
                    <input type="radio" hidden checked name="pd_tab" onchange="$(this).next().click()"/>
                    <label for="pd_tad_info"></label>
                    <span>@lang('product.tab_description')</span>
                </label>
                <label class="pd_tab_btn">
                    <input type="radio" hidden name="pd_tab" onchange="$(this).next().click()"/>
                    <label for="pd_tad_delivery"></label>
                    <span>@lang('product.tab_delivery')</span>
                </label>
                <label class="pd_tab_btn">
                    <input type="radio" hidden name="pd_tab" onchange="$(this).next().click()"/>
                    <label for="pd_tad_comments"></label>
                    <span>@lang('product.tab_comments')</span>
                </label>
            </div>
            <div class="pd_tab_data">
                <input id="pd_tad_info" type="radio" hidden checked name="pd_tab_data">

                <div>
                    {{ $product['description_'.$lan] }}
                </div>

                <input id="pd_tad_delivery" type="radio" hidden name="pd_tab_data">
                <div>Доставка</div>
                <input id="pd_tad_comments" type="radio" hidden name="pd_tab_data">
                <div id="disqus_thread"></div>
            </div>
        </div>
    </section>
    <script>
        new Gallery('product_photo_full', 'product_photo_thumbs');
        $(document).ready(function () {
            $("#product_photo_thumbs").mCustomScrollbar({
                theme: 'dark-thick',
                autoHideScrollbar: true
            });
        });
    </script>
    <!-- Disqus load script -->
    <script>

        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
         var disqus_config = function () {
         this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
         this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
         };
         */
        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://svit-vishivki.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();

    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>
@endsection