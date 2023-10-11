<aside class="sidebar">
    <ul>
    <li><a href="{{ ('/admin/dashboard') }}">dashboard</a></li>
    <li><a href="{{ route('user.edit',  ['id' => auth()->user()->id]) }}">Setting</a></li>
        <!-- Add more menu items as needed -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </ul>
</aside>
