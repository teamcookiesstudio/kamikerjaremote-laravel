<div id="search-results">
  <span class="result-number">Showing {{$user->total()}} results</span>
  <div class="search-results">
    @foreach($user as $result)
    <a class="no-decoration" href="{{ route('profiles.view_profile', $result->uuid) }}">
        <div class="item-wrapper" routerLink="/user">
          {!! Html::image(
              strpos($result->profile->url_photo_profile, 'http') !== false ? $result->profile->url_photo_profile : ($result->url_photo_profile != null ? asset('storage/profile/'.$result->url_photo_profile) : asset('images/no_avatar.jpg')), 
              null, array('class' => 'user-img')
            ) !!}
          <div class="item-details start-xs">
            <strong class="name">{{$result->first_name}} {{$result->last_name}}</strong>
            <span class="position">{{$result->profile->occupation}}</span>
            <span class="city">{{$result->profile->location}}</span>
          </div>
        </div>
      </a>
    @endforeach
  </div>
  {{$user->links('vendor.pagination.public-default')}}
</div>
