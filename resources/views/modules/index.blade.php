@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 px-5">
            <div class="d-flex justify-content-end">
                <a href="{{ route('module.create') }}">
                    <button class="btn btn-dark px-4 ">Add new module</button>
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
                                        <th>Tenant</th>
                                        <th>Domain</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modules as $module)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td class="text-capitalize"> {{ $module->tenant->id }} </td>
                                        <td> {{ $module->tenant->domain->domain }} </td>
                                        <td> {{ $module->name }} </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('module.edit', $module->id) }}"><button class="btn btn-sm btn-dark">Edit</button></a>
                                                <button class="btn btn-sm btn-danger ms-3" onclick="event.preventDefault();
                                                     document.getElementById('modules-delete-form').submit();">Delete</button>

                                                <form id="modules-delete-form" action="{{ route('module.destroy', $module->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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