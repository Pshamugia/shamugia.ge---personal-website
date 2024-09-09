<nav>
    <h1><a href="{{ route('index') }}"> <img src="{{ asset('public/img/Paata_Shamugia.jpg') }}" class="img-fluid"></a></h1>
 

    <!-- Hamburger Menu Icon -->
    <div class="hamburger">&#9776;</div>

    <ul>
        <li><a href="{{ route('index') }}">Home</a></li>
        @foreach($categories as $category)
            <li><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
        @endforeach
        <li><a href="{{ route('contact') }}">Contact</a></li>

        
    </ul>

    <form action="{{ route('search') }}" method="GET" class="d-none d-md-block">
       @csrf
        <input  type="search" name="title" placeholder="Search" value="{{ request()->get('title') }}" aria-label="Search">
       </form>
</nav>
