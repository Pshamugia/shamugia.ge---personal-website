<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <!-- Include your CSS and JS here -->
    @include('inc/head')
    
    </head>
<body>
    <header>
        <!-- Include navigation and other header content -->
    </header>
    <div class="container">
        @include('inc/nav')
    <main>
        <article>
            <h1>{{ $article->title }}</h1>
            <hr>
            @if($article->photo)
            <img src="{{ asset('public/storage/' . $article->photo) }}" width="400px" alt="$article->title">
        @endif<style>
hr { 
   
    border:1px solid #5a5656;
    
} 
</style>
                     <p> {{ $article->author->name }} {{ $article->author->surname }} &nbsp; |  &nbsp; {{ $article->created_at->format('F j, Y') }}  </p> 
                     
                     <hr>
            <p> {!! $article->full_text !!}</p>
        </article>
    </main>

    <footer>
        <!-- Include footer content -->
    </footer>
</body>
</html>
