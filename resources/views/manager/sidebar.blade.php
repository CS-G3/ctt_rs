<aside class="sidebar">
    <ul>
    <li><a href="{{ ('/manager/dashboard') }}">dashboard</a></li>
    <li><a href="{{ ('/manager/rank') }}">rank</a></li>
    <li><a href="{{ ('/manager/archive') }}">archieve</a></li>
    <li><a href="{{ route('manager.edit',  ['id' => auth()->user()->id]) }}">Setting</a></li>
        <!-- Add more menu items as needed -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </ul>
</aside>
