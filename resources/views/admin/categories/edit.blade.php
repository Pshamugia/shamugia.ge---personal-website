<!DOCTYPE html>
<html lang="en">
<head>
    @include('inc/head')
</head>
<body>
<div class="container">
    @include('inc/nav')

    <main>
        <h2>Edit Category</h2>

        <!-- Form to edit the category -->
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="position">Position:</label>
                <input type="number" name="position" value="{{ $category->position }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </main>
</div>
</body>
</html>
