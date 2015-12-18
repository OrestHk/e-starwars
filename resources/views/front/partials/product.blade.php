<div class="product">
    <img src="" class="image" />
    <div class="about">
        <a class="title" href="">{{$product->name}}</a>
        @if(isset($product->category)) -
        <a class="category" href="{{url('/tags/'.$product->category->slug)}}">{{$product->category->name}}</a>
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
