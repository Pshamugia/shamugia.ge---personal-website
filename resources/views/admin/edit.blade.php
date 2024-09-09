 
@extends('admin/inc/layout')

@section('content')

<div class="container">
    <h1>Edit Article</h1>

    <form action="{{ route('admin.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $article->title }}" required>
        </div>

        <br>
        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <textarea class="form-control" name="description" id="description">{{ $article->description }}</textarea>
            <script>
                CKEDITOR.replace( 'description' );
        </script>
         </div>

<br>

        <div class="mb-3">
            <label for="full_text" class="form-label">Full Text</label>
            <textarea class="form-control" name="full_text" id="full_text" required>{{ $article->full_text }}</textarea>
            <script>
                CKEDITOR.replace( 'full_text' );
        </script>
         </div>

        <div class="mb-3">
            <label for="author_id" class="form-label">Author</label>
            <select class="form-select" name="author_id" id="author_id" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $author->id == $article->author_id ? 'selected' : '' }}>
                        {{ $author->name }} {{ $author->surname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $article->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <br>

        <div class="form-group">
            <select name="subcategory" id="subcategory" class="form-control">
                <option value="" disabled>გავუშვათ მთავარზე</option>
                <option value="1" {{ $article->subcategory == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ $article->subcategory == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        
        <br>

        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control" name="photo" id="photo">
            @if($article->photo)
                <img src="{{ asset('storage/' . $article->photo) }}" alt="Current Photo" style="max-width: 100px; margin-top: 10px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Article</button>
    </form>
</div>
 
@endsection