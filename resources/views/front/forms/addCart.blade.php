{!! Form::open(['url' => '','id' => 'addcart']) !!}
<div class="form-content">
    {!! Form::label('quantity','Quantity :',['for'=>'quantity']) !!}
    {!! Form::hidden('product_id', $product->id) !!}
    <div class="container-btn select">
        {!! Form::select('quantity',array(
            '1'=>'1',
            '2'=>'2',
            '3'=>'3',
            '4'=>'4',
            '5'=>'5'
        ), null, ['class' => 'btn'])!!}
        <div class="top"></div>
        <div class="right"></div>
        <div class="bot"></div>
        <div class="left"></div>
    </div>
    <div class="container-btn">
        {!! Form::submit('Add to cart', ['class' => 'btn']) !!}
        <div class="top"></div>
        <div class="right"></div>
        <div class="bot"></div>
        <div class="left"></div>
    </div>
</div>
{!! Form::close() !!}
