<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Kami Kerja Remote</title>

  <link href="{{ asset('css/flexboxgrid.css') }}" rel="stylesheet">
  <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
  <link href="{{ asset('css/fontello.css') }}" rel="stylesheet">
  <link href="{{ asset('css/fontello-ie7.css') }}" rel="stylesheet">
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="profile">
  <nav class="colored">
    <div class="top-bar">
      <a class="logo" href="/">Logo</a>
      <div class="menus">
        <ul>
          <li>
            <a href="{{ route('home') }}">Home</a>
          </li>
          <li>
            <a href="#">Freelancer</a>
          </li>
          @if (auth()->check() && auth()->user()->isAdmin())
          <li>
            <a href="{{ route('members.index') }}">Approval</a>
          </li>
          @endif
          <li>
            <a href="#">About</a>
          </li>
          <li>
            <a href="#">Contact</a>
          </li>
        </ul>
        <div class="actions">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
            <span>or</span>
            <a class="btn btn-thin" href="{{ route('register') }}">{{ __('Register') }}</a>
            @else
            <div class="logged-user">
              <img src="https://randomuser.me/api/portraits/men/51.jpg" id="user-action">
              <div class="user-actions" id="actions">
                <div class="arrow-up"></div>
                <ul>
                  <li id="logout">
                    <div>
                      <i class="ion-log-out"></i>
                      <a style="color: #404040; " href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            @endguest
          </ul>
        </div>
      </div>
    </div>
  </nav>
  @yield('content')
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="{{ asset('js/pages/profile-page.js') }}"></script>
<script src="{{ asset('js/nav.js') }}"></script>
@stack('script')

</html>
