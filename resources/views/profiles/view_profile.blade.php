@extends('layouts.main_layout')

@section('content')
<div class="user-cover">
    <div class="container">
      <div class="row center-xs">
        <div class="col-xs-11 col-md-12">
          <img src="https://randomuser.me/api/portraits/men/51.jpg">
        </div>
      </div>
    </div>
</div>
<div class="container user">
    <div class="row center-xs">
      <div class="user-info col-xs-11 col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <strong class="name">{{$profileHash}}</strong>
        <span class="job">{{$profileHash}}</span>
        <span class="location">{{$profileHash}}</span>
        <span class="about">{{$profileHash}}</span>
        <a href="{{$profileHash}}" target="_blank" class="link">{{$profileHash}}</a>
      </div>
    </div>
</div>
@endsection
