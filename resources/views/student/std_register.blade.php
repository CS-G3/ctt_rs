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

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
