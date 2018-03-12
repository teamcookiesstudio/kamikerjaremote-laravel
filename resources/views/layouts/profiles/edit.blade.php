@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Edit Profile</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'profiles.edit']) !!}
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
                            {!! Form::label('Jumlah pinjaman') !!}
                            {!! Form::number('amount', null) !!}
                            {!! $errors->first('amount', '<p class="text-danger">:message</p>') !!}
                        </div>
                        
                        {!! Form::submit('Simpan') !!}
                    {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection