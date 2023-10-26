<!DOCTYPE html>
<html lang="en">
  <head>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/sidenav.css') }}"> <!-- Link to the external CSS file -->
  </head>
  <body style="height: 100vh;">
    <div class="sidebar active">
      <div class="top">
        <div class="logo"></div>
        <i class="bx bx-menu" id="btn"></i>
      </div>
      <div class="user">
        <img src="{{ asset('images/gcit_logo.png') }}" alt="gcit logo" class="user-img" />
      </div>
      <ul>
        <li>
          <a href="{{ ('/manager/dashboard') }}">
            <i class="bx bx-home"></i>
            <span class="nav-item">Home</span>
          </a>
          <span class="tooltip">Home</span>
        </li>
        <li>
          <a href="{{ ('/manager/rank') }}">
            <i class="bx bx-trophy"></i>
            <span class="nav-item">Rank</span>
          </a>
          <span class="tooltip">Rank</span>
        </li>
        <li>
          <a href="{{ ('/manager/archive') }}">
            <i class="bx bx-archive-in"></i>
            <span class="nav-item">Archive</span>
          </a>
          <span class="tooltip">Archive</span>
        </li>

        <li>
          <a href="{{ route('manager.edit',  ['id' => auth()->user()->id]) }}">
            <i class="bx bx-cog"></i>
            <span class="nav-item">Setting</span>
          </a>
          <span class="tooltip">Setting</span>
        </li>
        <li style=" position: absolute;
            bottom: 0; margin-left:1rem;s">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();">
                <i class="bx bx-log-out"></i>
                <span class="nav-item">Logout</span>
            </a>
            <span class="tooltip">Logout</span>
        </form>
    </li>

      </ul>
    </div>

    <script>
      let sidebar = document.querySelector(".sidebar");
      let btn = document.querySelector("#btn");
      
      btn.onclick = function () {
        sidebar.classList.toggle("active");
      };
    </script>
  </body>
</html>
