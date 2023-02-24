@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 px-5">
            <div class="d-flex justify-content-end">
                <a href="{{ route('tenant.create') }}">
                    <button class="btn btn-dark px-4 ">Add new app</button>
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Subdomain</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tenants as $tenant)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $tenant->id }} </td>
                                        <td> {{ $tenant->domain->domain }} </td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <a href="{{ route('tenant.edit', $tenant->id) }}"><button class="btn btn-sm btn-dark">Edit</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection