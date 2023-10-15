<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> <!-- Link to the external CSS file -->
    <link href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css" rel="stylesheet">
</head>
<body style="display:flex; flex-direction:column">

    <div style=" position: fixed; background:#fff; padding:10px;
    top: 0;
    left: 0;
    width: 100%; display:flex; justify-content:space-between;">
        Welcome, {{ $student->index_number }}.     
        <form id="logout-form" action="{{ route('student.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
        </form>
    </div>
    @if(session('student_id'))

    <div class="dashboard-container">
        student dashboard
        <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom:20px; display:flex; justify-content: space-around;"
        >
        Name: {{ $student->name }}
        <div>
        Index Number: {{ $student->index_number }}
        </div>
        </div>

        <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom:20px; display:flex; justify-content: space-between;"
        >
        <span class="mdi mdi-file-document-outline"></span>
        <p>Stream {{ $student->stream }}</p>
        <p>English {{ $student->eng }}</p>
        <p>Dzongkha {{ $student->dzo }}</p>
        <p>Physics {{ $student->phy }}</p>
        <p>Chemistry {{ $student->che }}</p>
        <p>Math {{ $student->mat }}</p>
        <p>SUPW {{ $student->supw }}</p>
        </div>

        <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom:20px;"
        >
        <i class="mdi mdi-trophy-outline"></i>
        Rank {{ $student->rank }}//you are shprtlisted</div>

        <div style="background-color: rgba(115, 175, 66, 0.4); padding: 20px; margin-bottom:20px;  display:flex; justify-content: space-around;"
        >
        <span class="mdi mdi-account-details"></span>
        <label>Contact Number</label> 
        <input type="text" placeholder="{{ $student->contact_number }}"/>
        <select>
            <option value="" disabled selected>Choose your placement.</option>
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
        </select>
        <button>save</button>
        </div>


    </div>

    @else
        <p>You are not logged in.</p>
    @endif
</body>
</html>