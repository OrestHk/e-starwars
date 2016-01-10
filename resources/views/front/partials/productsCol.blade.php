<div class="products-container">
    <p class="main-title">
        @if(isset($tag))
            {{$tag->name}}
        @elseif(isset($category))
            {{$category->name}}
        @endif
    </p>
    @if(!empty($prods['left']))
        <div class="left blocs">
            @foreach($prods['left'] as $product)
                @include('front.partials.product', $product)
            @endforeach
        </div>
    @endif
    @if(!empty($prods['right']))
        <div class="right blocs">
            @foreach($prods['right'] as $product)
                @include('front.partials.product', $product)
            @endforeach
        </div>
    @endif

    @if(empty($prods['left']) && empty($prods['right']))
        <p>No products available yet.</p>
    @endif
    <div class="clear"></div>
    <div class="container-loader">
        <div class="loader">
            <div class="top"></div>
            <div class="right"></div>
            <div class="bot"></div>
            <div class="left"></div>
        </div>
    </div>
    <div class="no-more">
        <p>You reached the end of this galaxy !</p>
    </div>
</div>
