@if(Auth::check())   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/login.css') }}"> Link to the external CSS file -->
</head>
<body>
@include('sidebar')

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
                <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary">Edit</a>
                <!-- <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">Edit</a> -->
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

@else
    <p>You are not logged in.</p>
@endif

</body>
</html>
