@if(Auth::check())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager | Dashboard</title>
</head>
<body>

@include('manager.sidebar')

<div>manager dashboard</div>

@if ($eligibility)
    <p>Eligibility Information:</p>
    
    <form method="POST" action="{{ route('update.eligibility') }}">
    @csrf

    <input type="text" id="id" name="id" value="{{ $eligibility->id }}" hidden/>

    <label for="eng">English</label>
    <input id="eng" name="eng" value="{{ $eligibility->eng }}" pattern="[0-9]{1,2}"/>

    <label for="dzo">Dzongkha</label>
    <input type="text" id="dzo" name="dzo" value="{{ $eligibility->dzo }}" pattern="[0-9]{1,2}" />

    <label for="phy">Physics</label>
    <input type="text" id="phy" name="phy" value="{{ $eligibility->phy }}" pattern="[0-9]{1,2}" />

    <label for="che">Chemistry</label>
    <input type="text" id="che" name="che" value="{{ $eligibility->che }}" pattern="[0-9]{1,2}" />

    <label for="bio">Biology</label>
    <input type="text" id="bio" name="bio" value="{{ $eligibility->bio }}" pattern="[0-9]{1,2}" />

    <label for="mat">Math</label>
    <input type="text" id="mat" name="mat" value="{{ $eligibility->mat }}" pattern="[0-9]{1,2}" />

    <label for="com">Commerce</label>
    <input type="text" id="com" name="com" value="{{ $eligibility->com }}" pattern="[0-9]{1,2}" />

    <label for="acc">Accounts</label>
    <input type="text" id="acc" name="acc" value="{{ $eligibility->acc }}" pattern="[0-9]{1,2}" />

    <label for="geo">Geography</label>
    <input type="text" id="geo" name="geo" value="{{ $eligibility->geo }}" pattern="[0-9]{1,2}" />

    <label for="his">History</label>
    <input type="text" id="his" name="his" value="{{ $eligibility->his }}" pattern="[0-9]{1,2}" />

    <label for="eco">Economics</label>
    <input type="text" id="eco" name="eco" value="{{ $eligibility->eco }}" pattern="[0-9]{1,2}" />

    <label for="med">Media</label>
    <input type="text" id="med" name="med" value="{{ $eligibility->med }}" pattern="[0-9]{1,2}" />

    <label for="bent">BENT</label>
    <input type="text" id="bent" name="bent" value="{{ $eligibility->bent }}" pattern="[0-9]{1,2}" />

    <label for="evs">EVS</label>
    <input type="text" id="evs" name="evs" value="{{ $eligibility->evs }}" pattern="[0-9]{1,2}" />

    <label for="rige">RIGE</label>
    <input type="text" id="rige" name="rige" value="{{ $eligibility->rige }}" pattern="[0-9]{1,2}" />

    <label for="agfs">AGFS</label>
    <input type="text" id="agfs" name="agfs" value="{{ $eligibility->agfs }}" pattern="[0-9]{1,2}" />

    <button type="submit">update</button>

    </form>

    <hr>

        <!-- <ul>
            <li>English {{ $eligibility->eng }}</li>
            <li>Dzongkha: {{ $eligibility->dzo }}</li>
            <li>Physics: {{ $eligibility->phy }}</li>
            <li>Chemistry: {{ $eligibility->che }}</li>
            <li>Biology: {{ $eligibility->bio }}</li>
            <li>Math: {{ $eligibility->mat }}</li>
            <li>Commerce: {{ $eligibility->com }}</li>
            <li>Accounts: {{ $eligibility->acc }}</li>
            <li>Geography: {{ $eligibility->geo }}</li>
            <li>History: {{ $eligibility->his }}</li>
            <li>Economics: {{ $eligibility->eco }}</li>
            <li>Media: {{ $eligibility->med }}</li>
            <li>BENT: {{ $eligibility->bent }}</li>
            <li>EVS: {{ $eligibility->evs }}</li>
            <li>RIGE: {{ $eligibility->rige }}</li>
            <li>AGFS: {{ $eligibility->agfs }}</li>
        </ul> -->
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

</body>
</html>
