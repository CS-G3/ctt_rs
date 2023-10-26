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

<form method="POST" action="{{ route('update.user') }}" class="pl-5" id="user-update-form">
    @csrf
    <!-- @method('PUT') -->
    <input type="text" id="id" name="id" value="{{ $user->id }}" required hidden>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        <br>
        <button type="submit" id="user-update-button" style="display: none;">Update</button>

</form>

<hr>

@if(auth()->user()->id === $user->id)   

<h6>Password</h6>

    <form method="POST" action="{{ route('update.password') }}" id="password-reset-form" onsubmit="clearFormFields()" class="pl-5">
        @csrf

        <input type="text" placeholder="email" name='email' value="{{ $user->email }}" hidden>

        <label>Password</label>
        <input type="password" placeholder="Password" name='Password' required>

        <label>Confirm Password</label>
        <input type="password" placeholder="Confirm Password" name='new_password' required>

        <br>
        <button type="submit" id="password-update-button" style="display: none;">Update</button>
    </form>
</div>
    
    @else
        <p></p>
    @endif
    
@else

@endif

  <script>
    // Add event listeners to detect changes in the email, name, and password fields
    const userUpdateForm = document.getElementById("user-update-form");
    const userUpdateButton = document.getElementById("user-update-button");
    const passwordUpdateButton = document.getElementById("password-update-button");

    // For username and email fields
    userUpdateForm.addEventListener("input", function () {
        userUpdateButton.style.display = "block";
    });

    // For password fields
    const passwordFields = document.querySelectorAll("#password-reset-form input[type='text']");
    passwordFields.forEach((field) => {
        field.addEventListener("input", function () {
            passwordUpdateButton.style.display = "block";
        });
    });

    function clearFormFields() {
        setTimeout(() => {
            document.getElementById("password-reset-form").reset();
        }, 3000);
    }
</script>
</body>
</html>
