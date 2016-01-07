{!! Form::open(['url' => '','id' => 'addcart']) !!}
<div class="form-content">
    {!! Form::label('quantity','Quantity :',['for'=>'quantity']) !!}
    {!! Form::hidden('product_id', $product->id, ['id' => 'product_id']) !!}
    <div class="container-quantity">
        <div class="container-btn quantity less">
            <p class="btn">-</p>
            <div class="top"></div>
            <div class="right"></div>
            <div class="bot"></div>
            <div class="left"></div>
        </div>
        <div class="container-btn">
            {!! Form::text('quantity', 0, ['id' => 'quantity', 'class' => 'btn', 'maxlenght' => '2']) !!}
            <div class="top"></div>
            <div class="right"></div>
            <div class="bot"></div>
            <div class="left"></div>
        </div>
        <div class="container-btn quantity more">
            <p class="btn">+</p>
            <div class="top"></div>
            <div class="right"></div>
            <div class="bot"></div>
            <div class="left"></div>
        </div>
    </div>
    <div class="container-btn">
        {!! Form::submit('Add to cart', ['class' => 'btn','name' => 'order']) !!}
        <div class="top"></div>
        <div class="right"></div>
        <div class="bot"></div>
        <div class="left"></div>
    </div>
</div>
{!! Form::close() !!}
<div id="successAddInCart" style="display:none">
    <h2>add to cart</h2>
</div>
