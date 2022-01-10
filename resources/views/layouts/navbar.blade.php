<!-- /.navbar -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-color-nav">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/dashboard" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">

      </li>
    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <div class="btn-group">
          <button type="button" class="btn btn-info btn-flat">{{ Auth::user()->name }}</button>
          <button type="button" class="btn btn-info btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <div class="dropdown-menu" role="menu">
            <a class="dropdown-item" href="#">{{ Auth::user()->name }}</a>
            <a class="dropdown-item" href="#">{{ Auth::user()->email }}</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a class="dropdown-item" :href="route('logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                Logout
              </a>
            </form>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
</body>

</html>