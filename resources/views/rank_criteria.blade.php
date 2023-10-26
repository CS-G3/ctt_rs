<!DOCTYPE html>
<html>
<head>
    <title>Form Example</title>
</head>
<body>
    <form action="{{ route('update-ranking-criteria') }}" method="post">
        @csrf
        
        {{-- <input type="text" name="ranking_criteria_id" placeholder="Year"><br> --}}
        <input type="text" name="eng" placeholder="eng"><br>
        <input type="text" name="dzo" placeholder="dzo"><br>
        <input type="text" name="com" placeholder="com"><br>
        <input type="text" name="acc" placeholder="acc"><br>
        <input type="text" name="bmt" placeholder="bmt"><br>
        <input type="text" name="geo" placeholder="geo"><br>
        <input type="text" name="his" placeholder="his"><br>
        <input type="text" name="eco" placeholder="eco"><br>
        <input type="text" name="med" placeholder="med"><br>
        <input type="text" name="bent" placeholder="bent"><br>
        <input type="text" name="evs" placeholder="evs"><br>
        <input type="text" name="rige" placeholder="rige"><br>
        <input type="text" name="agfs" placeholder="agfs"><br>
        <input type="text" name="mat" placeholder="mat"><br>
        <input type="text" name="phy" placeholder="phy"><br>
        <input type="text" name="che" placeholder="che"><br>
        <input type="text" name="bio" placeholder="bio"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>