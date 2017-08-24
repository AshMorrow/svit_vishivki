@extends('main')
@section('title','Товар 1')
@section('content')
    <section class="container product_container">

        <div id="product_photo_container">
            <div id="product_photo_thumbs">
                <a data-slide-index="0" href=""><img id="product_big_image" src="/storage/productImages/full/1/1.jpg"></a>
                <a data-slide-index="1" href=""><img id="product_big_image" src="/storage/productImages/full/1/2.jpg"></a>
                <a data-slide-index="0" href=""><img id="product_big_image" src="/storage/productImages/full/1/1.jpg"></a>
                <a data-slide-index="1" href=""><img id="product_big_image" src="/storage/productImages/full/1/2.jpg"></a>
                <a data-slide-index="0" href=""><img id="product_big_image" src="/storage/productImages/full/1/1.jpg"></a>
                <a data-slide-index="1" href=""><img id="product_big_image" src="/storage/productImages/full/1/2.jpg"></a>
            </div>

            <div id="product_photo_full">
                <img src="/storage/productImages/full/1/1.jpg">
            </div>


        </div>

        <div id="product_details_container">
            <h1>ASOS BRIDAL Here Comes The Bride Vest & Short Pyjama Set</h1>
            <div class="pd_price_article">
                <div class="pd_price">150.00 грн</div>
                <div class="pd_article">
                    <span>Артикул:</span>
                    <span>1524882</span>
                </div>
            </div>
            <div class="pd_characteristics noselect">
                <div class="pd_c_size">
                    <label>
                        <input type="radio" name="product_size" checked/>
                        <div>S</div>
                    </label>
                    <label>
                        <input type="radio" name="product_size"/>
                        <div>M</div>
                    </label>
                    <label>
                        <input type="radio" name="product_size"/>
                        <div>L</div>
                    </label>
                </div>
                <div class="pd_c_color">
                    <label>
                        <input type="radio" name="product_color" checked/>
                        <div class="pd_c_color_containter">
                            <div class="pd_c_color_fill" style="background-color: red"></div>
                        </div>
                    </label>
                    <label>
                        <input type="radio" name="product_color"/>
                        <div class="pd_c_color_containter">
                            <div class="pd_c_color_fill" style="background-color: black"></div>
                        </div>
                    </label>
                </div>
            </div>
            <div class="add_to_cart">
                <button>
                    Добавить в корзину
                </button>
            </div>
            <div class="pd_tab_nav noselect">
                <label class="pd_tab_btn">
                    <input type="radio" hidden checked name="pd_tab" onchange="$(this).next().click()"/>
                    <label for="pd_tad_info"></label>
                    <span>Описание</span>
                </label>
                <label class="pd_tab_btn">
                    <input type="radio" hidden name="pd_tab" onchange="$(this).next().click()"/>
                    <label for="pd_tad_delivery"></label>
                    <span>Доставка</span>
                </label>
                <label class="pd_tab_btn">
                    <input type="radio" hidden name="pd_tab" onchange="$(this).next().click()"/>
                    <label for="pd_tad_comments"></label>
                    <span>Коментарии </span>
                </label>
            </div>
            <div class="pd_tab_data">
                <input id="pd_tad_info" type="radio" hidden checked name="pd_tab_data">

                <div>
                    <p>
                        Before you start off to the website, answer one question: what is it that you pursue when
                        choosing your lingerie? Is it soothing comfort or breathtaking seductive power?
                        Every woman knows that her most sophisticated and impressive outfit is not complete without
                        perfect lingerie underneath. Just as an old joke says, “She was wearing all white, but no one
                        could see that, as there was a black dress on her”.
                    </p>
                </div>

                <input id="pd_tad_delivery" type="radio" hidden name="pd_tab_data">
                <div>Доставка</div>
                <input id="pd_tad_comments" type="radio" hidden name="pd_tab_data">
                <div id="disqus_thread"></div>
            </div>
        </div>
    </section>
    <script>
        var b = new Gallery('product_photo_full');

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
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://svit-vishivki.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();

    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endsection