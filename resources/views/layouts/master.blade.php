<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quality Wear</title>
  <link rel="icon" href="{{ asset('images/logo.png') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper" style="background-color: #161625 !importent">

    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-color-all">
      <!-- Content Header (Page header) -->

      <!-- /.content-header -->

      <!-- Main content -->

      @yield('content')
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->

    @include('layouts.footer')

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    $(document).ready(function(){
        console.log('hai');
        $(".alert").delay(2000).fadeOut(1000);
        $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      })
    });
    
  </script>
</body>

</html>