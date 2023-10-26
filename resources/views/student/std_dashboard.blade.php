<!DOCTYPE html> <html lang="en"> <head>
<meta charset="UTF-8"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Student dashboard
</title>
<link rel="stylesheet" href="{{ asset('css/login.css') }}"> 
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head> 

<body style="display:flex; flex-direction:column; justify-content:start; height:auto;">  

<div style="background:#fff; padding:10px 0px 10px 0px; width: 100%; display: flex; justify-content: space-between; align-items: center;">
    <span style="padding-left: 10px;">Welcome, {{ $student->index_number }}.</span>
    <form id="logout-form" action="{{ route('student.logout') }}" method="POST">
        @csrf
        <button type="submit" style="border: none; background-color: transparent; color: rgba(220, 20, 60, 0.8); cursor: pointer; margin-right: 20px;">
            <span class="material-symbols-outlined">
                logout
            </span>
        </button>
    </form>
</div>

    @if(session('student_id')) 
    
        <div class="dashboard-container"> 
            
        @if(Session::has('success')) 
            <div class="alert
            alert-success"> {{ Session::get('success') }} 
            @if(session('index_number')) 
            <div style="margin-top: 20px"> Index
            Number: {{ session('index_number') }} </div>
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

    <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom:20px; display:flex;
    flex-direction:column; justify-content:flex-start; align-items:start;"
    >
    <div style="display: flex; align-items: end;">
    <span class="material-symbols-outlined">person</span>
    <span style="font-size: 16px; margin-left: 15px;"> Name: {{ $student->name }}</span>

    </div>
    <div style="margin: 15px 0px 15px 0px; display: flex; align-items: end;">
    <span class="material-symbols-outlined">numbers</span>
    <span style="font-size: 16px; margin-left: 15px;">
    Index Number: {{ $student->index_number }}
    </span>
    </div>

    <div style="margin: 0px 0px 15px 0px; display: flex; align-items: end;">
        <span class="material-symbols-outlined">trophy</span>
        <span style="font-size: 16px; margin-left: 15px;">Rank {{ $student->rank }} / 12345</span>
    </div>

    <div style=" display: flex; align-items: end;">
        <span class="material-symbols-outlined">priority</span>
        <span style="font-size: 16px; margin-left: 15px;">Status: you are shortlisted </span>
    </div>

    </div>

    <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom:20px; display:flex; justify-content: space-around; align-items: center;">
    <span class="material-symbols-outlined"> description </span> 

    <div>
        <p>Stream</p> 
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
            <p>{{ strtoupper($subjectCode) }}</p>
            <p>{{ $subjectValue }}</p>
        </div>
        @endif
    @endforeach

    @if ($student->supw !== null)
    <div>
        <p>SUPW</p>
        <p>{{ strtoupper($student->supw) }}</p>
    </div>
    @endif

    </div>

    <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom: 20px; display: flex;
        justify-content: space-around; align-items: center;"> 
        <span class="material-symbols-outlined">
        info
        </span>
        <label style="font-size: 16px; margin-left: 5px;">Contact Number:</label>

        <form method="POST" action="{{ route('student.update', ['id' => $student->id])}}" style="display: flex;
        flex-direction: row; align-items: center;">
        @csrf
        @method('PUT')

        <!-- Input fields for updating the contact number -->
        <input type="text" name="contact_number" value="{{ old('contact_number', $student->contact_number) }}"
        pattern="^\d{8}$" title="Enter a valid phone number. Ex. 17123456 or 77123456"
        style="width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 3px;"
        id="contactNumberInput">

        <button type="submit"
            style="display: none; padding: 10px 20px; background-color: #73AF42; color: #fff; border: none; border-radius: 3px; cursor: pointer; margin: 10px;"
            id="saveButton">Save</button>
        </form>

        <label style="font-size: 16px; margin-left: 5px;">Placement:</label>

        <form method="POST" action="{{ route('student.updatePlacement', ['id' => $student->id])}}" style="display: flex;
        flex-direction: row; align-items: center;">
        @csrf
        @method('PUT')

        <select name="placement_id" id="placementSelect"
            style="padding: 10px 0px 10px 0px; border: 1px solid #ccc; border-radius: 3px;"
            >
            <option value="" @if($student->placement_id === null) selected @endif>Choose your placement</option>
            @foreach($placement as $item)
            <option value="{{ $item->id }}" @if($student->placement_id == $item->id) selected @endif>
                {{ $item->location }} (ID: {{ $item->id }})
            </option>
            @endforeach
        </select>
    
            <button id="saveButton2" type="submit"
            style="padding: 10px 20px; background-color: #73AF42; color: #fff; border: none; border-radius: 3px; cursor: pointer; margin: 10px; display:none;">
            Save</button>
        </form>

        </div>

    </div>

    @else
    <p>You are not logged in.</p>
    @endif

<script>
    const contactNumberInput = document.getElementById('contactNumberInput');
    const saveButton = document.getElementById('saveButton');

    // Listen for changes in the contact number input
    contactNumberInput.addEventListener('input', () => {
        // If the input value changes, show the "Save" button
        saveButton.style.display = 'inline-block';
    });

    // Get a reference to the select element and the save button
    const placementSelect = document.getElementById('placementSelect');
    const saveButton2 = document.getElementById('saveButton2');

    // Add an event listener to the select element
    placementSelect.addEventListener('change', function () {
        // When the select changes, show the "Save" button
        saveButton2.style.display = 'block';
    });
</script>

</body>

</html>