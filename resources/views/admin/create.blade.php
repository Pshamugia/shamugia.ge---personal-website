<link rel='stylesheet' type='text/css' charset='UTF-8' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'> 
@extends('admin/inc/layout')

@section('content')
<div class="bg-danger text-white p-3 mb-4">
    <a href="{{ route('admin.create.author') }}" class="text-white">ავტორი</a>
</div>

<form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="container">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>

    <br>
    <div class="mb-3">
        <label for="description" class="form-label">description</label>
        <textarea name="description" id="description" class="form-control" rows="5"></textarea>
        <script>
            CKEDITOR.replace( 'description' );
    </script>
    </div>
    <br>

    <div class="mb-3">
        <label for="full_text" class="form-label">Full Text</label>
        <textarea name="full_text" id="full_text" class="form-control" rows="5" required></textarea>
        <script>
            CKEDITOR.replace( 'full_text' );
    </script>
    </div>
    <br>

    <div class="form-group">
         <select name="category_id" id="category_id" class="form-control" required>
            <option value="" disabled selected>Select Category</option>
             @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
<br>
    <div class="form-group">
         <select name="subcategory" id="subcategory" class="form-control">
            <option value="" disabled selected>გავუშვათ მთავარზე</option>
           
                <option value="1">Yes </option>
                <option value="0">NO </option>
         
        </select>
    </div>

    <br>

    <div class="mb-3">
         <input type="file" name="photo" id="photo" class="form-control">
    </div>

    <div class="mb-3">
         <select name="author_id" id="author_id" class="form-select">
            <option value="" disabled selected hidden>მონიშნე ავტორი</option>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }} {{ $author->surname }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
