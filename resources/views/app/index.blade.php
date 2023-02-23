@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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


                    <a href="{{ route('app.create') }}">
                    <button class="btn btn-secondary">Add new app</button>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection