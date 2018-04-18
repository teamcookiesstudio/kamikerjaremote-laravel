@foreach($user as $result)
<a class="no-decoration" href="user-profile.html">
    <div class="item-wrapper" routerLink="/user">
      {!! Html::image(
          $result->url_photo_profile ? asset('storage/profile/'.$result->url_photo_profile) : asset('images/no_avatar.jpg'), 
          null, array('class' => 'user-img')
        ) !!}
      <div class="item-details start-xs">
        <strong class="name">{{$result->first_name}} {{$result->last_name}}</strong>
        <span class="position">{{$result->occupation}}</span>
        <span class="city">{{$result->location}}</span>
      </div>
    </div>
  </a>
@endforeach