@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager | Dashboard</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- google symbols -->
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

@include('manager.sidenav')

<div class="bg-light ml-1 p-4 w-100">

@if ($eligibility)
    <p>Eligibility Information:</p>

    <div class="p-3" style="background-color: rgba(115, 175, 66, 0.4);">
    
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
        <td style="padding:5px;"><input id="eng" name="eng" value="{{ $eligibility->eng }}" pattern="[0-9]{1,2}"/></td>
        <td style="padding:5px;"><input id="dzo" name="dzo" value="{{ $eligibility->dzo }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="phy" name="phy" value="{{ $eligibility->phy }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="che" name="che" value="{{ $eligibility->che }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="bio" name="bio" value="{{ $eligibility->bio }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="mat" name="mat" value="{{ $eligibility->mat }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="com" name="com" value="{{ $eligibility->com }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="acc" name="acc" value="{{ $eligibility->acc }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="geo" name="geo" value="{{ $eligibility->geo }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="his" name="his" value="{{ $eligibility->his }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="eco" name="eco" value="{{ $eligibility->eco }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="med" name="med" value="{{ $eligibility->med }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="bent" name="bent" value="{{ $eligibility->bent }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="evs" name="evs" value="{{ $eligibility->evs }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="rige" name="rige" value="{{ $eligibility->rige }}" pattern="[0-9]{1,2}" /></td>
        <td style="padding:5px;"><input id="agfs" name="agfs" value="{{ $eligibility->agfs }}" pattern="[0-9]{1,2}" /></td>
    </tr>
</table>

    <button type="submit">Update</button>

    </form>

    </div>

    <hr>

    <p>Add Placement</p>

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
    <p>Registration Date</p>

    <div class="p-3" style="background-color: rgba(115, 175, 66, 0.4);">
    //registration
    </div>

    @else
        <p>No eligibility data found.</p>
    @endif

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
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
</script>

</body>
</html>
