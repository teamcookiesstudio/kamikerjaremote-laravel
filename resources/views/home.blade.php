@extends('layouts.main_layout') 
@push('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endpush
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
          @foreach($skillset as $value)
          <div class="tag">{{$value}}</div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<section class="portofolio-container">
  <div class="container">
    <div class="row center-xs">
      <div class="col-xs-11 portofolios-header">
        <h3>portofolio</h3>
        <button class="btn btn-outline btn-sm" id="add-portofolio">Add portofolio</button>
      </div>
    </div>
    <div class="row center-xs">
      <a class="col-xs-11 portofolios">
        @foreach($portofolios as $portofolio)
        <div class="item-wrapper" id="show-portofolio" data-portofolio-id="{{$portofolio->id}}">
          <img src="{{ asset('storage/portofolio/'.$portofolio->thumbnail) }}">
          <div class="item-body">
          <span>{{$portofolio->project_name}}</span>
          </div>
        </div>
        @endforeach
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
          <form class="form-control" id="profile-form"> @if ($errors->any())
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
                  {!! Form::label('Website') !!} {!! Form::text('website', $user->profile->website ?? null, ['id' => 'website']) !!} {!! $errors->first('website',
                  '
                  <p class="text-danger">:message</p>') !!}
                </div>
              </div>
              <div class="row center-xs">
                <div class="col-xs-12 input-label">
                    {!! Form::label("Skill Set") !!}
                    {!! Form::select(null, App\Models\SkillSet::pluck("skill_set_name", "skill_set_name")->all(), $skillset ?? null, ["id" => "skill-set", "multiple" => "multiple"]) !!}
                </div>
              </div>
    
              <div class="modal-footer">
                {!! Form::button('Simpan', ['class' => 'btn btn-red', 'id' => 'save-button-profile']) !!}
              </div>
          </form> 
        </div>        
      </div>     
    </div>
  </div>
</div>
<div class="modal" id="modal-portofolio">
  <div class="modal-content">
    <div class="modal-header">
      <h2>portofolio</h2>
      <button class="btn btn-simple" id="close-portofolio-modal">
        <i class="ion-android-close"></i>
      </button>          
    </div>
    <div class="modal-body">
      <form id="portofolio-form" enctype="multipart/form-data">
      <div class="portofolio-form">
        <div class="portofolio-header">
          <label class="portofolio-upload" for="upload-portofolio-img"><i class="ion-ios-camera-outline"></i><span>Upload Thumbnail</span></label>
          <input type="file" accept="image/*" id="upload-portofolio-img" name="thumbnail">
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 input-label">
            <label>Project Name</label>
            <input id="project-name" type="text" placeholder="My awesome project" name="project_name">
            <input type="hidden" value="{{auth::user()->id}}" id="member-id">
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 input-label">
            <label>Project Url</label>
            <input id="project-url" type="text" placeholder="https://example.com" name="project_url">
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 col-md-6 input-label">
            <label>Start Date</label>
            <div class="dropdown">
              <select id="start-date-month" name="start_date_month">
              </select>
            </div>
            <div class="dropdown">
              <select id="start-date-year" name="start_date_year">
              </select>
            </div>
          </div>
          <div class="col-xs-12 col-md-6 input-label">
            <label>End Date</label>
            <div class="dropdown">
              <select id="end-date-month" name="end_date_month">
              </select>
            </div>
            <div class="dropdown">
              <select id="end-date-year" name="end_date_year">
              </select>
            </div>
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 start-xs project-ongoing">
            <input type="checkbox" id="project-ongoing" name="project_ongoing">
            <label for="project-ongoing">Project Ongoing</label>
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 input-label">
            <label>Description</label>
            <textarea id="description" type="text" placeholder="Tell some description of your project" name="description"></textarea>
          </div>
        </div>
        <div class="row center-xs">
            <div class="col-xs-12 input-label">
              <div id="fine-uploader-manual-trigger"></div>
            </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button id="save-button-portofolio" type="submit"class="btn btn-red">Save</button>
      <button id="update-button-portofolio" class="btn btn-red" style="display:none;">Update</button>
    </div>
  </div>
</form>
</div>
<div class="modal" id="portofolio-details">
  <div class="modal-content">
    <div class="modal-body">
      <img src="images/rectangle3.jpg" id="portofolio-item-image">
      <div class="portofolio-desc">
        <div class="top-desc">
          <div class="details">
            <h2 class="title" id="portofolio-item-project-name">Developing Gojek for Apple Watch</h2>
            <span class="date-range" id="portofolio-item-project-date">2017 January - 2018 January</span>
          </div>
          <div class="actions">
            <button class="btn btn-outline btn-sm" id="edit-portofolio">Edit portofolio</button>
            <button class="btn btn-simple" id="close-portofolio">
              <i class="ion-android-close"></i>
            </button>
          </div>
        </div>
        <div class="bottom-desc">
          <p class="description" id="portofolio-item-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <a class="link" id="portofolio-item-project-url" href="https://www.teamcookies.id" target="_blank">https://www.teamcookies.id</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
jQuery.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });
</script>
<script src="{{ asset('js/pages/profile-page.js') }}"></script>
<script src="{{ asset('js/pages/portofolio-modal.js') }}"></script>
@endpush