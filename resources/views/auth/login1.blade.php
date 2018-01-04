<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
        <link rel="stylesheet" href="{{ asset("/css/bootstrap.min.css")}}">

        <link rel="stylesheet" href="{{ asset("/css/style.css")}}">
        <link rel="stylesheet" href="{{ asset("/css/login-register.css")}}">
        <link rel="stylesheet" href="{{ asset("/css/material-dashboard.css")}}">

        <link rel="stylesheet" href="{{ asset("/css/materialdesignicons.css")}}">
        <link rel="stylesheet" href="{{ asset("/css/materialdesignicons.min.css")}}">

        <script type="text/javascript" src="{{ asset("/jquery/jquery-1.10.2.js")}}"></script>
        <script type="text/javascript" src="{{ asset("/js/bootstrap.js")}}"></script>

        <title>St. Joseph Drugstore Employee Self Service</title>

    </head>
    <body>


      <nav class="navbar navbar-primary navbar-transparent navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SJD Employee Self Service</a>
          </div>
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="javascript:void(0)" onclick="openLoginModal();">Show Login</a></li>
              <li><a href="#about">Lock</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>

      <header id="loginshowcase">
      </header>

      <div class="content">
        <div class="container-fluid">
            <div class="row">

		    <div class="modal fade login" id="loginModal">
		      <div class="modal-dialog login animated">
    		      <div class="modal-content">
                    <div class="modal-body">
                        <div class="box">
                             <div class="content">
                              <div class="modal-header">
                                <h4 class="modal-title">Login</h4>
                              </div>
                                <div class="error"></div>
                                <div class="form loginBox">
                                    <form method="post" action="{{ route('login') }}">
                                      {{ csrf_field() }}
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="mdi mdi-face mdi-24px"></i></span>
                                      <div class="form-group{{ $errors->has('empno') ? ' has-error' : '' }} label-floating">
                                        <label class="control-label">Employee No.</label>
                                        <input id="empno" class="form-control" type="text" name="empno" value="{{ old('empno') }}" required autofocus="">

                                        @if ($errors->has('empno'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('empno') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                    </div>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="mdi mdi-lock-outline mdi-24px"></i></span>
                                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} label-floating">
                                        <label class="control-label">Password</label>
                                        <input id="password" class="form-control" type="password" name="password" required>

                                        @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                        @endif

                                      </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                      <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">login</button>
                                    </div>
                                    <!-- <a href="#" value="Login" onclick="loginAjax()">Login</a> -->
                                    </form>
                                </div>
                             </div>
                        </div>
                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                             <div class="form">
                                <form method="post" html="{:multipart=>true}" data-remote="true" action="/register" accept-charset="UTF-8">
                                <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                                <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                                <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                                <input class="btn btn-default btn-register" type="submit" value="Create account" name="commit">
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
    		      </div>
		      </div>
  		  </div>
      </div>
    </div>
  </div>
</div>
    </body>
</html>

<!-- <script src="{{ asset("/js/bootstrap.min.js")}}"></script> -->
<script src="{{ asset('/js/app.js') }}"></script>
<script src="{{ asset("/js/material.min.js")}}"></script>
<script src="{{ asset("/js/arrive.min.js")}}"></script>
<script src="{{ asset("/js/login-register.js") }}"></script>
<script src="{{ asset("/js/perfect-scrollbar.jquery.min.js")}}"></script>
<script src="{{ asset("/js/material-dashboard.js")}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        openLoginModal();
    });
</script>
