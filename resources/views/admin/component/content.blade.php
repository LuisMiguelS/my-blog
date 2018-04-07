@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="list-group">
                    <a class="app-list-group-item list-group-item-action" href="{{ route('dashboard.index') }}">
                        Dashboard
                    </a>

                    <a class="app-list-group-item list-group-item-action"  href="{{ route('posts.index') }}">
                        Posts
                    </a>

                    <a class="app-list-group-item list-group-item-action" href="{{ route('categories.index') }}">
                        Categorias
                    </a>

                    <a class="app-list-group-item list-group-item-action" href="{{ route('tags.index') }}">
                        Tags
                    </a>

                    <a class="app-list-group-item list-group-item-action" href="{{ route('users.index') }}">
                        Usuarios
                    </a>

                    <a class="app-list-group-item list-group-item-action" href="{{ route('profile.index') }}">
                        Perfil
                    </a>

                    <a class="app-list-group-item list-group-item-action" href=" {{ route('roles.index') }} ">
                        Roles
                    </a>

                    <a class="app-list-group-item list-group-item-action" href="{{ route('permissions.index') }}">
                        Permisos
                    </a>

                    <a class="app-list-group-item list-group-item-action" href="{{ route('settings.index') }}">
                        Configuraciones
                    </a>
                </div>

            </div>
            <div class="col-md-8">
                {{ $slot }}
            </div>
        </div>
    </div>
@endsection