@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager | Dashboard</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        table tr td input {
            width:50px;
            text-align:center;
            border:none;
            color: grey;
        }
        table {
            width:100%;
            text-align:center;
        }
        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 12px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        input {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
    </style>
</head>
<body class="d-flex bg-secondary">

<!-- @include('components.responsive') -->

@include('manager.sidenav')

<div class="bg-light ml-1 p-4 w-100" style=" overflow-x: auto;">

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ Session::get('success') }}
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

@if ($eligibility)
    <p style="font-weight:bold;">Eligibility Information</p>

    <div class="p-2" style="background-color: rgba(115, 175, 66, 0.4);">
    
    <form method="POST" action="{{ route('update.eligibility') }}">
    @csrf

    <input type="text" id="id" name="id" value="{{ $eligibility->id }}" hidden/>
    @php
        $subjects = ['ENG', 'DZO', 'PHY', 'CHE', 'BIO', 'MAT', 'COM', 'ACC', 'GEO', 'HIS', 'ECO', 'MED', 'BENT', 'EVS', 'RIGE', 'AGFS'];
    @endphp

    <div style="overflow-x: auto;">
        <table>
            <tr style="background-color:#fff">
                <td style="padding:5px; font-weight:500">Subject</td>
                @foreach($subjects as $subject)
                    <td style="padding:5px;">{{ $subject }}</td>
                @endforeach
            </tr>
            <tr style="background-color:#EDEDED;">
                <td style="padding:5px; font-weight:500">Min</td>
                @foreach($subjects as $subject)
                    <td style="padding:5px;">
                        <input id="{{ strtolower($subject) }}" name="{{ strtolower($subject) }}" value="{{ $eligibility->{strtolower($subject)} }}" type="number" max="99" required/>
                    </td>
                @endforeach
            </tr>
        </table>
    </div>

    <div style="text-align: right;">
        <button type="submit">Update</button>
    </div>

    </form>

    </div>

    <hr>

    <p style="font-weight:bold;">Add Placement</p>

    <div class="p-3" style="background-color: rgba(115, 175, 66, 0.4);">
    <form method="POST" action="{{ route('placement.add') }}">
        @csrf
        <div style="display:flex; flex-wrap: wrap; justify-content: space-between;">

            <div style="flex: 3; margin-right: 10px; width: 48%;">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" placeholder="Placement Name" style="width: 100%;" required>
            </div>

            <div style="flex: 3; margin-right: 10px; width: 48%;">
                <label for="time">Date & Time:</label>
                <input type="datetime-local" name="time" id="time" style="width: 100%;" required>
            </div>

            <div style="flex: 1; width: 100%; margin-top: 1.35rem;">
                <button type="submit" style="width: 100%;">Add Placement</button>
            </div>
        </div>
    </form>

    <div style="width: 100%;">
        <p style="font-size:14px; color: grey;">*view or click on placement to delete</p>
        <form action="{{ route('placement.delete') }}" method="POST" id="deleteForm">
            @csrf
            @method('DELETE')
            <select name="selectedPlacement" id="selectedPlacement" style="width: 100%; padding: 6px; border: 1px solid #ccc; border-radius: 3px; margin-bottom: 10px;">
                <option value="" disabled selected>Placement</option>
                @foreach($placement as $item)
                    <option value="{{ $item->id }}">{{ $item->location }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-danger btn-sm" id="deleteButton" style="display: none; width: 10%;">
                <span class="material-symbols-outlined" style="font-size:16px; padding-top:5px;">
                    delete
                </span>
            </button>
        </form>
    </div>
</div>

    <hr>                                    
    <p style="font-weight:bold;">Registration Date</p>

    <div class="p-3" style="background-color: rgba(115, 175, 66, 0.4); display:flex;">

    <form method="POST" action="{{ route('registrationDate.add') }}" class="w-100">
    @csrf
    <div>
    <label>Start Date:</label>
    <input type="date" name="startDate" id="startDate" required  value="{{ $startDate ? $startDate : '' }}">

    <label style="margin-top:1.5rem;">End Date:</label>
    <input type="date" name="endDate" id="endDate" required value="{{ $endDate ? $endDate : '' }}">

    </div>

    <div style="margin-top:1.5rem;">
    <span style="font-weight:bold;">
        Status:
    </span>
    @if ($status)
        Open
    @else 
        Close
    @endif
    </div>

    <button type="submit" style="margin-top:1.5rem; float: right;">Save</button>

    </form>

    </div>

    
    <hr>                                    
    <p style="font-weight:bold;">Total intake for CTT</p>

    <div class="p-3" style="background-color: rgba(115, 175, 66, 0.4); display: flex; flex-direction: column;">

    <form method="post" action="{{ route('add.total_intake') }}" style="flex-grow: 1; display: flex; flex-direction: column;">
        @csrf
        <label for="total_intake">Total Intake:</label>
        <input type="text" name="total_intake" placeholder="Enter total intake" value="{{ $total_intake }}"
            title="Enter number with max 3 digits." pattern="\d{3}" required>

        <!-- Add an empty div to push the button to the bottom -->
        <div style="flex-grow: 1;"></div>
        <button type="submit" style="align-self: flex-end;">Save</button>
    </form>

    </div>

    <hr>
    
    @php
        // Assuming $criteria is an associative array with column names as keys
        $criteria = [
            'mat' => 'Mathematics',
            'bmt' => 'Business Mathematics',
            'eng' => 'English',
            'phy' => 'Physics',
            'che' => 'Chemistry',
            'bio' => 'Biology',
            'dzo' => 'Dzongkha',
            'com' => 'Commerce',
            'acc' => 'Accounting',
            'geo' => 'Geography',
            'his' => 'History',
            'eco' => 'Economics',
            'med' => 'Media',
            'bent' => '',
            'evs' => 'Environmental Science',
            'rige' => 'Rigzhung',
            'agfs' => 'Agricultural Science',
        ];
    @endphp
    <p style="font-weight:bold;">Subject Multiplier - Ranking Purpose</p>

    <div class="p-2" style="background-color: rgba(115, 175, 66, 0.4)">
    <form action="{{ route('update-ranking-criteria') }}" method="post">
            @csrf
        <div style="overflow-x: auto;">
            <table>
                <tr style="background-color:#fff">
                    <!-- <td style="padding:5px; font-weight:500">Subject</td> -->
                    @foreach ($criteria as $column => $subject)
                        <td style="padding:5px;">{{ strtoupper($column) }}</td>
                    @endforeach
                </tr>
                <tr style="background-color:#EDEDED;">
                    <!-- <td style="padding:5px; font-weight:500">Mul.</td> -->
                    @foreach ($criteria as $column => $subject)
                        <td style="padding:5px;">
                            <input id="{{ $column }}" name="{{ $column }}" value="{{ $rankingCriteria->{$column} }}" type="number" max="9" required>
                        </td>
                    @endforeach
                </tr>
            </table>
        </div>

        <div style="text-align: right;">
            <button type="submit">Update</button>
        </div>
        </form>
    </div>

    @endif
    
    @else
        <p>You are not logged in.</p>
    @endif

</div>

<script>
    const selectElement = document.getElementById('selectedPlacement');
    const deleteButton = document.getElementById('deleteButton');

    selectElement.addEventListener('change', function() {
        if (selectElement.value !== '') {
            deleteButton.style.display = 'inline-block';
        } else {
            deleteButton.style.display = 'none';
        }
    });

    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');

    startDateInput.addEventListener('change', function() {
        const startDate = new Date(startDateInput.value);
        
        // Set the minimum date for end date input
        endDateInput.min = startDateInput.value;
        
        const endDate = new Date(endDateInput.value);

        // Check if the current end date is before the new minimum
        if (endDate < startDate) {
            endDateInput.value = ''; // Clear the end date value
        }
    });
</script>

</body>
</html>
