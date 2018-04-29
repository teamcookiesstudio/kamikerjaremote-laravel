@extends('admins.layouts.master')

@push('adminstyle')
@endpush

@section('admincontent')

<!-- /.row -->
<div class="row">
    <div class="col-md-12 col-lg-3 col-sm-12 col-xs-12">
        <div class="white-box">
            <h3 class="box-title"> Filtering</h3>
        </div>
    </div>
    <div class="col-md-12 col-lg-9 col-sm-12 col-xs-12">
        <div class="white-box" id="slimScroll">
            <h3 class="box-title"> Search Freelancer</h3>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari Freelancer..">
                <span class="input-group-btn">
                    <button type="button" class="btn waves-effect waves-light btn-info">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            <div class="comment-center p-t-10">
            @foreach ($model as $key => $value)
                <div class="comment-body">
                    <div class="user-img"> 
                        {!! 
                            Html::image(
                              strpos($value->profile->url_photo_profile, 'http') !== false ? 
                              $value->profile->url_photo_profile : 
                              ($value->profile->url_photo_profile != null ? 
                              asset('storage/profile/'.$value->profile->url_photo_profile) : 
                              asset('images/no_avatar.jpg')), 
                              null, array('class' => 'img-circle')
                            ) 
                          !!}
                    </div>
                    <div class="mail-contnet">
                        <h4><strong>{{ucfirst($value->first_name)}} {{ucfirst($value->last_name)}}</strong></h4>
                        <h5>{{$value->profile->occupation}}</h5>
                        <span class="time">{{$value->profile->location}}</span> 

                        @if ($value->is_approved == true)
                            <span class="label label-rouded label-success"> APPROVED</span>
                        @elseif ($value->is_approved == false)
                            <span class="label label-rouded label-danger"> REJECTED</span>
                        @else
                            <span class="label label-rouded label-info"> WAITING APPROVAL</span>
                            <br/><br/> <a href="javacript:void(0)" class="btn btn btn-rounded btn-default btn-outline m-r-5"><i class="ti-check text-success m-r-5"></i>Approve</a><a href="javacript:void(0)" class="btn-rounded btn btn-default btn-outline"><i class="ti-close text-danger m-r-5"></i> Reject</a> 
                        @endif
                    
                    </div>
                </div>
            @endforeach
            </div>
            <ul class="pagination">
                <li disabled><a>1</a></li>
            </ul>
        </div>
    </div>
</div>

@endsection

@push('adminscript')
<script>
    $(function () {
        $('#slimScroll').slimScroll({
            height: '500px'      
        });
    })
</script>
@endpush