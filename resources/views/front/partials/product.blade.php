<div class="product-container">
    <div class="about-top">
        @if(isset($product->picture))
        <a title="{{$product->name}}" href="{{url('/product/'.$product->slug)}}">
            <img src="{{url(IMG_PATH_FRONT.$product->picture->filename)}}" class="image-min" />
        </a>
        @endif
        <a class="title" title="{{$product->name}}" href="{{url('/product/'.$product->slug)}}">{{$product->name}}</a>
        <p class="description">{{$product->short_text}}</p>
        <div class="clear"></div>
    </div>
    @if(isset($product->category))
    <a class="cube category {{$product->category->slug}}" href="{{url('/category/'.$product->category->slug)}}" title="{{$product->category->name}}">
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
            <a href="{{url('tag/'.$tag->slug)}}" class="tag cube {{$tag->slug}}" title="{{$tag->name}}">
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
