<!DOCTYPE html>
<html lang="en">
<head>
 
    @include('inc/head')

</head>
<div class="container">
    @include('inc/nav')
     <main> 

        @if (!empty($category->id))
          <h2>   
       
        {{ $category->name }}</h2> <!-- Display the category name -->

        @endif
      @include('inc/articles')

      </main>
 </div>