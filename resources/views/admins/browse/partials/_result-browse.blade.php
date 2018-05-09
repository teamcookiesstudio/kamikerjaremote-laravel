<div id="search-results">
    <div class="comment-center p-t-10">
        @foreach ($model as $key => $value)
            <div class="comment-body">
                <div class="user-img"> 
                    {!! 
                        Html::image(
                            strpos($value->url_photo_profile, 'http') !== false ? 
                            $value->url_photo_profile : 
                            ($value->url_photo_profile != null ? 
                            asset('storage/profile/'.$value->url_photo_profile) : 
                            asset('images/no_avatar.jpg')), 
                            null, array('class' => 'img-circle')
                        ) 
                        !!}
                </div>
                <div class="mail-contnet">
                    <h4><strong>{{ucfirst($value->first_name)}} {{ucfirst($value->last_name)}}</strong></h4>
                    <h5>{{$value->occupation}}</h5>
                    <span class="time">{{$value->location}}</span> 

                    @if ($value->is_approved === 1)
                        <span class="label label-rouded label-success"> APPROVED</span>
                    @elseif ($value->is_approved === 0)
                        <span class="label label-rouded label-danger"> REJECTED</span>
                    @elseif ($value->is_approved === null)
                        <span class="label label-rouded label-info"> WAITING APPROVAL</span>
                <br/><br/> <button class="btn-rounded btn-sm btn-default btn-outline" data-loading-text="Please wait.." member-id="{{$value->id}}" id="approve-button"><i class="ti-check text-success m-r-5"></i>Approve</button> <button class="btn-rounded btn-sm btn-default btn-outline" data-loading-text="Please wait.." member-id="{{$value->id}}" id="reject-button"><i class="ti-close text-danger m-r-5"></i> Reject</button> 
                    @endif
                
                </div>
            </div>
        @endforeach
        </div>
    {{$model->links('vendor.pagination.default')}}
</div>