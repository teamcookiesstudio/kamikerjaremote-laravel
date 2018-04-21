@extends('layouts.search')

@section('content')
  <div class="search-wrapper">
    <div class="container">
      <div class="row center-xs start-md">
        <div class="col-xs-12 col-md-8">
          <form action="{{route('search.result')}}">
            <div class="input-control search-box">
              <label class="icon-search" for="search"></label>
              <input type="text" id="search" name="q" placeholder="Cari Freelancer Anda di sini">
              <button class="btn btn-primary" type="submit">Cari</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="search-result">
    <div class="container">
      <div class="row center-xs start-md">
        <div class="col-xs-11 col-md-8 center-xs start-md">
          <span class="result-number">Showing {{$user->total()}} results</span>
          <div class="search-results" id="search">
            @include('search.partial-result')
          </div>
          {{$user->links('vendor.pagination.default')}}
        </div>
      </div>
    </div>
  </div>

@endsection
@push('script')
{{Html::script(asset('js/pages/search.js'))}}
@endpush