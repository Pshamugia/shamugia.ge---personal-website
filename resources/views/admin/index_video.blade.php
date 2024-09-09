@extends('admin/inc/layout')

@section('content')
<button type="button" class="btn btn-primary btn-lg btn-block" style="border-radius:0px;">
  <a class="nav-link" href="{{ route('admin.create.video') }}">
    Create video
</a>
</button>

@if ($articles->count())
    
<table class="table table-hover table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
            
             

                <!-- Delete Button -->
                <form action="{{ route('admin.destroy', $article->id) }}" method="POST" style="display:inline;">
                    @csrf
       
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>   {{ $article->title }} 
                  @if($article->author)
                      by {{ $article->author->name }}
                  @else
                      (No author assigned)
                  @endif </td>
                <td>  <a href="{{ route('admin.edit', $article->id) }}" class="btn btn-secondary">Edit</a>
                </td>
                <td> @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                </form>  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
       
   

    <!-- Pagination links -->
    {{ $articles->links() }}
@else
    <p>No articles found.</p>
@endif
@endsection
