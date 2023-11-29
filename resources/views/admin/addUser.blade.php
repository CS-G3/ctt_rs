@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}"> <!-- Link to the external CSS file -->
</head>
<body class="d-flex bg-secondary">

@include('admin.sidenav')

<div class="bg-light ml-1 p-4 w-100">
    <a href="/admin/dashboard">Back</a>
    <hr>
    <h3>Add User</h3>
    <div style="padding: 0 20% 0 20%">
    
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

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Name">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Email">
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required>
        
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
        <br><br>
        <button type="submit">Register</button>
    </form>
    </div>
</div>

@endif

</body>
</html>
