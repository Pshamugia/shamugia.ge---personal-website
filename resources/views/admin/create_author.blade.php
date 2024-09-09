<link rel='stylesheet' type='text/css' charset='UTF-8' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'> 
@extends('admin/inc/layout')

@section('content')
<div class="bg-primary text-white p-3 mb-4">
    <h3 class="mb-0">დაამატე ავტორი</h3>
</div>

<form action="{{ route('admin.store.author') }}" method="POST" class="container">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="surname" class="form-label">Surname</label>
        <input type="text" name="surname" id="surname" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Create Author</button>
</form>
@endsection