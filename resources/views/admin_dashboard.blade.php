<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> <!-- Link to the external CSS file -->
</head>
<body>

<div>admin dashboard</div>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Auth::check())
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <p>You are not logged in.</p>
    @endif

    <script>
        // // JavaScript code to redirect after logout and disable caching
        // document.getElementById('logout-form').addEventListener('submit', function() {
        //     window.location.href = "{{ route('login') }}";
        // });
        
        // // Disable caching for this page
        // window.onload = function() {
        //     window.history.pushState({}, document.title, "{{ route('login') }}");
        // };
    </script>

</body>
</html>
