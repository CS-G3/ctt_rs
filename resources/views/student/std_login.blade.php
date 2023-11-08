<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Login</title>
    <script>
        // dynamic date current year - 14 year before able to select 
        //before that not allowed to select
        document.addEventListener("DOMContentLoaded", function() {
            // Get the current year
            var currentYear = new Date().getFullYear();

            // Calculate the maximum allowed year (e.g., 2010 for currentYear 2024)
            var maxYear = currentYear - 14; // You can adjust this offset as needed

            // Convert the maxYear to a string in 'YYYY-MM-DD' format
            var maxDate = maxYear + "-12-31";

            // Set the max attribute of the date input
            document.getElementById("dateInput").setAttribute("max", maxDate);
        });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('images/gcit_logo.png') }}" alt="User Image">

        <form method="POST" action="{{ route('student.login') }}">
    
            @csrf
            <h4>Login to CTT RS</h4>

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
            
            <label>Index Number</label>
            <input type="text" placeholder="Index Number" name="index_number" pattern="[0-9]{12}" required>

            <label >Date of Birth</label>
            <input type="date" placeholder="Date of Birth" name="date_of_birth" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
