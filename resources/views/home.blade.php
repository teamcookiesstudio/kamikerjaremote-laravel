@extends('layouts.main_layout')

@section('content')
<div class="user-cover">
    <div class="container">
      <div class="row center-xs">
        <div class="col-xs-11 col-md-12">
          <img src="https://randomuser.me/api/portraits/men/51.jpg">
          <a class="btn btn-outline btn-sm" href="{{ route('profiles.edit') }}">Ubah profile</a>
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
        <strong class="name">{{$user->first_name}} {{$user->last_name}}</strong>
        <span class="job">{{$user->profile->occupation ?? null}}</span>
        <span class="location">{{$user->profile->location ?? null}}</span>
        <span class="about">{{$user->profile->summary ?? null}}</span>
        <a href="{{$user->profile->website ?? null}}" target="_blank" class="link">{{$user->profile->website ?? null}}</a>
      </div>
    </div>
</div>
@endsection
