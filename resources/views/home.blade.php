@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>{{$user->name}}</p>
                    <p>{{$user->profile->occupation}}</p>
                    <p>{{$user->profile->location}}</p>
                    <p>{{$user->profile->summary}}</p>
                    <p>{{$user->profile->website}}</p>
                    <p><a href="{{ route('profiles.edit') }}">Ubah profile</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
