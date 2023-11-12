<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> <!-- Link to the external CSS file -->
    <style>
        html {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>
</head>
<body  style="display:flex; flex-direction:column; justify-content:start; height:auto;">
    @if ($status)
    <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; width:100%; text-align: center;">
        <span>End Date: {{ $endDate }} | </span>
        <span>Time Remaining: <span id="timeRemaining"></span></span>
    </div>
    @else
    <div style="background-color: rgba(169, 68, 66, 0.4); padding: 20px; width:100%; text-align: center;">
        <span>End Date: {{ $endDate }} | </span>
        <span>Registation Closed</span>
    </div>
    @endif

    <div class="login-container" style="margin-top: 3rem">
        <img src="{{ asset('images/gcit_logo.png') }}" alt="User Image">

        <form method="POST" action="{{ route('students.updateByIndex') }}">
            @csrf
            @method('PUT')

            <h4>Register to CTTRS</h4>

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @if(session('index_number'))
                    <div style="margin-top: 10px">
                    Index Number: {{ session('index_number') }}
                    </div>
                    @endif
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                    @if(session('index_number'))
                    <div style="margin-top: 10px">
                    Index Number: {{ session('index_number') }}
                    </div>
                    @endif
                </div>
            @endif

            <label>Index Number</label>
            <input type="text" placeholder="Index Number" pattern="[0-9]{12}" name="index_number"
             title="Enter a valid index number." required>

            <label>Program</label>
            <select 
            style="width: 100%; padding: 10px; margin: 10px 0px; 
            border: 1px solid #ccc; color:rgb(24, 24, 24); 
            border-radius: 3px;" name="program_applied" required>
                <option disabled selected value="">Select program</option>
                <option value="soc">SOC - Bsc Computer Science</option>
                <option value="sidd">SIDD - Bsc Interactive Design & Development</option>
                <option value="both">SOC & SIDD</option>
            </select>
            

            <div style="width:100%; display:flex; justify-content:right;">
            <a href="https://www.gcit.edu.bt/" style="font-size: 12px;">Learn More</a>
            </div>
            <label >Contact Number</label>
            <input type="text" placeholder="Contact Number" pattern="(975\d{8}|(17|77)\d{6})" name="contact_number" title="Enter a valid number starting with 975, 17 or 77." required>
            @if ($status)
                <button type="submit">Register</button>
                @else
                <button type="submit" disabled>Register</button>
            @endif
        </form>
    </div>

    <script>
        const startDate = new Date("{{ $startDate }}");
        const endDate = new Date("{{ $endDate }}");
        const timeRemainingElement = document.getElementById('timeRemaining');

        function updateTimeRemaining() {
            const timeDiff = endDate - Date.now();

            if (timeDiff <= 0) {
                timeRemainingElement.textContent = 'Registration closed'; // If end date is past current time
                return;
            }

            let seconds = Math.floor((timeDiff / 1000) % 60);
            let minutes = Math.floor((timeDiff / (1000 * 60)) % 60);
            let hours = Math.floor((timeDiff / (1000 * 60 * 60)) % 24);
            let days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));

            const timeRemaining = `${days} days, ${hours} hours, ${minutes} minutes, ${seconds} seconds`;
            timeRemainingElement.textContent = timeRemaining;
        }

        // Calculate and update time remaining initially
        updateTimeRemaining();

        // Update time remaining every second (1000ms)
        setInterval(updateTimeRemaining, 1000);
    </script>

</body>
</html>
