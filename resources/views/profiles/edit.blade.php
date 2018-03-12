@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Edit Profile</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'profiles.update', 'method' => 'patch']) !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            {!! Form::label('First Name') !!}
                            {!! Form::text('first_name', $user->first_name ?? null) !!}
                            {!! $errors->first('first_name', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Last Name') !!}
                            {!! Form::text('last_name', $user->last_name ?? null) !!}
                            {!! $errors->first('last_name', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Current Position') !!}
                            {!! Form::text('occupation', $profile->occupation ?? null) !!}
                            {!! $errors->first('occupation', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Summary') !!}
                            {!! Form::textarea('summary', $profile->summary ?? null) !!}
                            {!! $errors->first('summary', '<p class="text-danger">:message</p>') !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Website') !!}
                            {!! Form::text('website', $profile->website ?? null) !!}
                            {!! $errors->first('website', '<p class="text-danger">:message</p>') !!}
                        </div>
                        
                        {!! Form::submit('Simpan') !!}
                    {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
