<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('images/gcit_logo.png') }}" alt="User Image">

        <form method="POST" action="{{ route('students.updateByIndex') }}">
            
            @csrf
            @method('PUT')

            <h4>Register to CTT RS</h4>

            <label>Index Number</label>
            <input type="text" placeholder="Index Number" pattern="[0-9]{12}"
             title="Enter a valid index number." required>

            <label >Contact Number</label>
            <input type="text" placeholder="Contact Number" pattern="[0-9]{8,11}" title="Enter a valid number. Ex. 17123456 or 77123456">

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
