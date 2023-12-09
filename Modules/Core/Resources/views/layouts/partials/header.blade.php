@php
  $user = auth()->user();
@endphp
<header class="main-header">
    <!-- Logo -->
    <a href="/kadmin" class="logo">
      <img src="/kilala_logo_main.svg" style="height: 30px;" />
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <a href="{{ route('web.homepage') }}" target="_blank" style="float: left;background-color: transparent;background-image: none;padding: 15px 15px;color: #FFF">
        <i class="fa fa-globe"></i> Website
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          @php
            $currentLanguage = currentLanguage();
          @endphp
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fi fi-{{ $currentLanguage['flag_icon'] }}"></i> &nbsp; {{ $currentLanguage['locale_name'] }}
            </a>
            <ul class="dropdown-menu">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  @foreach (languages() as $key => $lang)
                    <li>
                      <a href="{{ route('admin.languages.change_language', ['code' => $key]) }}">
                        <i class="fi fi-{{ $lang['flag_icon'] }}"></i> {{ $lang['locale_name'] }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              </li>
            </ul>
          </li>

          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">0</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">{{ trans('core::cores.header.notification', ['total' =>  0]) }}</li>
              <li>
                <!-- inner menu: contains the actual data -->
                {{-- <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul> --}}
              </li>
              <li class="footer"><a href="#">{{ trans('core::cores.header.view_all') }}</a></li>
            </ul>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset($user->avatar ?? '/no-profile.webp') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ trans('core::cores.header.welcome', ['user' =>  $user->short_name ?? 'User']) }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset($user->avatar ?? '/no-profile.webp') }}" class="img-circle" alt="User Image">
                <p>
                  {{ $user->fullname ?? '' }}
                  <small>{{ $user->email ?? '' }}</small>
                </p>
              </li>
              {{-- <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li> --}}
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('admin.users.profile') }}" class="btn bg-olive btn-flat btn-sm">{{ trans('core::cores.header.profile') }}</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-flat btn-sm">{{ trans('core::cores.header.logout') }}</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>