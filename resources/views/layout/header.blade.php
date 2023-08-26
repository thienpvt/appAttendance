<div class="navbar-custom">
    <ul class="list-unstyled topbar-right-menu float-right mb-0">


        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#"
               role="button" aria-haspopup="false"
               aria-expanded="false">
                <span>
                    <span class="account-user-name">Hello {{user()->name}}</span>
                    <span class="account-position">{{getRole()}}</span>
                </span>
            </a>
            <div
                class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle mr-1"></i>
                    <span>My Account</span>
                </a>

                <!-- item-->
                <!-- item-->
                <!-- item-->
                <!-- item-->
                <a href="{{route('logout')}}" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout mr-1"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left disable-btn">
        <i class="mdi mdi-menu"></i>
    </button>

</div>
