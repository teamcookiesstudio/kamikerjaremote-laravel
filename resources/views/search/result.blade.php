@extends('layouts.search')

@push('searchstyle')

@endpush

@section('content')
  <div class="search-wrapper">
    <div class="container">
      <div class="row center-xs start-md">
        <div class="col-xs-12 col-md-8">
          <form >
            <div class="input-control search-box">
              <label class="icon-search" for="search"></label>
              <input type="text" id="input-search-2" name="q" placeholder="Cari Freelancer Anda di sini">
              <button class="btn btn-primary" id="submit-search-2" type="button">Cari</button>
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
          
            <div id="spinner" style="background:url(plugins/images/spinner2.gif) no-repeat center center;"></div>
            
            @include('search.partial-result')

        </div>
      </div>
    </div>
  </div>

@endsection
@push('searchscript')
{{Html::script(asset('js/pages/search.js'))}}
@endpush