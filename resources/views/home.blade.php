@extends('layouts.main_layout') 

@push('style')
{!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css') !!}
{!! Html::style('plugins/pace/themes/white/pace-theme-flash.css') !!}
<style>
.fa {
  padding: 10px;
  font-size: 21px;
  width: 25px;
  text-align: center;
  text-decoration: none;
  margin: 4px 4px;
  border-radius: 50%;
}

.social {
  display: flex;
  list-style-type: none;
}

.fa:hover {
    opacity: 0.7;
}

a.icon-upwork {
  color: white;
  background: yellowgreen;
  margin-right: 3px;
  letter-spacing: -3px;
  font-family: Arial, Helvetica, sans-serif;
}

.fa-linkedin {
  background: #007bb5;
  color: white;
}

.fa-facebook {
  background: #3B5998;
  color: white;
}
</style>
@endpush

@section('content')
<input type="hidden" id="portofolio-show" value="{{route('portofolios.show', $user->id)}}">
<input type="hidden" id="save-profile-post" value="{{route('profiles.update', $user->id)}}">
<input type="hidden" id="save-portofolio-post" value="{{route('portofolios.store')}}">

<div id="profile-section">
  @include('_home')
</div>

<section class="portofolio-container">
  <div class="container">
    <div class="row center-xs">
      <div class="col-xs-11 portofolios-header">
        <h3>portofolio</h3>
        @if ($auth = auth()->user())
          @if ($auth->id==$user->id)
        {!! Form::button('Add portofolio', array('class' => 'btn btn-outline btn-sm', 'id' => 'add-portofolio', 'type' => 'button')) !!}
          @endif
        @endif
      </div>
    </div>
    <div class="row center-xs">
      <a class="col-xs-11 portofolios">
        @foreach($user->portofolio as $portofolio)
        <div class="item-wrapper" id="show-portofolio" data-portofolio-id="{{$portofolio->id}}">
          {!! Html::image(asset('storage/portofolio/'.$portofolio->thumbnail), null, array('class' => 'profile-img')) !!}
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
        {!! Form::button('<i class="ion-android-close"></i>', array('class' => 'btn btn-simple', 'id' => 'close-modal')) !!}
      </div>
      <div class="modal-body">
      @if (!empty($user->profile))
        <div class="profile-header" style="background: url('{{ $user->profile->image_header ? asset('storage/profile/'.$user->profile->image_header) :  'https://images.unsplash.com/photo-1496112933996-1aa94ac8a23f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=9efbe2dae4aa3b325ab203f8c4bc52b5&auto=format&fit=crop&w=1650&q=80'}}') center no-repeat;
        ">
      @else
      <div class="profile-header" style="background: url('https://images.unsplash.com/photo-1496112933996-1aa94ac8a23f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=9efbe2dae4aa3b325ab203f8c4bc52b5&auto=format&fit=crop&w=1650&q=80') center no-repeat;
          ">
      @endif
          {!! 
              Html::decode(
              Form::label(
                  'file-cover', 
                  '<i class="ion-edit"></i>', 
                  array('class' => 'btn btn-circle btn-sm btn-red', 'id' => 'edit-cover')
                )
              ) 
          !!}
          {!! Form::file('file-cover', array('id' => 'file-cover', 'accept' => 'image/*')) !!}

          <div class="profile-img-container">
            {!! Html::image($image, null, array('class' => 'profile-img', 'id' => 'profile-image')) !!}
            {!! 
                Html::decode(
                Form::label(
                  'file-avatar', 
                  '<i class="ion-edit"></i>', 
                  array('class' => 'btn btn-circle btn-sm btn-red', 'id' => 'edit-cover')
                  )
                ) 
            !!}
            {!! Form::file('file-avatar', array('id' => 'file-avatar', 'accept' => 'image/*')) !!}
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
                  {!! Form::label('First Name') !!} {!! Form::text('first_name', $user->first_name ?? null, ['required', 'placeholder' => 'First name']) !!} {!! $errors->first('first_name',
                  '
                  <p class="text-danger">:message</p>') !!}
                </div>
                <div class="col-xs-12 col-md-6 input-label">
                  {!! Form::label('Last Name') !!} {!! Form::text('last_name', $user->last_name ?? null, ['required', 'placeholder' => 'Last name']) !!} {!! $errors->first('last_name',
                  '
                  <p class="text-danger">:message</p>') !!}
                </div>
              </div>
              <div class="row center-xs">
                <div class="col-xs-12 input-label">
                  {!! Form::label('Current Position') !!} {!! Form::text('occupation', $user->profile->occupation ?? null, ['placeholder' => 'Occupation']) !!} {!! $errors->first('occupation',
                  '
                  <p class="text-danger">:message</p>') !!}
                </div>
              </div>
              <div class="row center-xs">
                <div class="col-xs-12 input-label">
                  {!! Form::label('Location') !!} {!! Form::text('location', $user->profile->location ?? null, ['placeholder' => 'Location']) !!} {!! $errors->first('occupation',
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
                  {!! Form::label('Website') !!} {!! Form::text('website', $user->profile->website ?? null, ['id' => 'website', 'placeholder' => 'https://example.com']) !!} {!! $errors->first('website',
                  '
                  <p class="text-danger">:message</p>') !!}
                </div>
              </div>
              <div class="row center-xs">
                <div class="col-xs-12 input-label">
                  {!! Form::label('Facebook') !!} {!! Form::text('facebook', $user->profile->facebook ?? null, ['id' => 'facebook', 'placeholder' => 'https://facebook.com/kamikerjaremote']) !!} {!! $errors->first('website',
                  '
                  <p class="text-danger">:message</p>') !!}
                </div>
              </div>
              <div class="row center-xs">
                <div class="col-xs-12 input-label">
                  {!! Form::label('Linkedin') !!} {!! Form::text('linkedin', $user->profile->linkedin ?? null, ['id' => 'linkedin', 'placeholder' => 'https://linkedin.com/kamikerjaremote']) !!} {!! $errors->first('website',
                  '
                  <p class="text-danger">:message</p>') !!}
                </div>
              </div>
              <div class="row center-xs">
                <div class="col-xs-12 input-label">
                  {!! Form::label('upwork') !!} {!! Form::text('upwork', $user->profile->upwork ?? null, ['id' => 'upwork', 'placeholder' => 'https://upwork.com/kamikerjaremote']) !!} {!! $errors->first('website',
                  '
                  <p class="text-danger">:message</p>') !!}
                </div>
              </div>
              <div class="row center-xs">
                <div class="col-xs-12 input-label">
                    {!! Form::label("Skill Set") !!}
                    <select id="skill-set" multiple>
                    @if (!empty($user->profile))
                      @foreach($user->profile->skillsets as $skill)
                        <option value="{{$skill->skill_set_name}}" selected>{{$skill->skill_set_name}}</option>
                      @endforeach
                    @endif
                    </select>
                    {{-- {!! Form::select(null, App\Models\SkillSet::pluck("skill_set_name", "skill_set_name")->all(), $user->profile->skillsets ?? null, ["id" => "skill-set", "multiple" => "multiple"]) !!} --}}
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
      {!! Form::button('<i class="ion-android-close"></i>', array('class' => 'btn btn-simple', 'id' => 'close-portofolio-modal')) !!}
    </div>
    <div class="modal-body">
      {!! Form::open(array('id' => 'portofolio-form', 'enctype' => 'multipart/form-data')) !!}
      <div class="portofolio-form">
        <div class="portofolio-header">
          {!! 
            Html::decode(
            Form::label(
                'upload-portofolio-img', 
                '<i class="ion-ios-camera-outline"></i><span>Upload Thumbnail</span>', 
                array('class' => 'portofolio-upload')
              )
            ) 
        !!}
        {!! Form::file('thumbnail', array('id' => 'upload-portofolio-img', 'accept' => 'image/*')) !!}
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 input-label">
            {!! Form::label('Project Name') !!}
            {!! Form::text('project_name', null, array('id' => 'project-name', 'placeholder' => 'My awesome project', 'required')) !!}
            {!! Form::hidden(null, auth::user()->id ?? null, array('id' => 'member-id')) !!}
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 input-label">
            {!! Form::label('Project Url') !!}
            {!! Form::text('project_url', null, array('id' => 'project-url', 'placeholder' => 'https://example.com')) !!}
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 col-md-6 input-label">
            {!! Form::label('Start Date') !!}
            <div class="dropdown">
              {!! Form::select('start_date_month', array(), null, array('id' => 'start-date-month')) !!}
            </div>
            <div class="dropdown">
              {!! Form::select('start_date_year', array(), null, array('id' => 'start-date-year')) !!}
            </div>
          </div>
          <div class="col-xs-12 col-md-6 input-label">
            {!! Form::label('End Date') !!}
            <div class="dropdown">
              {!! Form::select('end_date_month', array(), null, array('id' => 'end-date-month')) !!}
            </div>
            <div class="dropdown">
              {!! Form::select('end_date_year', array(), null, array('id' => 'end-date-year')) !!}
            </div>
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 start-xs project-ongoing">
            {!! Form::checkbox('project_ongoing', null, false, array('id' => 'project-ongoing')) !!}
            {!! Form::label('project-ongoing', 'Project Ongoing') !!}
          </div>
        </div>
        <div class="row center-xs">
          <div class="col-xs-12 input-label">
            {!! Form::label('Description') !!}
            {!! Form::textarea('description', null, array('placeholder' => 'Tell some description of your project', 'id' => 'description')) !!}
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
      {!! Form::button('Save', array('class' => 'btn btn-red', 'id' => 'save-button-portofolio')) !!}
      {!! Form::button('Update', array('class' => 'btn btn-red', 'id' => 'update-button-portofolio', 'style' => 'display:none;')) !!}
    </div>
  </div>
{!! Form::close() !!}
</div>
<div class="modal" id="portofolio-details">
  <div class="modal-content">
    <div class="modal-body">
      {!! 
        Html::image(
          '#', 
          null, array('id' => 'portofolio-item-image')
        ) 
      !!}
      <div class="portofolio-desc">
        <div class="top-desc">
          <div class="details">
            <h2 class="title" id="portofolio-item-project-name">Developing Gojek for Apple Watch</h2>
            <span class="date-range" id="portofolio-item-project-date">2017 January - 2018 January</span>
          </div>
          <div class="actions">
            @if ($auth = auth()->user())
              @if ($auth->id==$user->id)
            {!! Form::button('Edit portofolio', array('class' => 'btn btn-outline btn-sm', 'id' => 'edit-portofolio', 'type' => 'button')) !!}
              @endif
            @endif
            {!! Form::button('<i class="ion-android-close"></i>', array('class' => 'btn btn-simple', 'id' => 'close-portofolio', 'type' => 'button')) !!}
          </div>
        </div>
        <div class="bottom-desc">
          <p class="description" id="portofolio-item-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          {!! HTML::link('https://www.teamcookies.id', 'https://www.teamcookies.id', array('class' => 'link', 'id' => 'portofolio-item-project-url', 'target' => '_blank'), true)!!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
jQuery.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });
</script>
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js') !!}
{!! Html::script(asset('js/pages/profile-page.js')) !!}
{!! Html::script(asset('js/pages/portofolio-modal.js')) !!}
@endpush