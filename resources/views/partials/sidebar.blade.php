<div class="card card-shadow-light">
    <div class="card-body">
        <h4 class="card-title h4-font-italic" align="center">
            Ultimas Publicaciones
        </h4>
        <ul class="list-unstyled">
            <li class="media" style="padding: 1rem">
                <img class="mr-3" src="https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-575627.jpg" width="64" height="64" alt="Generic placeholder image">
                <div class="media-body">
                    <a href="" class="mt-0 mb-1">List-based media object</a>
                    <br>
                    <small>fecha</small>
                </div>
            </li>
            <hr>
        </ul>
    </div>
</div>

<div class="card card-shadow-light">
 <div class="card-body">
     <h4 class="card-title h4-font-italic" align="center">
         Archivados
     </h4>
     <div class="list-inline">
         @foreach($archives as $stats)
             <a class="list-inline-item badge badge-primary app-badge" href="{{ url("archives?month={$stats['month']}&year={$stats['year']}") }}">
                 {{ $stats['month'] . ' ' . $stats['year'] }}
             </a>
         @endforeach
     </div>
 </div>
</div>

<div class="card card-shadow-light">
    <div class="card-body">
        <h4 class="card-title h4-font-italic" align="center">
            Tags
        </h4>
        <div class="list-inline">
            @foreach($tags as $index => $slug)
                <a class="list-inline-item badge badge-primary app-badge" href="{{ url("tags/{$slug}") }}">
                    {{ $index }}
                </a>
            @endforeach
        </div>
    </div>
</div>


<div class="card card-shadow-light">
    <img class="card-img" src="https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-135520.jpg" alt="Ads">
</div>

<div class="card card-shadow-light">
    <div class="card-body">
        <h4 class="card-title h4-font-italic" align="center">
            Síguenos
        </h4>
        <a href="#" class="fab fa-facebook-square social-btn"></a>
        <a href="#" class="fab fa-twitter social-btn"></a>
        <a href="#" class="fab fa-google-plus social-btn"></a>
        <a href="#" class="fab fa-linkedin-in social-btn"></a>
        <a href="#" class="fab fa-youtube social-btn"></a>
        <a href="#" class="fab fa-instagram social-btn"></a>
        <a href="#" class="fab fa-pinterest social-btn"></a>
    </div>
</div>
