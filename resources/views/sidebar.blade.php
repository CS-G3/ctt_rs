<!-- resources/views/sidebar.blade.php -->
<aside class="sidebar">
    <ul>
    <li><a href="{{ ('/admin/dashboard') }}">dashboard</a></li>
    <li><a href="{{ ('/admin/setting') }}">setting</a></li>
        <!-- Add more menu items as needed -->
        @if(Auth::check())
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @else
        <p>You are not logged in.</p>
        @endif
    </ul>
</aside>
