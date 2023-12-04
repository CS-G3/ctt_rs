@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/components.css') }}"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="d-flex bg-secondary">

@include('admin.sidenav')

<div class="bg-light ml-1 p-4 w-100">

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ Session::get('success') }}
        <span class="close" style="cursor: pointer;" onclick="this.parentElement.style.display='none';" aria-label="Close">
            <span class="material-symbols-outlined" style="font-size: 1.25rem;">close</span>
        </span>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ Session::get('error') }}
        <span class="close" style="cursor: pointer;" onclick="this.parentElement.style.display='none';" aria-label="Close">
            <span class="material-symbols-outlined" style="font-size: 1.25rem;">close</span>
        </span>
    </div>
@endif

<div style="display:flex; justify-content:center;">

    <form action="{{ url('/admin/search') }}" method="GET" class="w-75 d-flex">
        @csrf
        <input type="text" name="search" placeholder="Search"
        value="{{ old('search', request('search')) }}"
        style="border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;" class="w-100">
        <button>Search</button>
    </form>

  <button id="addUserButton" style="
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 3px;
    margin-left: 2rem;">
    Add User
</button>

</div>

<hr>

<div style="max-height: 70vh; overflow-y: auto;">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created On</th>
                <th style="text-align:center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td class="d-flex justify-content-around">
                        <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-secondary btn-sm">
                            <span class="material-symbols-outlined">edit</span>
                        </a>

                        <form id="deleteForm{{ $user->id }}" action="{{ route('user.delete', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-button"
                                    data-user-id="{{ $user->id }}">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<dialog id="deleteDialog" class="bg-light p-4" style="border-radius: 10px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <p style="font-size: 16px; margin-bottom: 20px;">Are you sure you want to delete this user?</p>
    <button id="confirmDelete" style="background-color: #dc3545; color: #fff; border: none; padding: 8px 16px; margin-right: 10px; border-radius: 5px; cursor: pointer;">Yes, delete</button>
    <button id="cancelDelete" style="background-color: #ddd; color: #333; border: none; padding: 8px 16px; border-radius: 5px; cursor: pointer;">Cancel</button>
</dialog>

@else
<p>You are not logged in.</p>
@endif

</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#addUserButton').click(function () {
            window.location.href = "{{ url('/admin/add-user') }}";
        });

        // Show the dialog on button click
        $('.delete-button').click(function () {
            var userId = $(this).data('user-id');
            var dialog = document.getElementById('deleteDialog');

            // Set up event listeners for the dialog buttons
            document.getElementById('confirmDelete').onclick = function () {
                $('#deleteForm' + userId).submit();
                dialog.close();
            };

            document.getElementById('cancelDelete').onclick = function () {
                dialog.close();
            };

            dialog.showModal();
        });
    });
</script>

</body>
</html>
