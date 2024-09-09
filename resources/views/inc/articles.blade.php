<section id="articles">
    @foreach ($articles as $article)
        <div class="project">
            <h3>
                <style> 
                    a { text-decoration: none; } 
              

                </style>

@if($article->category_id == 10) 
<a href="">
    {{ $article->title }}
</a> @else 
                <a href="{{ route('full', ['id' => $article->id, 'title' => Str::slug($article->title)]) }}">
                    {{ $article->title }}
                </a>
                @endif
            </h3>
            
            @if($article->category_id == 10)
            <p>{!! $article->description !!}</p>
            @elseif($article->photo)
                <img src="{{ asset('public/storage/' . $article->photo) }}" alt="Article Photo" 
                     style="max-width: 240px; height: 200px; float: left; margin: 0 15px 0 0;">
             @endif
            <p>{!! nl2br(strip_tags($article->description, '<b><strong>')) !!}</p>
            <p><strong>Author:</strong> {{ $article->author->name }} {{ $article->author->surname }}</p>
        </div>
    @endforeach

    <style>
        /* Styles for the pagination <nav> */
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

        .pagination a {
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
</section>
