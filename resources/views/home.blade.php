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
                    <p>{{$user->first_name}}</p>
                    <p>{{$user->last_name}}</p>
                    <p>{{$user->profile->occupation ?? null}}</p>
                    <p>{{$user->profile->location ?? null}}</p>
                    <p>{{$user->profile->summary ?? null}}</p>
                    <p>{{$user->profile->website ?? null}}</p>
                    <p><a href="{{ route('profiles.edit') }}">Ubah profile</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
