@extends('layouts.app')

@component('admin.component.content')

<div class="card">
    <h5 class="card-header">
        <b>Roles</b>
        <a href="{{ route('roles.create') }}" class="btn btn-outline-primary">Add Role</a>
    </h5>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Acciones</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>

                        <td>{{  $role->permissions()->pluck('name')->implode(' ') }}</td>
                        <td>
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Acciones
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ route('roles.edit', $role->id) }}" class="dropdown-item">Edit</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                                {!! Form::submit('Delete', ['class' => 'dropdown-item']) !!}
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@endcomponent