<div class="main-panel">
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @yield('headtitle')
              </div>
            <div class="collapse navbar-collapse">
                <input id="loggeduserid" type="hidden" name="" value="{{ Auth::user()->id }} ">
                <input id="loggedadmintype" type="hidden" name="" value="{{ Auth::user()->isadmin }} ">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/sjdbranchworks/public/" class="dropdown-toggle">
                            <i class="material-icons">dashboard</i>
                            <p class="hidden-lg hidden-md">Dashboard</p>
                        </a>
                    </li>
                    <li class="dropdown" id="markAsRead">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="notificon">
                            <i class="material-icons">notifications</i>
                              @if(count(auth()->user()->unreadnotifications) != 0)
                                <span id="notifcount" class="notification">{{count(auth()->user()->unreadnotifications)}}</span>
                              @endif
                            <p class="hidden-lg hidden-md">Notifications</p>
                        </a>
                        <ul class="dropdown-menu" id="notif_ul" style="width: 260px;">
                          <?php $count = 0; ?>
                            @forelse(auth()->user()->notifications as $notification)
                            <?php if($count == 5) break; ?>
                            <li>
                              <a href="{{ route('ticket-management.notificationview', ['ticketid' => $notification->data['ticketid']]) }}">
                                <div class="pull-left">
                                  <img src="/sjdbranchworks/public/uploads/avatars/{{ $notification->data['avatar']}}.jpg" class="img-circle" alt="User Image">
                                </div>
                                <h7>
                                  @if($notification->data['notiftype']==1)
                                    {{$notification->data['notificationby']}} created a new ticket
                                    <p class="notifitem">{{$notification->data['notifissue'] . ' - ' . $notification->data['priority'] . ' priority' }}</p>
                                  @elseif($notification->data['notiftype']==2)
                                    {{$notification->data['notificationby']}} assigned you a ticket
                                    <p class="notifitem">{{$notification->data['notifissue'] . ' - ' . $notification->data['priority'] . ' priority' }}</p>
                                  @else
                                    Ticket No. {{$notification->data['ticketno']}}
                                    <p><small>is closed by {{$notification->data['notificationby']}}</small></p>
                                  @endif
                                </h7>
                                <p style="padding-left: 30px;"><small><i class="fa fa-clock-o"></i> {{$notification->created_at->diffForHumans()}}</small></p>
                              </a>
                            </li>
                            <?php $count++; ?>
                            @empty
                            <li>
                              <a href="#">No unread notification</a>
                            </li>
                            @endforelse
                        </ul>
                    </li>
                    <li>
                        <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="material-icons">person</i>
                            <p class="hidden-lg hidden-md">Profile</p>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('user-management.profile') }}">Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('user-management.show_change_password') }}">Change Password</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @if(Auth::user()->isadmin=='Y')
                <form action="{{ route('searchresult') }}" method="POST" class="navbar-form navbar-right" role="search">
                    {{ csrf_field() }}
                    <div class="form-group  is-empty">
                        <input type="text" name="ticketno" id="ticketno" class="form-control" placeholder="Search Ticket / Topics">
                        <span class="material-input"></span>
                    </div>
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </form>
                @endif
            </div>
        </div>
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
