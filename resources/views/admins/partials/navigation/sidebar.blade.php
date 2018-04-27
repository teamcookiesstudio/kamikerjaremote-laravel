<div class="navbar-default sidebar" role="navigation">
        <div class="slimScrollDiv">
            <div class="sidebar-nav slimscrollsidebar">
            <div class="sidebar-head">
                <div class="sidebar-logo">
                    <img src="../plugins/images/syarfi-logo-white.png" alt="KKR Admin" class="dark-logo">
                </div>
            </div>
            <ul class="nav" id="side-menu">
                <li>
                <a href="{{route('admin.dashboard')}}" class="waves-effect {{{ (Request::is('dashboard') ? 'active' : '') }}}">
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="waves-effect">
                        <span class="hide-menu">
                            Users
                            <span class="fa arrow"></span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level collapse" id="nav-second">
                        <li>
                            <a href="{{ route('admin.members.index') }}">
                                <span class="hide-menu">Approval</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.5); width: 6px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; left: 1px; height: 426px;"></div><div class="slimScrollRail" style="width: 6px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div></div>
    </div>
    