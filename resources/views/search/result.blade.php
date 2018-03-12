@extends('search')

@section('content')
  <div class="search-wrapper">
    <div class="container">
      <div class="row center-xs start-md">
        <div class="col-xs-12 col-md-8">
          <div class="input-control search-box">
            <label class="icon-search" for="search"></label>
            <input type="text" id="search" placeholder="Cari Freelancer Anda di sini">
            <a class="btn btn-primary" href="search.html">Cari</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="search-result">
    <div class="container">
      <div class="row center-xs start-md">
        <div class="col-xs-11 col-md-8 center-xs start-md">
          <span class="result-number">Showing 20 results</span>
          <div class="search-results">
            <a class="no-decoration" href="user-profile.html">
                <div class="item-wrapper" routerLink="/user">
                  <img src="https://randomuser.me/api/portraits/men/51.jpg" class="user-img">
                  <div class="item-details start-xs">
                    <strong class="name">{{$q}}</strong>
                    <span class="position">{{$q}}</span>
                    <span class="city">{{$q}}</span>
                  </div>
                </div>
              </a>
          </div>
          <div class="pagination center-xs start-md">
            <div class="arrows">
              <i class="ion-ios-arrow-back"></i>
            </div>
            <ul class="pages">
              <li class="active">1</li>
              <li>2</li>
              <li>3</li>
              <li>4</li>
              <li>5</li>
            </ul>
            <div class="arrows">
              <i class="ion-ios-arrow-forward"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
