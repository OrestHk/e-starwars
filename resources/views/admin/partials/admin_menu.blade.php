<nav class="row" id="adminMainNav">
    @if(Auth::check())
        <a class="links" href="{{url('/')}}">See site</a>
        <a class="links" href="{{url('admin/product')}}">Edit products</a>
        <a class="links" href="{{url('admin/order')}}">See orders history</a>
        <a class="links" href="{{url('auth/logout')}}">Logout</a>
    @endif
</nav>
