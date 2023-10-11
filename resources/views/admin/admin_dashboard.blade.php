<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> Link to the external CSS file -->
</head>
<body>

@include('sidebar') <!-- Include the sidebar partial -->

<div>admin dashboard</div>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    
    <div>add users</div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}" required autofocus>
        <input type="email" name="email" value="{{ old('email') }}" required>
        <input type="password" name="password" required>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Register</button>
    </form>

    <table>
    <thead>
    <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Created On</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                <button>Edit</button>
                <form action="{{ route('user.delete', $user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>


    <!-- @if(Auth::check())
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <p>You are not logged in.</p>
    @endif -->

    <script>
        // // JavaScript code to redirect after logout and disable caching
        // document.getElementById('logout-form').addEventListener('submit', function() {
        //     window.location.href = "{{ route('login') }}";
        // });
        
        // // Disable caching for this page
        // window.onload = function() {
        //     window.history.pushState({}, document.title, "{{ route('login') }}");
        // };
    </script>

</body>
</html>
