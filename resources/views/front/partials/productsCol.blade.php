<div class="products">
    <div class="left blocs">
        @forelse($prods['left'] as $product)
            @include('front.partials.product', array($product, $single = false))
        @empty
            <p>No products available yet.</p>
        @endforelse
        <div class="clear"></div>
    </div>
    <div class="right blocs">
        @forelse($prods['right'] as $product)
            @include('front.partials.product', array($product, $single = false))
        @empty
            <p>No products available yet.</p>
        @endforelse
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
