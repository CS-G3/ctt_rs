<!DOCTYPE html> <html lang="en"> <head>
<meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Student dashboard
</title>
<link rel="stylesheet" href="{{ asset('css/login.css') }}"> 
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<style>
    html {
    max-width: 100%;
    overflow-x: hidden;
}
</style>
</head> 

<body style="display:flex; flex-direction:column; justify-content:start; height:auto;">  

<style>
    @media only screen and (max-width: 600px) {
        /* Adjustments for smaller screens */
        #myContainer {
            flex-direction: column;
            align-items: flex-start;
            padding: 10px;
        }

        #mySpan {
            padding-left: 0;
            margin-bottom: 10px;
            text-align: center;
        }

        #myImg {
            width: 100%;
            height: auto;
        }

        #myForm {
            margin-top: 10px;
        }

        #myButton {
            margin-right: 0;
        }
    }
</style>

<div id="myContainer" style="background:#fff; padding:10px 0px 10px 2rem; width: 100%; display: flex; justify-content: space-between; align-items: center;">
    <span id="mySpan" style="padding-left: 10px;">
        <img id="myImg" src="{{ asset('images/gcit_logo.png') }}" alt="GCIT logo" style="width: 50%; height:auto;">
    </span>

    <div style="display:flex; flex-direction:column;">
        <div style="font-weight: bold; text-align:center;
                font-size: 24px; margin-right:3rem;
                color: #333;">
            CTT RS Student Dashboard
        </div>
        <div style="font-weight: normal; text-align:center;
                font-size: 16px; margin-right:3rem;
                color: #333;">
            (Computational Thinking Test Ranking System)
        </div>
    </div>

    <form id="myForm" action="{{ route('student.logout') }}" method="POST">
        @csrf
        <button id="myButton" type="submit" style="border: none; background-color: transparent; color: rgba(220, 20, 60, 0.8); 
        cursor: pointer; margin-right: 20px;  display: flex; align-items: center;">
            <span class="material-symbols-outlined">
                logout
            </span>
            <span style="margin-left: 0.5rem; margin-right:2rem">Logout</span>
        </button>
    </form>
</div>

@if ($status != null)
    <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; width:100%; text-align: center; font-size:12px;">
        <span>End Date: {{ $endDate }} | </span>
        <span>Time Remaining: <span id="timeRemaining"></span></span>
    </div>
    @else
   
    @endif

    @if(session('student_id')) 
        <div class="dashboard-container"> 

        <div style="font-weight: bold;
            font-size: 18px;
            color: #333; margin-bottom: 1rem;">
            Student Information
        </div>
            
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="display: flex; justify-content: space-between; align-items: center;">
        <div></div>    
        <div>
            {{ Session::get('success') }}
        </div>
        <span class="close" style="cursor: pointer;" onclick="this.parentElement.style.display='none';" aria-label="Close">
            <span class="material-symbols-outlined" style="font-size: 1.25rem;">close</span>
        </span>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ Session::get('error') }}
        <span class="close" style="cursor: pointer;" onclick="this.parentElement.style.display='none';" aria-label="Close">
            <span class="material-symbols-outlined" style="font-size: 1.25rem;">close</span>
        </span>
    </div>
