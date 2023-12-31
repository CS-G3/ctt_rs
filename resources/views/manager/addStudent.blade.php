@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <!-- google symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body class="d-flex bg-secondary">

@include('manager.sidenav')

<div class="bg-light ml-1 p-4 w-100" style="overflow:auto; height:100vh;">
    <a href="/manager/rank/soc">Back</a>
    <hr>
    <h3 style="text-align:center;">Add New Student</h3>
    <div style="padding: 0 20% 0 20%;">
    
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

    <form method="POST" action="{{ route('students.add') }}">
    @csrf

    <div style="font-weight:bold;">Student Info</div>
    <div class="form-row">

        <div class="form-group col-md-4">
            <label for="name">Name:</label>
            <input type="text" name="name" pattern="[A-Za-z ]+" title="Only alphabets are allowed" class="form-control" placeholder="Student Name" required>
        </div>

        <div class="form-group col-md-4">
            <label for="index_number">Index Number:</label>
            <input type="text" name="index_number" pattern="[0-9]+" title="Only numbers are allowed" class="form-control" placeholder="Index Number" value="{{ old('index_number') }}" required>
        </div>

        <div class="form-group col-md-4">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
        </div>
    </div>

    <div class="form-row">

    <div class="form-group col-md-4">
            <label for="contact_number">Contact Number:</label>
            <input type="text" name="contact_number" class="form-control" 
            pattern="(975\d{8}|(17|77)\d{6})" title="Enter a valid number starting with 975, 17 or 77."
            placeholder="Contact Number" value="{{ old('contact_number') }}">
        </div>

        <div class="form-group col-md-4">
            <label for="stream">Stream:</label>
            <select name="stream" class="form-control" required>
                <option value="" disabled selected>Select Stream</option>
                <option value="SCIENCE">SCIENCE</option>
                <option value="COMMERCE">COMMERCE</option>
                <option value="ARTS">ARTS</option>
            </select>
        </div>


        <div class="form-group col-md-4">
            <label for="supw">SUPW:</label>
            <select name="supw" class="form-control" required>
                <option value="" disabled selected>SUPW</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>

    </div>

    <hr/>

    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="eng">ENG</label>
            <input type="number" min="0" max="100" name="eng" class="form-control" placeholder="ENG" title="Please enter a number with up to 3 digits">
        </div>

        <div class="form-group col-md-2">
            <label for="dzo">DZO</label>
            <input type="number" min="0" max="100" name="dzo" class="form-control" placeholder="DZO" title="Please enter a number with up to 3 digits">
        </div>

        <div class="form-group col-md-2">
            <label for="com">COM</label>
            <input type="number" min="0" max="100" name="com" class="form-control" placeholder="COM" title="Please enter a number with up to 3 digits">
        </div>

        <div class="form-group col-md-2">
            <label for="acc">ACC</label>
            <input type="number" min="0" max="100" name="acc" class="form-control" placeholder="ACC" title="Please enter a number with up to 3 digits">
        </div>

        <div class="form-group col-md-2">
            <label for="bmt">BMT</label>
            <input type="number" min="0" max="100" name="bmt" class="form-control" placeholder="BMT" title="Please enter a number with up to 3 digits">
        </div>

        
        <div class="form-group col-md-2">
            <label for="geo">GEO</label>
            <input type="number" min="0" max="100" name="geo" class="form-control" placeholder="GEO" title="Please enter a number with up to 3 digits">
        </div>

        
        <div class="form-group col-md-2">
            <label for="his">HIS</label>
            <input type="number" min="0" max="100" name="his" class="form-control" placeholder="HIS" title="Please enter a number with up to 3 digits">
        </div>
        
        <div class="form-group col-md-2">
            <label for="eco">ECO</label>
            <input type="number" min="0" max="100" name="eco" class="form-control" placeholder="ECO" title="Please enter a number with up to 3 digits">
        </div>
        
        <div class="form-group col-md-2">
            <label for="med">MED</label>
            <input type="number" min="0" max="100" name="med" class="form-control" placeholder="MED" title="Please enter a number with up to 3 digits">
        </div>
        
        <div class="form-group col-md-2">
            <label for="bent">BENT</label>
            <input type="number" min="0" max="100" name="bent" class="form-control" placeholder="BENT" title="Please enter a number with up to 3 digits">
        </div>
        
        <div class="form-group col-md-2">
            <label for="evs">EVS</label>
            <input type="number" min="0" max="100" name="evs" class="form-control" placeholder="EVS" title="Please enter a number with up to 3 digits">
        </div>
        
        <div class="form-group col-md-2">
            <label for="rige">RIGE</label>
            <input type="number" min="0" max="100" name="rige" class="form-control" placeholder="RIGE" title="Please enter a number with up to 3 digits">
        </div>
        
        <div class="form-group col-md-2">
            <label for="agfs">AGFS</label>
            <input type="number" min="0" max="100" name="agfs" class="form-control" placeholder="AGFS" title="Please enter a number with up to 3 digits">
        </div>
        
        <div class="form-group col-md-2">
            <label for="mat">MAT</label>
            <input type="number" min="0" max="100" name="mat" class="form-control" placeholder="MAT" title="Please enter a number with up to 3 digits">
        </div>
        
        <div class="form-group col-md-2">
            <label for="phy">PHY</label>
            <input type="number" min="0" max="100" name="phy" class="form-control" placeholder="PHY" title="Please enter a number with up to 3 digits">
        </div>
        
        <div class="form-group col-md-2">
            <label for="che">CHE</label>
            <input type="number" min="0" max="100" name="che" class="form-control" placeholder="CHE" title="Please enter a number with up to 3 digits">
        </div>
        
        <div class="form-group col-md-2">
            <label for="bio">BIO</label>
            <input type="number" min="0" max="100" name="bio" class="form-control" placeholder="BIO" title="Please enter a number with up to 3 digits">
        </div>

    </div>

    <button type="submit">Add Student</button>
    
</form>

    </div>
</div>

@endif

</body>
</html>
