@extends('layouts.main_layout') 
@section('content')
<section class="user-header">
  <div class="user-cover">
    <div class="container">
      <div class="row center-xs">
        <div class="col-xs-11 col-md-12">
          <img src="https://randomuser.me/api/portraits/men/51.jpg">
          <button class="btn btn-outline btn-sm" id="edit-profile">Ubah profile</button>
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
<div id="modal-profile" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Profile</h2>
      <button class="btn btn-simple" id="close-modal">
        <i class="ion-android-close"></i>
      </button>
    </div>
    <div class="modal-body">
      <div class="profile-header">
        <label for="file-cover" class="btn btn-circle btn-sm btn-red" id="edit-cover">
          <i class="ion-edit"></i>
        </label>
        <input type="file" accept="image/*" id="file-cover">
        <div class="profile-img-container">
          <img class="profile-img" src="https://randomuser.me/api/portraits/men/51.jpg">
          <label for="file-avatar" class="btn btn-circle btn-sm btn-red">
            <i class="ion-edit"></i>
          </label>
          <input type="file" accept="image/*" id="file-avatar">
        </div>
      </div>
      <div class="profile-form">
        <form class="form-control">
          {!! Form::open(['route' => 'profiles.update', 'method' => 'patch']) !!} @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="row center-xs">
            <div class="col-xs-12 col-md-6 input-label">
              {!! Form::label('First Name') !!} {!! Form::text('first_name', $user->first_name ?? null) !!} {!! $errors->first('first_name',
              '
              <p class="text-danger">:message</p>') !!}
            </div>
            <div class="col-xs-12 col-md-6 input-label">
              {!! Form::label('Last Name') !!} {!! Form::text('last_name', $user->last_name ?? null) !!} {!! $errors->first('last_name',
              '
              <p class="text-danger">:message</p>') !!}
            </div>
          </div>
          <div class="row center-xs">
            <div class="col-xs-12 input-label">
              {!! Form::label('Current Position') !!} {!! Form::text('occupation', $user->profile->occupation ?? null) !!} {!! $errors->first('occupation',
              '
              <p class="text-danger">:message</p>') !!}
            </div>
          </div>
          <div class="row center-xs">
            <div class="col-xs-12 input-label">
              {!! Form::label('Location') !!} {!! Form::text('location', $user->profile->location ?? null) !!} {!! $errors->first('occupation',
              '
              <p class="text-danger">:message</p>') !!}
            </div>
          </div>
          <div class="row center-xs">
            <div class="col-xs-12 input-label">
              {!! Form::label('Summary') !!} {!! Form::textarea('summary', $user->profile->summary ?? null) !!} {!! $errors->first('summary',
              '
              <p class="text-danger">:message</p>') !!}
            </div>
          </div>
          <div class="row center-xs">
            <div class="col-xs-12 input-label">
              {!! Form::label('Website') !!} {!! Form::text('website', $user->profile->website ?? null) !!} {!! $errors->first('website',
              '
              <p class="text-danger">:message</p>') !!}
            </div>
          </div>

          <div class="modal-footer">
            {!! Form::submit('Simpan', ['class' => 'btn btn-red']) !!}
          </div>

          {!! Form::close() !!}
      </div>
    </div>
@endsection