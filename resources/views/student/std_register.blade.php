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

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @if(session('index_number'))
                    <div style="margin-top: 20px">
                    Index Number: {{ session('index_number') }}
                    </div>
                    @endif
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                    @if(session('index_number'))
                    <div style="margin-top: 20px">
                    Index Number: {{ session('index_number') }}
                    </div>
                    @endif
                </div>
            @endif

            <label>Index Number</label>
            <input type="text" placeholder="Index Number" pattern="[0-9]{11}" name="index_number"
             title="Enter a valid index number." required>

            <label >Contact Number</label>
            <input type="text" placeholder="Contact Number" pattern="[0-9]{8,11}" name="contact_number" title="Enter a valid number. Ex. 17123456 or 77123456">

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
