<div id="search-results">
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
    {{$model->links('vendor.pagination.default')}}
</div>