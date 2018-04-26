<nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <!-- This is the message dropdown -->
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li class="dropdown">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> 
                        <img src="{{ asset('plugins/images/users/varun.jpg') }}" alt="user-img" width="36" class="img-circle">
                        <b class="hidden-xs m-r-5">{{ \Auth::user()->name }}</b>
                        <span class="caret"></span> 
                    </a>
                    <ul class="dropdown-menu dropdown-user animated flipInY">
                        <li>
                            <div class="dw-user-box">
                                <div class="u-img">
                                    <img src="{{ asset('plugins/images/users/varun.jpg') }}" alt="user">
                                </div>
                                <div class="u-text">
                                    <h4>{{ \Auth::user()->name }}</h4>
                                    <p class="text-muted">{{ \Auth::user()->email }}</p>
                                </div>
                            </div>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                {{ csrf_field() }}
                                <a href="#" onclick="document.getElementById('logout-form').submit()" style="padding:10px 15px;display:inline-block;">
                                    <i class="fa fa-power-off"></i> Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>