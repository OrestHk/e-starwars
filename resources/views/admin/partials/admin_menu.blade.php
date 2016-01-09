
<nav class="row" id="adminMainNav">
    <a class="three columns" href="{{url('/')}}">site public</a>
    @if(Auth::check())
        <a class="three columns" href="{{url('auth/logout')}}">logout</a>
        <a class="three columns" href="{{url('admin/product')}}">administrer les produits</a>
        <a class="three columns" href="{{url('admin/order')}}">voir les commandes</a>
    @endif
</nav>
