<header>
    <div class="content">
        @include('front.partials.menu')
        <a href="{{url('/')}}" title="Kuar's resell"><h1>
            <span class="name name-1">Kuar's</span>
            <img src="{{asset('assets/images/logo.png')}}" alt="Logo" />
            <span class="name name-2">Resell</span>
        </a></h1>
        @include('front.partials.cart')
    </div>
</header>
