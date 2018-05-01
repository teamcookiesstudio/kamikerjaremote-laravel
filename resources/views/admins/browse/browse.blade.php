@extends('admins.layouts.master')

@push('adminstyle')
{{ Html::style('admins/css/bootstrap-tagsinput.css') }}
{{ Html::style('admins/css/typehead-min.css') }}
@endpush

@section('admincontent')

<!-- /.row -->
<div class="row">
    <div class="col-md-12 col-lg-3 col-sm-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title"> Filtering</h3>
            <div class="tags-default">
                <input type="text" id="skill-set" placeholder="Pilih skill.." data-role="tagsinput"/>
            </div>
            <br>
            <button class="btn btn-primary btn-block btn-sm">Bersihkan Skill</button>
        </div>
    </div>
    <div class="col-md-12 col-lg-9 col-sm-12 col-xs-12">
        <div class="white-box" id="slimScroll">
            <h3 class="box-title"> Search Freelancer</h3>
            <div class="input-group">
                <input type="text" id="input-search-freelancer" class="form-control" placeholder="Search Freelancer.." />
                <span class="input-group-btn">
                    <button type="button" id="button-search-freelancer" class="btn waves-effect waves-light btn-info">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            <div id="spinner" style="background:url(plugins/images/spinner2.gif) no-repeat center center;"></div>
            @include('admins.browse.partials._result-browse')
        </div>
    </div>
</div>

@endsection

@push('adminscript')
{{ Html::script('admins/js/typeahead.bundle.js') }}
{{ Html::script('admins/js/bootstrap-tagsinput.min.js') }}
{{ Html::script('admins/js/pages/search.js') }}
@endpush