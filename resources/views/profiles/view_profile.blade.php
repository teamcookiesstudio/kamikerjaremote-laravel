@extends('layouts.main_layout')

@section('content')
<section class="user-header">
  <div class="user-cover" style="background: url('{{ $user->profile->image_header ? asset('storage/profile/'.$user->profile->image_header) :  'https://images.unsplash.com/photo-1496112933996-1aa94ac8a23f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=9efbe2dae4aa3b325ab203f8c4bc52b5&auto=format&fit=crop&w=1650&q=80'}}') center no-repeat;">
    <div class="container">
      <div class="row center-xs">
        <div class="col-xs-11 col-md-12">
          <img src="{{$image}}">
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
</section>
@endsection
