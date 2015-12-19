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
        @if($single)
          {!! Form::label('quantity','quantité',['for'=>'quantity']) !!}
          {!! Form::select('quantity',array(
                                      '1'=>'1',
                                      '2'=>'2',
                                      '3'=>'3',
                                      '4'=>'4',
                                      '5'=>'5',
                              ))!!}
          <input type="button" data-id="{{$product->id}}" name="order" value="commandez">
        @endif
    </div>
</div>
