<div class="product-container">
    <div class="about-top">
        @if(isset($product->picture))
        <img src="{{url(IMG_PATH_FRONT.$product->picture->filename)}}" class="image-min" />
        @endif
        <a class="title" href="{{url('/products/'.$product->slug)}}">{{$product->name}}</a>
        <p class="description">{{$product->short_text}}</p>
        <div class="clear"></div>
    </div>
    @if(isset($product->category))
    <a class="cube category {{$product->category->slug}}" href="{{url('/categories/'.$product->category->slug)}}" title="{{$product->category->name}}">
        <div class="borders">
            <div class="top"></div>
            <div class="right"></div>
            <div class="bot"></div>
            <div class="left"></div>
        </div>
    </a>
    @endif
    @if(!empty($product->tags))
    <div class="tags">
        @foreach($product->tags as $tag)
            <a href="{{url('tags/'.$tag->slug)}}" class="tag cube {{$tag->slug}}" title="{{$tag->name}}">
                <div class="borders">
                    <div class="top"></div>
                    <div class="right"></div>
                    <div class="bot"></div>
                    <div class="left"></div>
                </div>
            </a>
        @endforeach
    </div>
    @endif
</div>
