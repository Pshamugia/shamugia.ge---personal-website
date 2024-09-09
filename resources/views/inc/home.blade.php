<section id="articles">
   
    @foreach ($articles as $article)
     <div class="project" class="display-4">    
      
       {!! nl2br(strip_tags($article->full_text, '<b><strong>')) !!} 

 </div>
    @endforeach
 
   <style> /* Styles for the pagination <nav> */
    .pagination-nav {
        background-color: #fff;
        padding: 10px;
        font-size: 14px; 
    }
    
    .pagination-nav .pagination {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .pagination-nav .pagination li {
        display: inline;
        margin-right: 5px;
        
    }
    
    .pagination-nav .pagination a, .pagination-nav .pagination span {
        padding: 5px 10px;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #555;
        height: 30px;
        width: 30px;
        margin-top: -5px;
        font-size: 14px;
        
       
    }
    .pagination a
    { 
        padding: 5px 10px !important;
    }
    
    .pagination-nav .pagination .active span {
        background-color: #ddd;
        
    }
    
    .pagination-nav .pagination .disabled span {
        color: #aaa;
        
    }
    
  </style>
        {{ $articles->links() }}  

 
        <span style="position:relative; top:15px;"> &copy; shamugia.ge </span>


</section>