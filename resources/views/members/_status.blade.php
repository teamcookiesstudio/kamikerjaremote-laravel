@switch ($member->status) 
    @case('rejected')
        @break
    @case('approved')
        @break
    @case('waiting approval')

        <div class="row">
            <div class="col-4">
                {!! Form::model($member, ['route' => ['members.approve', $member->id], 'method' => 'patch', 'class' => 'form-inline'] ) !!}
                    {!! Form::submit('Approve', ['class'=>'btn btn-sm btn-primary']) !!}
                {!! Form::close()!!}
            </div>
            <div class="col-4">

                {!! Form::model($member, ['route' => ['members.reject', $member->id], 'method' => 'patch', 'class' => 'form-inline'] ) !!}
                    {!! Form::submit('Reject', ['class'=>'btn btn-sm btn-danger']) !!}
                {!! Form::close()!!}
            </div>
        </div>
        @break
@endswitch

