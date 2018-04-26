
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Kami Kerja Remote</title>

    <link href="css/flexboxgrid.css" rel="stylesheet">
    <link href="css/ionicons.min.css" rel="stylesheet">
    <link href="css/normalize.css" rel="stylesheet">
    <link href="css/fontello.css" rel="stylesheet">
    <link href="css/fontello-ie7.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body id="index">
    <header>
      <nav>
          <div class="top-bar">
            <a class="logo" href="/">Logo</a>
            <div class="menus">
              <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Freelancer</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
              @if (Route::has('login'))
                <div class="actions">
                  @if (auth::check() && auth::user()->level == 1)
                  <div class="logged-user">
                      {!! 
                        Html::image(
                          asset('images/no_avatar.jpg'), 
                          null, array('class' => 'profile-img', 'id' => 'user-action')
                        ) 
                      !!}
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
                    @elseif (auth::check() && auth::user()->level == 2)
                    <div class="logged-user">
                        {!! 
                          Html::image(
                            strpos($user->profile->url_photo_profile, 'http') !== false ? 
                            $user->profile->url_photo_profile : 
                            ($user->profile->url_photo_profile != null ? 
                            asset('storage/profile/'.$user->profile->url_photo_profile) : 
                            asset('images/no_avatar.jpg')), 
                            null, array('class' => 'profile-img', 'id' => 'user-action')
                          ) 
                        !!}
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
                    @else
                        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                        <span>or</span>
                        <a class="btn btn-thin" href="{{ route('register') }}">Register</a>
                    @endif
                </div>
                @endif
            </div>
          </div>
        </nav>
      <div class="row center-xs">
        <div class="col-xs-11 col-md-6 center-xs">
          <h1>Indonesian Remote Worker</h1>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <form action="{{route('search.result')}}">
            <div class="input-control search-box">
              <label class="icon-search" for="search"></label>
              <input type="text" id="search" name="q" placeholder="Cari Freelancer Anda di sini">
              <button class="btn btn-primary" type="submit">Cari</button>
            </div>
          </form>
        </div>
      </div>
      <div class="wave-brand"></div>
    </header>
    <section>
      <div class="container">
        <h2>Who are we?</h2>
        <div class="row middle-xs center-xs">
          <div class="col-xs-11 col-md-6">
            <h3>The <strong>Biggest</strong> Freelancer
              community in Indonesia</h3>
          </div>
          <div class="col-xs-11 col-md-6">
            <div class="about-point start-xs">
              <div class="circle">1</div>
              <div class="about-point-details">
                <h4>Get Connected</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.</p>
              </div>
            </div>
            <div class="about-point start-xs">
              <div class="circle">2</div>
              <div class="about-point-details">
                <h4>Share Experience</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.</p>
              </div>
            </div>
            <div class="about-point start-xs">
              <div class="circle">3</div>
              <div class="about-point-details">
                <h4>Get Connected</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row center-xs">
          <div class="col-xs-11 col-md-4 values">
            <img src="http://via.placeholder.com/250x250">
            <h5>High Quality Skill</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
          <div class="col-xs-11 col-md-4 values card">
            <img src="http://via.placeholder.com/250x250">
            <h5>High Quality Skill</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
          <div class="col-xs-11 col-md-4 values">
            <img src="http://via.placeholder.com/250x250">
            <h5>High Quality Skill</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div>
      </div>
    </section>
    <section class="testimonials curved">
      <svg version="1.1" id="curve_top" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 1440 53.7" style="enable-background:new 0 0 1440 53.7;" xml:space="preserve">
    <style type="text/css">
        .st0{fill:#FFFFFF;}
    </style>
    <path class="st0" d="M1440,0v29.5c-63.3,16.2-177.3,24.2-341.9,24.2c-246.9,0-427.4-38.8-755.3-40.6C219.3,12.4,105.1,16.7,0,26.1V0
        H1440z"/>
    </svg>
      <div class="container">
        <div class="row center-xs">
          <div class="col-xs-11 col-md-8">
            <h2>What They Say?</h2>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          </div>
        </div>
      </div>
      <div class="testimonies">
        <div class="inner">
          <div class="card">
            <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua”</p>
            <strong>David East</strong>
            <img src="https://randomuser.me/api/portraits/women/17.jpg" class="testmonial-img">
          </div>
          <div class="card">
            <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua”</p>
            <strong>David East</strong>
            <img src="https://randomuser.me/api/portraits/women/17.jpg" class="testmonial-img">
          </div>
          <div class="card">
            <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua”</p>
            <strong>David East</strong>
            <img src="https://randomuser.me/api/portraits/women/17.jpg" class="testmonial-img">
          </div>
          <div class="card">
            <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua”</p>
            <strong>David East</strong>
            <img src="https://randomuser.me/api/portraits/women/17.jpg" class="testmonial-img">
          </div>
          <div class="card">
            <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua”</p>
            <strong>David East</strong>
            <img src="https://randomuser.me/api/portraits/women/17.jpg" class="testmonial-img">
          </div>
          <div class="card">
            <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua”</p>
            <strong>David East</strong>
            <img src="https://randomuser.me/api/portraits/women/17.jpg" class="testmonial-img">
          </div>
        </div>
      </div>
      <div class="bottom-pic">
        <div class="wave-brand"></div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row center-xs">
          <div class="col-xs-12 col-md-10">
            <h4 class="footer-head">Be a part of the biggest remote community in Indonesia</h4>
            <a class="btn btn-primary btn-block-half" href="{{ route('register') }}">JOIN NOW</a>
          </div>
        </div>
      </div>
    </section>
    <footer>
      <div class="wave-brand-red"></div>
      <div class="footer-body">
        <div class="container">
          <div class="row center-xs">
            <div class="col-xs-10 col-md-4 start-xs">
              <strong>Kami Kerja Remote</strong>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="col-xs-5 col-md-2 start-xs">
              <strong>Kami Kerja Remote</strong>
              <ul>
                <li><a routerLink="#">Home</a></li>
                <li><a routerLink="#">Freelancer</a></li>
                <li><a routerLink="#">About Us</a></li>
                <li><a routerLink="#">Contact</a></li>
              </ul>
            </div>
            <div class="col-xs-5 col-md-2 start-xs">
              <strong>Support</strong>
              <ul>
                <li><a routerLink="#">Help &amp; Support</a></li>
                <li><a routerLink="#">Privacy Policy</a></li>
                <li><a routerLink="#">Login</a></li>
                <li><a routerLink="#">Register</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-footer">
        <div class="container">
          <span>Copyright 2018 - Kami Kerja Remote</span>
        </div>
      </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/nav.js') }}"></script>
  </body>
</html>