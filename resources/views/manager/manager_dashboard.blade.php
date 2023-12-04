@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager | Dashboard</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
            background-color: #73AF42;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 12px;
            margin-top: 10px;
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

@include('components.responsive')

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
    <table>
    <tr style="background-color:#fff">
        <td style="padding:5px; font-weight:500">Subject</td>
        <td style="padding:5px">ENG</td>
        <td style="padding:5px;">DZO</td>
        <td style="padding:5px;">PHY</td>
        <td style="padding:5px;">CHE</td>
        <td style="padding:5px;">BIO</td>
        <td style="padding:5px;">MAT</td>
        <td style="padding:5px;">COM</td>
        <td style="padding:5px;">ACC</td>
        <td style="padding:5px;">GEO</td>
        <td style="padding:5px;">HIS</td>
        <td style="padding:5px;">ECO</td>
        <td style="padding:5px;">MED</td>
        <td style="padding:5px;">BENT</td>
        <td style="padding:5px;">EVS</td>
        <td style="padding:5px;">RIGE</td>
        <td style="padding:5px;">AGFS</td>
    </tr>
    <tr style="background-color:#EDEDED;">
        <td style="padding:5px; font-weight:500">Min</td>
        <td style="padding:5px;"><input id="eng" name="eng" value="{{ $eligibility->eng }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="dzo" name="dzo" value="{{ $eligibility->dzo }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="phy" name="phy" value="{{ $eligibility->phy }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="che" name="che" value="{{ $eligibility->che }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="bio" name="bio" value="{{ $eligibility->bio }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="mat" name="mat" value="{{ $eligibility->mat }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="com" name="com" value="{{ $eligibility->com }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="acc" name="acc" value="{{ $eligibility->acc }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="geo" name="geo" value="{{ $eligibility->geo }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="his" name="his" value="{{ $eligibility->his }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="eco" name="eco" value="{{ $eligibility->eco }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="med" name="med" value="{{ $eligibility->med }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="bent" name="bent" value="{{ $eligibility->bent }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="evs" name="evs" value="{{ $eligibility->evs }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="rige" name="rige" value="{{ $eligibility->rige }}" type="number" max="99" required/></td>
        <td style="padding:5px;"><input id="agfs" name="agfs" value="{{ $eligibility->agfs }}" type="number" max="99" required/></td>
    </tr>
</table>

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
            <div style="display:flex; justify-content:space-between;">
            
                <div>
                    <label for="location">Location:</label>
                    <input type="text" name="location" id="location" placeholder="Placement Name" required>
                    <button type="submit">Add Placement</button>
                </div>

                <div>
                    <label for="time">Date & Time:</label>
                    <input type="datetime-local" name="time" id="time" required>
                </div>

                </form>

                <div>
                <p style="font-size:14px; color: grey;">*view or click on placement to delete</p>
                <form action="{{ route('placement.delete') }}" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <select name="selectedPlacement" id="selectedPlacement" style="width: 100%; padding: 6px; margin-top: -5px; border: 1px solid #ccc; border-radius: 3px;">
                        <option value="" disabled selected>Placement</option>
                        @foreach($placement as $item)
                            <option value="{{ $item->id }}">{{ $item->location }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-danger btn-sm" id="deleteButton" style="display: none;">
                    <span class="material-symbols-outlined" style="font-size:16px; padding-top:5px;">
                        delete
                    </span>
                    </button>
                </form>

                </div>
                
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

    <div class="p-3" style="background-color: rgba(115, 175, 66, 0.4); display:flex;">
    <form action="{{ route('update-ranking-criteria') }}" method="post">
            @csrf
            <table>
                <tr style="background-color:#fff">
                    <td style="padding:5px; font-weight:500">Subject</td>
                    @foreach ($criteria as $column => $subject)
                        <td style="padding:6.7px;">{{ strtoupper($column) }}</td>
                    @endforeach
                </tr>
                <tr style="background-color:#EDEDED;">
                    <td style="padding:5px; font-weight:500">Multiplier</td>
                    @foreach ($criteria as $column => $subject)
                        <td style="padding:6.7px;">
                            <input id="{{ $column }}" name="{{ $column }}" value="{{ $rankingCriteria->{$column} }}" type="number" max="9" required>
                        </td>
                    @endforeach
                </tr>
            </table>

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
