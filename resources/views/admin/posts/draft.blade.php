@extends('layouts.app')

@component('admin.component.content')

    <div class="card">
        <h5 class="card-header">
            <b>Mis Borradores</b>
            <a class="btn btn-primary" href="{{ route('posts.create') }}">Crear Post</a>
            <a class="btn btn-outline-primary" href="{{ route('posts.index') }}">
                Publicaciones
                @if($posts > 0)
                    ({{$posts}})
                @endif
            </a>
            <a class="btn btn-outline-danger" href="{{ route('posts.trashed') }}">Post Eliminados</a>
        </h5>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th>Imagen</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Acciones</th>
                </thead>

                <tbody>
                @if($drafts->count() > 0)

                    @foreach($drafts as $draft)
                        <tr>
                            <td><img class="img-thumbnail" src="{{ $draft->image }}" width="100px" height="100"></td>

                            <td>{{ $draft->title }}</td>

                            <td>{{ optional($draft->user)->name }}</td>

                            <td>
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu">
                                    @can('update', $draft)
                                        <a  class="dropdown-item" href="{{ $draft->url->edit }}" >Editar</a>
                                    @endcan

                                    @can('delete', $draft)
                                        {{ Form::open(['url' => $draft->url->delete, 'method' => 'DELETE']) }}
                                        {{ Form::submit(__('Eliminar'), ['class' => 'dropdown-item']) }}
                                        {{ Form::close() }}
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <th colspan="5" class="text-center">Sin Borradores aún.</th>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $drafts->links() }}
        </div>
    </div>

@endcomponent