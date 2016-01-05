<div class="products">
    @if(!empty($prods['left']))
        <div class="left blocs">
            @foreach($prods['left'] as $product)
                @include('front.partials.product', $product)
            @endforeach
            <div class="clear"></div>
        </div>
    @endif
    @if(!empty($prods['right']))
        <div class="right blocs">
            @foreach($prods['right'] as $product)
                @include('front.partials.product', $product)
            @endforeach
            <div class="clear"></div>
        </div>
    @endif

    @if(empty($prods['left']) && empty($prods['right']))
        <p>No products available yet.</p>
    @endif
    <div class="clear"></div>
</div>
