<!DOCTYPE html>
<html lang="en">
  <head>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}"> <!-- Link to the external CSS file -->
    <style>
      /* Add a style for the active link */
      .sidebar a.active {
        background-color: #33416E;
        color: #fff;
      }
    </style>
  </head>
  <body style="height: 100vh;">
    <div class="sidebar" id="sidebar">
      <div class="top">
        <div class="logo"></div>
        <i class="bx bx-menu" id="btn"></i>
      </div>
      <div class="user">
        <img src="{{ asset('images/gcit_logo2.png') }}" alt="gcit logo" class="user-img" />
      </div>
      <ul>
        <li>
          <a href="{{ ('/manager/dashboard') }}" class="{{ request()->is('manager/dashboard') ? 'active' : '' }}">
            <i class="bx bx-home"></i>
            <span class="nav-item">Home</span>
          </a>
          <span class="tooltip">Home</span>
        </li>
        <li>
          <a href="{{ ('/manager/rank/soc') }}" class="{{ request()->is('manager/rank/soc') || request()->is('manager/add-student') ? 'active' : '' }}">
            <i class="bx bx-trophy"></i>
            <span class="nav-item">Rank</span>
          </a>
          <span class="tooltip">Rank</span>
        </li>
        <li>
          <a href="{{ ('/manager/archive') }}" class="{{ request()->is('manager/archive') ? 'active' : '' }}">
            <i class="bx bx-archive-in"></i>
            <span class="nav-item">Archive</span>
          </a>
          <span class="tooltip">Archive</span>
        </li>
        <li>
          <a href="{{ ('/manager/insights') }}" class="{{ request()->is('manager/insights') ? 'active' : '' }}">
            <i class="bx bx-info-circle"></i>
            <span class="nav-item">Insights</span>
          </a>
          <span class="tooltip">Archive</span>
        </li>
        <li>
          <a href="{{ route('manager.edit', ['id' => auth()->user()->id]) }}" class="{{ request()->is('user/*') ? 'active' : '' }}">
            <i class="bx bx-cog"></i>
            <span class="nav-item">Setting</span>
          </a>
          <span class="tooltip">Setting</span>
        </li>
        <li style="position: absolute; bottom: 0;">
          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();"
              class="{{ request()->is('logout') ? 'active' : '' }}">
                <i class="bx bx-log-out"></i>
                <span class="nav-item">Logout</span>
            </a>
            <span class="tooltip">Logout</span>
          </form>
        </li>
      </ul>
    </div>

<!-- Add jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Your existing script modified to use jQuery -->
<script>
  $(document).ready(function () {
    let sidebar = $("#sidebar");
    let btn = $("#btn");

    // Check if the sidebar state is stored in localStorage
    const sidebarState = localStorage.getItem("sidebarState");
    console.log("Stored Sidebar State:", sidebarState);

    // Initially close the sidebar
    if (sidebarState !== "collapsed") {
      sidebar.addClass("active");
    }

    btn.click(function () {
      sidebar.toggleClass("active");

      // Store the sidebar state in localStorage
      const newSidebarState = sidebar.hasClass("active") ? "active" : "collapsed";
      localStorage.setItem("sidebarState", newSidebarState);
      console.log("Updated Sidebar State:", newSidebarState);
    });
  });
</script>
    
  </body>
</html>
