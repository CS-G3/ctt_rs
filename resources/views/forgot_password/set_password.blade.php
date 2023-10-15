<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('images/gcit_logo.png') }}" alt="User Image">
        
            <h4>Set New Password</h4>

            <div style="font-size: smaller; color: grey; margin-bottom: 20px;" id="info">
                Set a strong new password
            </div>

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('update.password') }}" id="password-reset-form" onsubmit="clearFormFields()">
            @csrf

            <input type="text" placeholder="email" name='email' value="{{ session('email') }}" hidden>

            <label>Password</label>
            <input type="text" placeholder="password" name='Password' required>

            <label>Confirm Password</label>
            <input type="text" placeholder="Confirm Password" name='new_password' required>

            <button type="submit">Update</button>
        </form>
    </div>

    <script>
        function clearFormFields() {
           setTimeout(() => {
            document.getElementById("password-reset-form").reset();
           }, 3000);
        }
    </script>

</body>
</html>
