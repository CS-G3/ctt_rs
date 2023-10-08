<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if(session('student_id'))

    student dashboard
    //to do
    <br>

    <form id="logout-form" action="{{ route('student.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
        </form>
    @else
        <p>You are not logged in as a student.</p>
    @endif
</body>
</html>