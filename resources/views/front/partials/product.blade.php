<div class="product">
    <div class="about-top">
        @if(isset($product->picture))
        <img src="{{url(IMG_PATH_FRONT.$product->picture->filename)}}" class="{{$single ? 'image' : 'image-min'}}" />
        @endif
        <a class="title" href="{{url('/products/'.$product->slug)}}">{{$product->name}}</a>
        @if($single)
        <p class="description">{{$product->description}}</p>
        @else
        <p class="description">{{$product->short_text}}</p>
        @endif
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
