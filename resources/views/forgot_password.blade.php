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
        <form id="forgotPasswordForm">
            <h4>Forgot Password</h4>

            <div style="font-size: smaller; color: grey;" id="info">
                An one-time password would be sent to your email.
            </div>

            <label>Email</label>
            <input type="text" placeholder="Email" required>

            <!-- <div id="helloDiv">
                hello
            </div>

            <div id="hiDiv" style="display: none;">
                hi
            </div> -->

            <button type="submit">Get OTP</button>
        </form>
    </div>

    <script>
        document.getElementById("forgotPasswordForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission behavior
            
            // Get references to the "hello" and "hi" divs
            var helloDiv = document.getElementById("helloDiv");
            var hiDiv = document.getElementById("hiDiv");
            
            // Hide the "hello" div and show the "hi" div
            helloDiv.style.display = "none";
            hiDiv.style.display = "block"; // or "inline" depending on your desired display type
            
            // Get the reference to the "info" div
            var infoDiv = document.getElementById("info");
            
            // Change the text content
            infoDiv.textContent = "Please check your email for the one-time password.";
        });
    </script>
</body>
</html>
