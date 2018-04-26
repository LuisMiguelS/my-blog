@extends('layouts.app')

@component('component.content-admin')

    <div class="card shadow-sm">
        <h5 class="card-header bg-white font-weight-bold">
            Mis Borradores
            <a class="btn btn-primary" href="{{ route('posts.create') }}">Crear Post</a>
            <a class="btn btn-outline-secondary" href="{{ route('posts.index') }}">
                Publicaciones
                @if($posts)
                    ({{$posts}})
                @endif
            </a>

            @can('only-admin')
                <a class="btn btn-outline-danger float-right" href="{{ route('posts.trashed') }}">Post Eliminados</a>
            @endcan

        </h5>
        <div class="card-body bg-light">
            <div class="table-responsive">
                <table class="table table-hover">
                <thead>
                <th>Imagen</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Fecha de publicacion</th>
                <th>Fecha de actualizacion</th>
                <th>Acciones</th>
                </thead>

                <tbody>
                @if($drafts->count() > 0)

                    @foreach($drafts as $draft)
                        <tr>
                            <td><img class="img-thumbnail" src="{{ $draft->image }}" width="100px" height="100"></td>

                            <td>{{ $draft->title }}</td>

                            <td>{{ optional($draft->user)->name }}</td>

                            <td>{{ $draft->created_at->format('l d, F Y') }}</td>

                            <td>{{ $draft->updated_at->format('l d, F Y') }}</td>


                            <td>
                                <button class="btn bg-white shadow-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            </div>
            {{ $drafts->links() }}
        </div>
    </div>

@endcomponent