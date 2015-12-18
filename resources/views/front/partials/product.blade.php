<div class="product">
    @if(isset($product->picture))
    <img src="{{url(IMG_PATH_FRONT.$product->picture->filename)}}" class="{{$single ? 'image' : 'image-min'}}" />
    @endif
    <div class="about">
        <a class="title" href="{{url('/products/'.$product->slug)}}">{{$product->name}}</a>
        @if(isset($product->category)) -
        <a class="category" href="{{url('/categories/'.$product->category->slug)}}">{{$product->category->name}}</a>
        @endif
        @if($single)
        <p class="description">{{$product->description}}</p>
        @else
        <p class="description">{{$product->short_text}}</p>
        @endif
        @if(!empty($product->tags))
        <div class="tags">
            @foreach($product->tags as $tag)
                <a href="{{url('tags/'.$tag->slug)}}" class="tag">{{$tag->name}}</a>
            @endforeach
        </div>
        @endif
    </div>
</div>
