<aside id="product_filter">
    <form method="get">
        <div class="pf_group">
            <div class="pg_g_label">Цена</div>
            <div class="pf_price_container">
                <input type="text" id="filter_price_value_min" readonly name="price[price_from]">
                <span>-</span>
                <input type="text" id="filter_price_value_max" readonly name="price[price_to]">
            </div>
        </div>
        <div id="slider-range"></div>
        <button type="submit">@lang('buttons.filter')</button>
    </form>
</aside>