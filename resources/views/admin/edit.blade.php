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

<div class="bg-light ml-1 p-4 w-100" style="  height: 100vh;
    overflow: auto;
    border: 1px solid #ccc;">

    @if(auth()->user()->id === $user->id)
        <h2>Setting</h2>
    @else
        <a href="/admin/dashboard">Back</a>
        <hr>
        <h2>Edit User</h2>
    @endif

<hr>

<h6>Username & Email</h6>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

<form method="POST" action="{{ route('user.updateNameEmailPassword') }}" class="pl-5">
    @csrf
    <input type="text" id="id" name="id" value="{{ $user->id }}" required hidden>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        <br>

        @if(auth()->user()->id !== $user->id)   
        <button type="submit">Update</button>
        </form>
        @endif

<hr>

@if(auth()->user()->id === $user->id)   

<h6>Password</h6>

        <label>Current Password</label>
        <input type="password" placeholder="Password" name='current_password'>  
        
        <label>New Password</label>
        <input type="password" placeholder="Password" name='confirm_password'>

        <label>Confirm Password</label>
        <input type="password" placeholder="Confirm Password" name='new_password'>

        <br>
        <button type="submit">Update</button>
    </form>
</div>
    
    @else
        <p></p>
    @endif
    
@else

@endif
</body>
</html>
