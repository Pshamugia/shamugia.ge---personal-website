<!-- resources/views/admin.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script>
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

    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div style="background-color: #212529; height: 40px; color:#fff"><p> Shamugia.ge </p></div>
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
               
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.index') }}">
                                Dashboard
                            </a>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.create.author') }}">
                               Authors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                                Categories
                            </a>
                        </li>
 
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index_video') }}">
                                Video
                            </a>
                        </li>
                       
                        <li class="nav-item"> 
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">
                            Logout
                        </a> </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content') <!-- This is where the content of each page will be injected -->
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
