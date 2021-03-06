<footer class="blog-footer bg-dark text-white">
   <div class="container">
       <div class="row">
           <div class="col-md-4">
               @if(setting()->get('ads.ads_bottom') )
                   <h4 class="font-weight-bold">Anucios</h4>
                   {!! setting()->get('ads.ads_bottom') !!}
               @endif

               @if($ramdom->count() > 0)
                   <h4 class="font-weight-bold">Quizas te pueda interezar</h4>

                   @include('partials.media-card', ['posts' => $ramdom, 'color_white' => 'text-white', 'media_style' => 'bg-transparent'])
               @endif

           </div>
           <div class="col-md-4 font-weight-bold ">
              @if($category->count())

                   <h4 class="font-weight-bold">Categorias</h4>

                       <ul class="list-group d-flex flex-row flex-wrap">
                          @foreach ($category->chunk(5) as $chunk)
                                  @foreach ($chunk as $index => $name)
                                      <a href="{{ url($index) }}" class="app-list-group-item text-white col-md-4">{{ $name }}</a>
                                  @endforeach
                          @endforeach
                       </ul>

              @endif
           </div>
           <div class="col-md-4 font-weight-bold ">

               <img src="{{ asset('images/logo.png') }}" class="img-fluid" alt="notidigitalrd_logo">

               <h4 class="font-weight-bold">{{ setting()->get('blog.name'). ' Información de contacto' }}</h4>

                @if(setting()->get('blog.contact_email'))
                   <p>{{ 'Correo Electrónico: '. setting()->get('blog.contact_email') }}</p>
                @endif

                @if(setting()->get('blog.contact_number'))
                   <p>{{ 'Teléfono: '. setting()->get('blog.contact_number') }}</p>
                @endif

                @if(setting()->get('blog.address'))
                   <p>{{ 'Dirección: '. setting()->get('blog.address') }}</p>
                @endif

                @if(setting()->get('blog.blog_youtube'))
                   <a href="{{ setting()->get('blog.youtube') }}" class="fab fa-youtube social-btn shadow-sm"></a>
                @endif

                @if(setting()->get('blog.blog_facebook'))
                   <a href="{{ setting()->get('blog.blog_facebook') }}" class="fab fa-facebook-square social-btn shadow-sm"></a>
                @endif

                @if(setting()->get('blog.blog_instagram'))
                   <a href="{{ setting()->get('blog.instagram') }}" class="fab fa-twitter social-btn shadow-sm"></a>
                @endif

                @if(setting()->get('blog.blog_twitter'))
                   <a href="{{ setting()->get('blog.twitter') }}" class="fab fa-instagram social-btn shadow-sm"></a>
                @endif

               <p>Diseñado por:
                   <strong>
                       <a class="text-white" href="https://cristiangomez.netlify.com" target="_blank">Cristian Gómez</a>
                   </strong>
                   &
                   <strong>
                       <a class="text-white" href="https://www.linkedin.com/in/luis-miguel-rodriguez-bido-a30ba616b" target="_blank">Luis Miguel Rodriguez</a>
                   </strong>
               </p>
           </div>
       </div>
   </div>
</footer>