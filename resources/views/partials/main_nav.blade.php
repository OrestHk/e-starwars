<nav>
    <a href="{{url('/')}}">Home</a>
    @forelse($categories as $category)
        <a href="{{url('category', $category->id)}}">{{$category->name}}</a>
    @empty
        <a>No category</a>
    @endforelse
    <a href="{{url('/contact')}}">contact</a>
    <a href="{{url('auth/login')}}">login</a>
</nav>
