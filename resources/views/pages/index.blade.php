@extends('layouts.app')

@section('headtitle')
  <a class="navbar-brand" href="/sjdbranchworks/public/"> Dashboard </a>
@endsection

@if(Auth::user()->isadmin=='Y')
  @include('pages.adminindex')
@else
  @include('pages.nonadminindex')
@endif
