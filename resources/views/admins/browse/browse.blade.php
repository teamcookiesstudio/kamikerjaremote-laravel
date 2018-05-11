@extends('admins.layouts.master')

@push('adminstyle')

@endpush

@section('admincontent')

<!-- /.row -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
            <div class="form-group">
                <h5 class="m-t-20"></h5>
                {!! Form::select(null, App\Models\SkillSet::pluck('skill_set_name', 'id')->all(), null, ["id" => "skill", 'class' => 'select2 m-b-10 select2-multiple', 'style'=>'width:100%;', "multiple" => "multiple"]) !!}
                {!! Form::select(null, ['' => 'Tetapkan Lokasi']+$indonesia, null, ['id' => 'city', 'class' => 'form-control select2', 'style'=>'width:100%;']) !!}
            </div>
            <div id="spinner" style="background:url(plugins/images/spinner2.gif) no-repeat center center;"></div>
            @include('admins.browse.partials._result-browse')
        </div>
    </div>
</div>

@endsection

@push('adminscript')
{{ Html::script('admins/js/pages/search.js') }}
@endpush