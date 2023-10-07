@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Your registration form or other content goes here -->
<div>add users</div>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="name" value="{{ old('name') }}" required autofocus>
    <input type="email" name="email" value="{{ old('email') }}" required>
    <input type="password" name="password" required>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Register</button>
</form>

<div>Add Student Record</div>

<form method="POST" action="{{ route('students.add') }}">
    @csrf

    <label for="index_number">Index Number:</label>
    <input type="text" name="index_number" value="{{ old('index_number') }}" required>

    <label for="date_of_birth">Date of Birth:</label>
    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required>

    <label for="contact_number">Contact Number:</label>
    <input type="text" name="contact_number" value="{{ old('contact_number') }}">

    <label for="placement_id">Placement ID:</label>
    <input type="text" name="placement_id" value="{{ old('placement_id') }}">

    <label for="stream">Stream:</label>
    <input type="text" name="stream" value="{{ old('stream') }}" required>

    <label for="supw">SUPW:</label>
    <input type="text" name="supw" value="{{ old('supw') }}" maxlength="1" required>

    <label for="eligibility_criteria_id">Eligibility Criteria ID:</label>
    <input type="text" name="eligibility_criteria_id" value="{{ old('eligibility_criteria_id') }}">

    <label for="eng">English:</label>
    <input type="text" name="eng" value="{{ old('eng') }}">

    <label for="dzo">Dzongkha:</label>
    <input type="text" name="dzo" value="{{ old('dzo') }}">

    <label for="com">Computer Science:</label>
    <input type="text" name="com" value="{{ old('com') }}">

    <label for="acc">Accounting:</label>
    <input type="text" name="acc" value="{{ old('acc') }}">

    <label for="bmt">Business Mathematics:</label>
    <input type="text" name="bmt" value="{{ old('bmt') }}">

    <label for="rank">Rank:</label>
    <input type="number" name="rank" value="{{ old('rank') }}">

    <button type="submit">Add Student</button>
</form>

<form method="POST" action="{{ route('students.updateByIndex') }}">
    
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="index_number">Index Number</label>
        <input type="text" name="index_number" id="index_number" class="form-control" >
        <input type="number" name="contact_number" id="contact_number" class="form-control">
    </div>

    <!-- Add more form fields for other student attributes -->

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update Student</button>
    </div>
</form>
