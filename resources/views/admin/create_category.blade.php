 
 @extends('admin/inc/layout')

 @section('content')

<div class="container">
    <h2>Add Category</h2>
    <form action="{{ route('admin.store.category') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
</div>

@endsection
 
