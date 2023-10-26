<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> <!-- Link to the external CSS file -->
    <style>
        /* Add styles for the modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        /* Add styles for the loading spinner */
        .loading-spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #fff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('images/gcit_logo.png') }}" alt="User Image">
        
        <form id="otpForm" method="POST" action="{{ route('otp') }}">
            @csrf
            <h4>Forgot Password</h4>

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif

            <div style="font-size: smaller; color: grey; margin-bottom: 20px;" id="info">
                An one-time password would be sent to your email.
            </div>

            <label>Email</label>
            <input type="text" placeholder="Email" name='email' required>
            <button type="submit" id="submitBtn">Get OTP</button>
        </form>

        <a href="/login" style="font-size:12px; text-decoration: none">Back</a>

    </div>

    <!-- Add the modal for "Please Wait" -->
    <div id="loadingModal" class="modal">
        <div class="loading-spinner"></div>
    </div>

    <script>
        
        // Function to show the modal with the loading spinner
        function showLoadingModal() {
            document.getElementById("loadingModal").style.display = "flex";
        }

        // Function to hide the modal
        function hideLoadingModal() {
            document.getElementById("loadingModal").style.display = "none";
        }

        // Add an event listener to the form to handle submission
        document.getElementById("otpForm").addEventListener("submit", function(event) {
            // event.preventDefault(); // Prevent the default form submission behavior

            // Show the loading modal when the form is submitted
            showLoadingModal();

            const hasSuccessMessage = "{{ Session::has('success') }}";
            const hasErrorMessage = "{{ Session::has('error') }}";

            if (hasSuccessMessage || hasErrorMessage) {
                hideLoadingModal();
            }

        });
    </script>
</body>
</html>
