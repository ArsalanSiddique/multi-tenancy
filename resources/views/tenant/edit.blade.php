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
                    <form action="{{ route('tenant.update', $tenant->id) }}" method="PUT">

                        @csrf
                        @method('PUT')

                        <div class="forn-group mt-3">
                            <label for="name">App Name</label>
                            <input type="text" name="name" id="name" value="{{ $tenant->id }}" class="form-control @error('name') is-invalid @enderror">

                            @if (isset($has_errors["name"]))
                            @foreach ($has_errors["name"] as $error)
                            <span class="text-danger" role="alert">{{ $error }}</span><br>
                            @endforeach
                            @endif

                        </div>

                        <div class="forn-group mt-3">
                            <label for="subdomain">App subdomain</label>
                            <input type="text" name="subdomain" id="subdomain" value="{{ $tenant->domain->domain }}" class="form-control @error('subdomain') is-invalid @enderror">

                            @if (isset($has_errors["subdomain"]))
                            @foreach ($has_errors["subdomain"] as $error)
                            <span class="text-danger" role="alert">{{ $error }}</span><br>
                            @endforeach
                            @endif
                        </div>

                        <button class="btn btn-dark px-4 mt-4">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection