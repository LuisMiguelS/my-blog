 <div class="list-group">
     <a class="app-list-group-item list-group-item-action" href="{{ route('dashboard.index') }}">
         Dashboard
     </a>

     @can('view', \App\Tag::class)
         <a class="app-list-group-item list-group-item-action" href="{{ route('tags.index') }}">
             Tags
         </a>
     @endcan

     @can('view', \App\Category::class)
         <a class="app-list-group-item list-group-item-action" href="{{ route('categories.index') }}">
             Categorias
         </a>
     @endcan

     @can('view', \App\Post::class)
         <a class="app-list-group-item list-group-item-action"  href="{{ route('posts.index') }}">
             Posts
         </a>
     @endcan

    <a class="app-list-group-item list-group-item-action" href="{{ route('users.index') }}">
        Usuarios
    </a>

    <a class="app-list-group-item list-group-item-action" href="{{ route('profile.index') }}">
        Perfil
    </a>

     @can('only-admin')
         <a class="app-list-group-item list-group-item-action" href="{{ route('settings.index') }}">
             Configuraciones
         </a>
     @endcan

    </div>