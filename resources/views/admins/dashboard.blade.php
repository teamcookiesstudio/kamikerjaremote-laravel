@extends('admins.layouts.master')

@push('adminstyle')

@endpush

@section('admincontent')

<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">APPROVED</h3>
            <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash"></div>
                </li>
                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">{{$approved}}</span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">WAITING APPROVAL</h3>
            <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash2"></div>
                </li>
                <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">{{$waitingApproval}}</span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">REJECTED</h3>
            <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash3"></div>
                </li>
                <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">{{$rejected}}</span></li>
            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box analytics-info">
            <h3 class="box-title">REGISTERED MEMBERS</h3>
            <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash4"></div>
                </li>
                <li class="text-right"><i class="ti-arrow-down text-danger"></i> <span class="text-danger">{{ App\User::member()->count() }}</span></li>
            </ul>
        </div>
    </div>
  </div>
  <!--/.row -->
  <!--row -->
  <!-- /.row -->
 <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="white-box">
            <div id="chart">
                {!! $chart->html() !!} 
            </div>
       </div>
    </div>
</div>

@endsection

@push('adminscript')
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
{!! $chart->script() !!}
@endpush