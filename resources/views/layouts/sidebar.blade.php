<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="{{ asset("/imgs/sidebar-1.jpg") }}">
        <div class="logo">
            <a href="/sjdbranchworks/public/" class="simple-text">
                SJD Branch Works
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user">
              <div class="photo">
                <img src="/sjdbranchworks/public/uploads/avatars/{{Auth::user()->avatar}}" alt="profilepic">
              </div>
              <div class="info">
                <a class="collapsed" >
                <span>{{Auth::user()->name}}</span>
                </a>
              </div>

            </div>
            <ul class="nav">
                <li  class="{{Request::is('/') ? 'active' : ''}}">
                    <a href="/sjdbranchworks/public/">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="{{Request::is('ticket-management/create') ? 'active' : ''}}">
                    <a href="{{ route('ticket-management.create')}}">
                        <i class="fa fa-ticket"></i>
                        <p>Create Ticket</p>
                    </a>
                </li>
                @if(Auth::user()->isadmin=='Y')
                <li class="{{Request::is('pages/showassigned') ? 'active' : ''}}">
                    <a href="{{ route('showassigned')}}">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                        <p>Assigned Tickets</p>
                    </a>
                </li>
                <li class="{{Request::is('pages/reports') ? 'active' : ''}}">
                    <a href="{{ route('reports')}}">
                        <i class="fa fa-book"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li class="{{Request::is('ticket-management/managetickets') ? 'active' : ''}}">
                    <a href="{{ route('ticket-management.managetickets')}}">
                        <i class="fa fa-tasks"></i>
                        <p>Manage Tickets</p>
                    </a>
                </li>
                <li class="{{Request::is('user-management/view_users') ? 'active' : ''}}">
                    <a href="{{ route('user-management.view_users')}}">
                        <i class="fa fa-user-plus"></i>
                        <p>User Management</p>
                    </a>
                </li>
                <li class="{{Request::is('pages/filemaintenance') ? 'active' : ''}}">
                    <a href="{{ route('filemaintenance')}}">
                        <i class="material-icons">unarchive</i>
                        <p>File Maintenance</p>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
