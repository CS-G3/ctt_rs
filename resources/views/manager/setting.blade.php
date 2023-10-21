@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
</head>
<body>

@include('manager.sidebar')

<h2>User</h2>
<form method="POST" action="{{ route('update.user') }}">
    @csrf
    <!-- @method('PUT') -->
    <input type="text" id="id" name="id" value="{{ $user->id }}" required hidden>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
    </div>
    <button type="submit">Update Profile</button>
</form>

@if(auth()->user()->id === $user->id)   
    <form method="POST" action="{{ route('update.password') }}" id="password-reset-form" onsubmit="clearFormFields()">
        @csrf

        <input type="text" placeholder="email" name='email' value="{{ $user->email }}" hidden>

        <label>Password</label>
        <input type="text" placeholder="password" name='Password' required>

        <label>Confirm Password</label>
        <input type="text" placeholder="Confirm Password" name='new_password' required>

        <button type="submit">Update</button>
    </form>

@else

@endif

    <script>
        function clearFormFields() {
           setTimeout(() => {
            document.getElementById("password-reset-form").reset();
           }, 3000);
        }
    </script>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    
    @else
        <p>You are not logged in.</p>
    @endif

</body>
</html>
