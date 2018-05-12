
<section class="user-header" >
        @if (!empty($user->profile))
        <div class="user-cover" style="background: url('{{ $user->profile->image_header ? asset('storage/profile/'.$user->profile->image_header) :  'https://images.unsplash.com/photo-1496112933996-1aa94ac8a23f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=9efbe2dae4aa3b325ab203f8c4bc52b5&auto=format&fit=crop&w=1650&q=80'}}') center no-repeat;">
        @else
        <div class="user-cover" style="background: url('https://images.unsplash.com/photo-1496112933996-1aa94ac8a23f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=9efbe2dae4aa3b325ab203f8c4bc52b5&auto=format&fit=crop&w=1650&q=80') center no-repeat;">  
        @endif 
          <div class="container">
            <div class="row center-xs">
              <div class="col-xs-11 col-md-12">
                {!! Html::image($image, null, array('class' => 'profile-img')) !!}
                @if ($auth = auth()->user())
                  @if ($auth->id==$user->id)
                {!! Form::button('Edit profile', array('class' => 'btn btn-outline btn-sm', 'id' => 'edit-profile', 'type' => 'button')) !!}
                  @endif
                @endif
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
              {!! HTML::link($user->profile->website ?? null, $user->profile->website ?? null, array('class' => 'link', 'target' => '_blank'), true)!!}
              <div class="social">
                @if ($user->profile->facebook)<a href="{{$user->profile->facebook}}" class="fa fa-facebook" target="_blank"></a>@endif
                @if ($user->profile->linkedin)<a href="{{$user->profile->linkedin}}" class="fa fa-linkedin" target="_blank"></a>@endif
                @if ($user->profile->upwork)<a href="{{$user->profile->upwork}}" class="fa icon-upwork" target="_blank"><b>U <i>p</i></b></a>@endif
              </div>
              <br>
              <div class="tags">
              @if (!empty($user->profile))
                @foreach($user->profile->skillsets as $value)
                <div class="tag">{{$value->skill_set_name}}</div>
                @endforeach
              @endif
              </div>
            </div>
          </div>
        </div>
      </section>