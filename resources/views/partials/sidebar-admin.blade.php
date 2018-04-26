 <div class="list-group app-list">
     <h6 class="app-sidebar-label">
         ANALISIS
     </h6>
     <a class="app-list-group-item list-group-item-action

        {{ request()->is('admin/dashboard') ? 'app-active' : '' }}"

        href="{{ route('dashboard.index') }}">

         <i class="fas fa-tachometer-alt"></i>

         Dashboard
     </a>
 </div>


 <div class="list-group app-list">
     <h6  class="app-sidebar-label">
         ADMINISTRAR
     </h6>

     @can('view', \App\Tag::class)
         <a class="app-list-group-item list-group-item-action

            {{ request()->is('admin/tags') ? 'app-active' : '' }}

            {{ request()->is('admin/tags/*') ? 'app-active' : '' }}"

            href="{{ route('tags.index') }}">

             <i class="fas fa-tags"></i>

             Tags
         </a>
     @endcan

     @can('view', \App\Category::class)
         <a class="app-list-group-item list-group-item-action

            {{ request()->is('admin/categories') ? 'app-active' : '' }}

            {{ request()->is('admin/categories/*') ? 'app-active' : '' }}"

            href="{{ route('categories.index') }}">

             <i class="fas fa-clipboard-list"></i>

             Categorias
         </a>
     @endcan

     @can('view', \App\Post::class)
         <a class="app-list-group-item list-group-item-action

            {{ request()->is('admin/posts') ? 'app-active' : '' }}

            {{ request()->is('admin/posts/trash') ? 'app-active' : '' }}

            {{ request()->is('admin/posts/draft') ? 'app-active' : '' }}"

            href="{{ route('posts.index') }}">

             <i class="fas fa-newspaper"></i>

             Posts
         </a>
     @endcan

     <a class="app-list-group-item list-group-item-action

        {{ request()->is('admin/users') ? 'app-active' : '' }}

        {{ request()->is('admin/users/*') ? 'app-active' : '' }}"

        href="{{ route('users.index') }}">

         <i class="fas fa-users"></i>

         Usuarios
     </a>
 </div>

 <div class="list-group app-list">
     <h6 class="app-sidebar-label">
         AJUSTES
     </h6>
     <a class="app-list-group-item list-group-item-action" href="{{ route('profile.index') }}">
         <i class="fas fa-user-circle"></i>
         Perfil
     </a>

     @can('only-superadmin')
         <a class="app-list-group-item list-group-item-action" href="{{ route('settings.index') }}">
             <i class="fas fa-cog"></i>
             Basicos
         </a>

        {{--
        <a class="app-list-group-item list-group-item-action" href="{{ route('settings.index') }}">
             <i class="fas fa-cogs"></i>
             Avanzados
         </a>
         --}}

         <a class="app-list-group-item list-group-item-action" href="{{ route('settings.comment') }}">
             <i class="fab fa-discourse"></i>
             Disqus Comentarios
         </a>

         <a class="app-list-group-item list-group-item-action" href="{{ route('settings.share') }}">
             <i class="fas fa-share-alt"></i>
             ShareThis Plugin
         </a>

         <a class="app-list-group-item list-group-item-action" href="{{ route('settings.ads') }}">
             <i class="fas fa-puzzle-piece"></i>
             Bloque de Anuncios
         </a>
     @endcan
 </div>