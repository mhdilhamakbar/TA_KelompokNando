<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME')}}</title>
    <?php 
      $route = Route::currentRouteName(); 
    ?>
    <script src="{{ asset('user/js/jquery.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('user/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('user/vendors/css/vendor.bundle.base.css')}}">
    @if($route == "attendance" || $route == 'item_management')
    <link rel="stylesheet" href="{{ asset('user/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('user/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{ asset('user/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{ asset('user/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('user/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('user/css/style.css')}}">
    <link rel="shortcut icon" href="{{ asset('user/images/favicon.png')}}" />
    @if($route == "show_room_list")
      <script>
        $(document).ready(function() {
          $.noConflict();
          $('#room_table').DataTable({
            ordering : false,
            language: {
              "lengthMenu": "Show  _MENU_ entries",
              "zeroRecords": "There are no record for this keyword",
              "infoEmpty": "Data is Empty",
              "infoFiltered": "(Filtered data from _MAX_ data",
              "paginate": {
                  "previous": "<<",
                  "next" : ">>"
              }
            }
          });
        } );
      </script>
    @endif
    @if($route == "show_booking_history")
      <script>
        $(document).ready(function() {
          $.noConflict();
          $('#history_table').DataTable({
            ordering : false,
            language: {
              "lengthMenu": "Show  _MENU_ entries",
              "zeroRecords": "There are no record for this keyword",
              "infoEmpty": "Data is Empty",
              "infoFiltered": "(Filtered data from _MAX_ data",
              "paginate": {
                  "previous": "<<",
                  "next" : ">>"
              }
            }
          });
        } );
      </script>
    @endif
    @if($route == "attendance")
      <script>
        $(document).ready(function() {
          $.noConflict();
          $('#attendance_table').DataTable({
            ordering : false,
            language: {
              "lengthMenu": "Show  _MENU_ entries",
              "zeroRecords": "There are no record for this keyword",
              "infoEmpty": "Data is Empty",
              "infoFiltered": "(Filtered data from _MAX_ data)",
              "paginate": {
                  "previous": "<<",
                  "next" : ">>"
              }
            }
          });
        } );
      </script>
    @endif
    @if($route == "room_management")
      <script>
        $(document).ready(function() {
          $.noConflict();
          $('#room_management_table').DataTable({
            ordering : false,
            language: {
              "lengthMenu": "Show  _MENU_ entries",
              "zeroRecords": "There are no record for this keyword",
              "infoEmpty": "Data is Empty",
              "infoFiltered": "(Filtered data from _MAX_ data)",
              "paginate": {
                  "previous": "<<",
                  "next" : ">>"
              }
            }
          });
        } );
      </script>
    @endif
    
  </head>
  <body>
    <div class="container-scroller">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="{{ route('home') }}"><img src="{{ asset('user/images/logo.png')}}" alt="logo" /></a>
          <a class="sidebar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset('user/images/logo-mini.png')}}" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="{{ asset('user/images/faces/face15.jpg')}}" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">{{Auth::user()->name}}</h5>
                  <span>{{Auth::user()->email}}</span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="{{ route('c_p') }}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a onclick="document.getElementById('logout_form').submit()" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Log Out</p>
                  </div>
                </a>
                <form action="{{route('logout')}}" method="POST" id="logout_form">
                  @csrf
              </form>
              </div>
            </div>
          </li>
          @if (Auth::user()->role == "member")
            <li class="nav-item nav-category">
              <span class="nav-link">User Menu</span>
            </li>
            <li class="nav-item menu-items @if($route == "user_dashboard") active @endif">
              <a class="nav-link" href="{{ route('user_dashboard') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item menu-items @if($route == "user_booking_room" or $route == "show_room_list") active @endif">
              <a class="nav-link" href="{{ route('user_booking_room') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Booking Room</span>
              </a>
            </li>
            <li class="nav-item menu-items @if($route == "show_booking_history") active @endif">
              <a class="nav-link" href="{{ route('show_booking_history') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-table-large"></i>
                </span>
                <span class="menu-title">Booking History</span>
              </a>
            </li>
          @elseif (Auth::user()->role == "fed")
            <li class="nav-item nav-category">
              <span class="nav-link">Frontdesk Menu</span>
            </li>
            <li class="nav-item menu-items @if($route == "fed_dashboard") active @endif">
              <a class="nav-link" href="{{ route('fed_dashboard') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item menu-items @if($route == "attendance") active @endif">
              <a class="nav-link" href="{{ route('attendance') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Marker & Attendance</span>
              </a>
            </li>
            <li class="nav-item menu-items @if($route == "room_management") active @endif">
              <a class="nav-link" href="{{ route('room_management') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-table-large"></i>
                </span>
                <span class="menu-title">Room Management</span>
              </a>
            </li>
          @elseif (Auth::user()->role == "ssc")
          <li class="nav-item nav-category">
            <span class="nav-link">Student Service Centre Menu</span>
          </li>
          <li class="nav-item menu-items @if($route == "ssc_dashboard") active @endif">
            <a class="nav-link" href="{{ route('ssc_dashboard') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item menu-items @if($route == "item_management" || $route == "item_list" || $route == "request_list") active @endif">
            <a class="nav-link" href="{{ route('item_management') }}">
              <span class="menu-icon">
                <i class="mdi mdi mdi-hexagon-outline"></i>
              </span>
              <span class="menu-title">Item Management</span>
            </a>
          </li>
          <li class="nav-item menu-items @if($route == "item_history") active @endif">
            <a class="nav-link" href="{{ route('item_history') }}">
              <span class="menu-icon">
                <i class="mdi mdi mdi-history"></i>
              </span>
              <span class="menu-title">Item History</span>
            </a>
          </li>
          @elseif (Auth::user()->role == "sa")
          <li class="nav-item nav-category">
            <span class="nav-link">Super Admin Menu</span>
          </li>
          <li class="nav-item menu-items @if($route == "sa_dashboard") active @endif">
            <a class="nav-link" href="{{ route('sa_dashboard') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <div class="container-fluid page-body-wrapper">
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini img-fluid" href="{{route('home')}}"><img src="{{ asset('user/images/logo-mini.png') }}" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <p class="preview-subject ellipsis mb-1"><span id="greetings"></span>, {{Auth::user()->name}}</p>
                  <p class="text-muted mb-0">
                    <i class="mdi mdi-av-timer"></i>
                    <span id="crt_time"></span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <div class="main-panel">
          @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>{{session('error')}}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @elseif (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>{{session('success')}}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          @yield('content')
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © UPH General Affair 2022</span>
            </div>
          </footer>
      </div>
    </div>
</div>
<script>
  var crt_time = "{{date('H:i:s')}}";
  var greetings;
  
  if("06:00:00" <= crt_time && crt_time < "11:00:00"){
    greetings = "Good Morning";
  }
  else if ("11:00:00" <= crt_time && crt_time < "15:00:00"){
    greetings = "Good Afternoon";
  }
  else if ("15:00:00" <= crt_time && crt_time < "18:45:00"){
    greetings = "Good Evening";
  }
  else {
    greetings = "Good Night";
  }
  $('#greetings').text(greetings);

  var span = $('#crt_time');

  function time() {
    var d = new Date();
    var s = d.getSeconds();
    var m = d.getMinutes();
    var h = d.getHours();
    span.text(("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2));
  }

  setInterval(time, 1000);
</script>
<script src="{{ asset('user/vendors/js/vendor.bundle.base.js')}}"></script>

<script src="{{ asset('user/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{ asset('user/vendors/progressbar.js/progressbar.min.js')}}"></script>
<script src="{{ asset('user/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
<script src="{{ asset('user/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{ asset('user/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>

<script src="{{ asset('user/js/off-canvas.js')}}"></script>
<script src="{{ asset('user/js/hoverable-collapse.js')}}"></script>
<script src="{{ asset('user/js/misc.js')}}"></script>
<script src="{{ asset('user/js/settings.js')}}"></script>
<script src="{{ asset('user/js/todolist.js')}}"></script>
@if ($route == "attendance" || $route == "item_management")
<script src="{{ asset('user/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('user/js/select2.js')}}"></script>  
@endif
@if ($route == "ssc_dashboard")
<script src="{{ asset('user/js/chart.js') }}"></script>
@endif
<script src="{{ asset('user/js/dashboard.js')}}"></script>
</body>
</html>