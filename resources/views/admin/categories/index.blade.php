@extends('admin/inc/layout')

@section('content')
<button type="button" class="btn btn-primary btn-lg btn-block" style="border-radius:0px;">
    <a class="nav-link" href="{{ route('admin.create.category') }}">
        Create category
    </a>
</button>

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>
                <a href="{{ route('admin.categories.moveUp', $category->id) }}" class="btn btn-primary">↓</a>
                <a href="{{ route('admin.categories.moveDown', $category->id) }}" class="btn btn-primary">↑</a>
            </td>
            
            <td>
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>

                @if($category->is_hidden)
                    <a href="{{ route('admin.categories.unhide', $category->id) }}" class="btn btn-success">Unhide</a>
                @else
                    <a href="{{ route('admin.categories.hide', $category->id) }}" class="btn btn-secondary">Hide</a>
                @endif

                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
