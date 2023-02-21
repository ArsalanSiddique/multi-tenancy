@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    @if ($errors->any())
                    @php
                    $has_errors = $errors->toArray();
                    @endphp
                    @endif

                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has($msg))
                    <div class="alert card alert-{{ $msg }} alert-dismissible fade show" role="alert">
                        {{ Session::get($msg) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @endforeach

                    <h5 class="card-title">Register new app</h5>
                    <form action="{{ route('app.store') }}" method="POST">

                        @csrf

                        <div class="forn-group">
                            <label for="name">App Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">

                            @if (isset($has_errors["name"]))
                            @foreach ($has_errors["name"] as $error)
                            <span class="text-danger" role="alert">{{ $error }}</span><br>
                            @endforeach
                            @endif

                        </div>

                        <div class="forn-group">
                            <label for="subdomain">App subdomain</label>
                            <input type="text" name="subdomain" id="subdomain" value="{{ old('subdomain') }}" class="form-control @error('subdomain') is-invalid @enderror">

                            @if (isset($has_errors["subdomain"]))
                            @foreach ($has_errors["subdomain"] as $error)
                            <span class="text-danger" role="alert">{{ $error }}</span><br>
                            @endforeach
                            @endif
                        </div>

                        <div class="forn-group">
                            <label for="users">Create dummy users</label>
                            <input type="number" name="users" max="10" id="users" value="{{ old('users') }}" class="form-control @error('users') is-invalid @enderror">

                            @if (isset($has_errors["users"]))
                            @foreach ($has_errors["users"] as $error)
                            <span class="text-danger" role="alert">{{ $error }}</span><br>
                            @endforeach
                            @endif
                        </div>

                        <button class="btn btn-primary mt-2">Register</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection