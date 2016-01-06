<div class="menu">
    <div class="menu-1"></div>
    <div class="menu-2"></div>
    <div class="menu-3"></div>
    <div class="menu-4"></div>
</div>
<nav class="main-menu">
    <ul class="main first-main">
        <li><a href="{{url('/')}}">Home</a></li>
        <li><a href="{{url('/categories/helmets/')}}">Helmets</a></li>
        <li><a href="{{url('/categories/lasers/')}}">Lasers</a></li>
    </ul>
    @if($allTags)
    <ul class="tags">
        @foreach($allTags as $tag)
            <li><a href="{{url('tags/'.$tag->slug)}}" class="{{$tag->slug}}">{{$tag->name}}</a></li>
        @endforeach
    </ul>
    @endif
    <ul class="main second-main">
        <li><a href="{{url('contact/')}}">Contact us</a></li>
        <li><a href="{{url('legal/')}}">Legal</a></li>
    </ul>
</nav>
