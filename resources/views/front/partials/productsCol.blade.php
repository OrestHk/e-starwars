<div class="products">
    @if($prods['left'])
        <div class="left blocs">
            @foreach($prods['left'] as $product)
                @include('front.partials.product', array($product, $single = false))
            @endforeach
            <div class="clear"></div>
        </div>
    @endif
    @if($prods['right'])
        <div class="right blocs">
            @foreach($prods['right'] as $product)
                @include('front.partials.product', array($product, $single = false))
            @endforeach
            <div class="clear"></div>
        </div>
    @endif

    @if(!$prods['left'] && !$prods['right'])
        <p>No products available yet.</p>
    @endif
    <div class="clear"></div>
</div>
