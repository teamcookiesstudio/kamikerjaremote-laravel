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
                    <button type="button" id="properties" data-toggle="modal" data-target="#myModal" class="btn waves-effect waves-light btn-info">
                        <i class="fa fa-gear"></i>
                    </button>
                </span>
            </div>
            <div id="spinner" style="background:url(plugins/images/spinner2.gif) no-repeat center center;"></div>
            @include('admins.browse.partials._result-browse')
        </div>
    </div>

    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"></h4> </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h5 class="m-t-20">Pilih Skill</h5>
                        {!! Form::select(null, App\Models\SkillSet::pluck('skill_set_name', 'id')->all(), null, ["id" => "skill", 'class' => 'select2 m-b-10 select2-multiple', 'style'=>'width:100%', "multiple" => "multiple"]) !!}
                    </div>
                    <div class="form-group">
                        <h5 class="m-t-20">Pilih Kota</h5>
                        {!! Form::select(null, ['' => 'Select']+$indonesia, null, ['id' => 'city', 'class' => 'form-control select2', 'style'=>'width:100%']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success waves-effect" id="simpan" data-dismiss="modal"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>

@endsection

@push('adminscript')
{{ Html::script('admins/js/pages/search.js') }}
@endpush