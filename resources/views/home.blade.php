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
        <div class="tags">
          <div class="tag">UI Designer</div>
          <div class="tag">UX Designer</div>
          <div class="tag">UX Research</div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="portfolio-container">
  <div class="container">
    <div class="row center-xs">
      <div class="col-xs-11 portfolios-header">
        <h3>Portfolio</h3>
        <a href="#" class="btn btn-outline btn-sm" id="edit-portfolio">Add Portfolio</a>
      </div>
    </div>
    <div class="row center-xs">
      <a class="col-xs-11 portfolios">
        <div class="item-wrapper" id="show-portfolio">
          <img src="images/rectangle3.jpg">
          <div class="item-body">
            <span>Logo design for a premier ranch in western U.S.</span>
          </div>
        </div>
      </a>
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
          </form> 
        </div>        
      </div>     
    </div>
  </div>
</div>
<div class="modal" id="modal-portfolio">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Portfolio</h2>
      <button class="btn btn-simple" id="close-portfolio-modal">
        <i class="ion-android-close"></i>
      </button>          
    </div>
    <div class="modal-body">
      <div class="portfolio-form">
        <div class="portfolio-header">
          <label class="portfolio-upload" for="upload-portfolio-img"><i class="ion-ios-camera-outline"></i><span>Upload Thumbnail</span></label>
          <input type="file" accept="image/*" id="upload-portfolio-img">
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 input-label">
            <label>Project Name</label>
            <input id="project-name" type="text" placeholder="My awesome project">
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 col-md-6 input-label">
            <label>Start Date</label>
            <div class="dropdown">
              <select>
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>March</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
              </select>
            </div>
            <div class="dropdown">
              <select>
                <option>2011</option>
                <option>2012</option>
                <option>2013</option>
                <option>2014</option>
                <option>2015</option>
                <option>2016</option>
                <option>2017</option>
                <option>2018</option>
                <option>2019</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-md-6 input-label">
            <label>End Date</label>
            <div class="dropdown">
              <select>
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>March</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>August</option>
                <option>September</option>
                <option>October</option>
                <option>November</option>
                <option>December</option>
              </select>
            </div>
            <div class="dropdown">
              <select>
                <option>2011</option>
                <option>2012</option>
                <option>2013</option>
                <option>2014</option>
                <option>2015</option>
                <option>2016</option>
                <option>2017</option>
                <option>2018</option>
                <option>2019</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 start-xs project-ongoing">
            <input type="checkbox" id="project-ongoing">
            <label for="project-ongoing">Project Ongoing</label>
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 input-label">
            <label>Description</label>
            <textarea id="description" type="text" placeholder="Tell some description of your project"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#" id="save-button-portfolio" class="btn btn-red">Save</a>
    </div>
  </div>
</div>
<div class="modal" id="portfolio-details">
  <div class="modal-content">
    <div class="modal-body">
      <img src="images/rectangle3.jpg">
      <div class="portfolio-desc">
        <div class="top-desc">
          <div class="details">
            <h2 class="title">Developing Gojek for Apple Watch</h2>
            <span class="date-range">2017 January - 2018 January</span>
          </div>
          <div class="actions">
            <a href="#" class="btn btn-outline btn-sm">Edit Portfolio</a>
            <button class="btn btn-simple" id="close-portfolio">
              <i class="ion-android-close"></i>
            </button>
          </div>
        </div>
        <div class="bottom-desc">
          <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <a class="link" href="https://www.teamcookies.id" target="_blank">https://www.teamcookies.id</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection