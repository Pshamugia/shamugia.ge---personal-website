<!DOCTYPE html>
<html lang="en">
<head>
 
    @include('inc/head')

</head>
<div class="container">
    @include('inc/nav')
     <main> 
<h2> Search results </h2>
<p> @if ($search_count>0)
    We have {{ $search_count }}
    
    @if ($search_count==1)

    result for <b><i> {{ $searchTerm }} </i></b>

    @else


    results for <b><i> {{ $searchTerm }} </i></b>
    @endif
    @else

    {{ "Hmmmm, we could not find any matches for"}} 
    <span style="background-color: red !important, color:white"> 
        <b><u> {{ $searchTerm }} </u></b> </span>

    @endif

</p>
<hr>
        @foreach ($articles as $article)
       
       
            <a href="{{ route('full', ['id' => $article->id, 'title' => Str::slug($article->title)]) }}">
                <h2 style="padding-top: 10px; font-size: 16px">     {{ $article->title }}    </h2>
            </a>
         <!-- Display the category name -->
    
        @endforeach
        {{ $articles->links() }}

      </main>
 </div>