@endif

    <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom:5px; display:flex;
    flex-direction:column; justify-content:flex-start; align-items:start;"
    >
    <div style="display: flex; align-items: end; margin-left:1rem;">
    <span class="material-symbols-outlined">person</span>
    <span style="font-size: 16px; margin-left: 15px;"> <span style="font-weight:bold;">Name:</span> {{ $student->name }}</span>

    </div>
    <div style="margin: 15px 0px 15px 0px; display: flex; align-items: end; margin-left:1rem;">
    <span class="material-symbols-outlined">numbers</span>
    <span style="font-size: 16px; margin-left: 15px;">
    <span style="font-weight:bold;">Index Number:</span> {{ $student->index_number }}
    </span>
    </div>

    <div style="margin: 0 0 15px 0; display: flex; align-items: end; margin-left:1rem;">
        <span class="material-symbols-outlined">trophy</span>
        <span style="font-size: 16px; margin-left: 15px;">
            <span style="font-weight:bold;">SOC Rank:</span>
            {{ $student->rank !== null && $student->rank !== '' &&
            $student->rank !== 0 ? $student->rank : '-' }}
        </span>
        
        <span style="font-size: 16px; margin-left: 15px;">
            <span style="font-weight:bold;">SIDD Rank:</span>
            {{ $student->rankSIDD !== null && $student->rankSIDD !== '' &&
            $student->rankSIDD !== 0 ? $student->rankSIDD : '-' }}
        </span>

    </div>

    <div style=" display: flex; align-items: end; margin-left:1rem;">
        <span class="material-symbols-outlined">priority</span>
        <span style="font-size: 16px; margin-left: 15px;">
        <span style="font-weight:bold;">SOC Status:</span>
        @if ($student->rank != null && ($student->rank < $total_intake))
            Shortlisted
        @elseif (!$student->rank)
            Not ranked
        @else
            Not shortlisted
        @endif
        </span>

        <span style="font-size: 16px; margin-left: 15px;">
        <span style="font-weight:bold;">SIDD Status:</span>
        @if ($student->rankSIDD != null && ($student->rankSIDD < $total_intake))
            Shortlisted
        @elseif (!$student->rankSIDD)
            Not ranked
        @else
            Not shortlisted
        @endif
        </span>
    </div>

    </div>

    <div style="margin-bottom:15px; color:grey; font-size:12px; text-align:start;">
        *the rank and status may be subject to change while the registration period is open.
    </div>

    <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom:20px;
     display:flex; justify-content: space-between; align-items: center;">

    <div style=" margin-left: 1rem">
        <p style="font-weight:bold;">Stream</p> 
        <p>{{ strtoupper($student->stream) }}</p> 
    </div>

    @php
    $studentData = [
        'dzo' => $student->dzo,
        'com' => $student->com,
        'acc' => $student->acc,
        'bmt' => $student->bmt,
        'geo' => $student->geo,
        'his' => $student->his,
        'eco' => $student->eco,
        'med' => $student->med,
        'bent' => $student->bent,
        'evs' => $student->evs,
        'rige' => $student->rige,
        'agfs' => $student->agfs,
        'mat' => $student->mat,
        'phy' => $student->phy,
        'che' => $student->che,
        'bio' => $student->bio
    ];
    @endphp

    @foreach ($studentData as $subjectCode => $subjectValue)
        @if ($subjectValue !== null)
        <div>
            <p style="font-weight:bold;">{{ strtoupper($subjectCode) }}</p>
            <p>{{ $subjectValue }}</p>
        </div>
        @endif
    @endforeach

    @if ($student->supw !== null)
    <div  style=" margin-right: 1rem">
        <p style="font-weight:bold;">SUPW</p>
        <p>{{ strtoupper($student->supw) }}</p>
    </div>
    @endif

    </div>

    <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom: 20px;">

    <form method="POST" action="{{ route('student.updatePlacement', ['id' => $student->id])}}"
        style="display: flex; flex-direction: column; align-items: center; justify-content: space-between; margin-top: 1rem; width:100%">
        @csrf
        @method('PUT')

        <label style="font-size: 16px; margin-bottom: 0.5rem; align-self: flex-start; margin-left:10px;">Contact Number:</label>

        <input type="text" name="contact_number" value="{{ old('contact_number', $student->contact_number) }}"
            pattern="(975\d{8}|(17|77)\d{6})"
            title="Enter a valid phone number. Ex. 17123456 or 77123456"
            style="padding: 10px; border: 1px solid #ccc; border-radius: 3px; width: 95%;"
            id="contactNumberInput">

        <label style="font-size: 16px; margin-top: 1rem; margin-bottom: 0.5rem; align-self: flex-start; margin-left:10px;">Placement:</label>

        <select name="placement_id" id="placementSelect"
            style="padding: 10px 0; border: 1px solid #ccc; border-radius: 3px; width: 98%;">
            <option value="" @if($student->placement_id === null) selected @endif>Choose your placement</option>
            @foreach($placement as $item)
            <option value="{{ $item->id }}" @if($student->placement_id == $item->id) selected @endif>
                {{ $item->location }}
            </option>
            @endforeach
        </select>

        <button id="saveButton2" type="submit"
        style="padding: 10px 20px; background-color: #73AF42; color: #fff;
         border: none; border-radius: 3px; cursor: pointer; margin: 10px; width: 20%; align-self: flex-end;">
        Save</button>
    </form>

</div>

    @if($student->placement_id !== null)
    <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom: 20px; text-align: left;">
        <div style="margin-left: 1rem">
            <strong>Placement:</strong>
            @foreach($placement as $item)
                @if($student->placement_id == $item->id)
                {{ $item->location }}
                @endif
            @endforeach
        </div>
        <div style="margin-left: 1rem; margin-top: 1rem;">
        <strong>Date:</strong>
        {{ \Carbon\Carbon::parse($item->time)->format('Y-m-d') }}
        </div>
        <div style="margin-left: 1rem; margin-top: 1rem;">
        <strong>Time:</strong>
        {{ \Carbon\Carbon::parse($item->time)->format('h:i A') }}
        </div>
        <div style="margin-left: 1rem; margin-top: 1rem;">
            All the best for GCIT Computational Thinking Test (CTT).
        </div>
        
    </div>
    @endif

    <div style="font-size: 16px;
        color: #333; margin-bottom: 1rem;">
        &copy GCIT CTTRS {{ now()->format('Y') }}
    </div>
    
    @else
    <p>You are not logged in.</p>
    @endif

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