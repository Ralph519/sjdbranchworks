@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="#"> File Maintenance </a>
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Masterfiles</h4>
                        <p class="category">Click an item to modify</p>
                    </div>
                    <div class="card-content">

                      <div class="col-sm-3">
                        <div class="choice">
                          <div class="icon">
                            <a href="{{ route('branches-management.create')}}" class="fa fa-sitemap  iconmain"></a>
                          </div>
                          <h6 class="iconhead">Branches</h6>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="choice">
                          <div class="icon">
                            <a href="{{ route('issuetypes-management.create')}}" class="fa fa-phone  iconmain"></a>
                          </div>
                          <h6 class="iconhead">Issues Reported</h6>
                        </div>
                      </div>

                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
