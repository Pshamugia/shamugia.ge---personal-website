 
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
            <td>{{ $category->position }}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>

                @if($category->is_hidden)
                    <a href="{{ route('categories.unhide', $category->id) }}" class="btn btn-success">Unhide</a>
                @else
                    <a href="{{ route('categories.hide', $category->id) }}" class="btn btn-secondary">Hide</a>
                @endif

                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

 
