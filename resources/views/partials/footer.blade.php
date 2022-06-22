<section class="wrapper__section p-0">
    <div class="wrapper__section__components">
        <footer>
            <div class="wrapper__footer bg__footer ">
                <div class=" container">
                    <div class="row">
                        <div class="col-md-4">
                            {{-- Descripción del sitio --}}
                            <div class="widget__footer">
                                <figure>
                                    <img src="{{ asset('images/logo-light.png') }}" alt="notidigitalrd" class="logo-footer">
                                </figure>

                                <p class="text-justify">
                                    <strong>{{ setting()->get('blog.site_name') }}</strong> es un periódico digital informativo con las noticias más recientes que acontecen en la República Dominicana y el mundo.
                                    <br>
                                </p>
                            </div>
                            <div class="border-line"></div>

                            {{-- Info. de contacto --}}
                            @if(setting()->get('blog.contact_email') or
                                setting()->get('blog.contact_number') or
                                setting()->get('blog.address'))
                                <div class="widget__footer">
                                    <h4 class="footer-title">Información de contacto</h4>
                                    <p>
                                        <span style="float: initial !important;"><strong>Dirección Email:</strong> {{ setting()->get('blog.contact_email') }}</span> <br>
                                        <span style="float: initial !important;"><strong>Contacto:</strong> {{ setting()->get('blog.contact_number') }}</span> <br>
                                        <span style="float: initial !important;"><strong>Dirección:</strong> {{ setting()->get('blog.address') }}</span>
                                    </p>
                                </div>
                                <div class="border-line"></div>
                            @endif

                            @if(setting()->get('blog.blog_facebook') or
                                setting()->get('blog.blog_twitter') or
                                setting()->get('blog.blog_instagram') or
                                setting()->get('blog.blog_youtube'))
                                <div class="widget__footer">
                                    <h4 class="footer-title">Síguenos en las redes sociales</h4>
                                    <p>
                                        @if(setting()->get('blog.blog_facebook'))
                                            <a href="{{ setting()->get('blog.blog_facebook') }}" class="btn btn-social btn-social-o facebook mr-1" target="_blank">
                                                <i class="fa fa-facebook-f"></i>
                                            </a>
                                        @endif

                                        @if(setting()->get('blog.blog_twitter'))
                                            <a href="{{ setting()->get('blog.blog_twitter') }}" class="btn btn-social btn-social-o twitter mr-1" target="_blank">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        @endif

                                        @if(setting()->get('blog.blog_instagram'))
                                            <a href="{{ setting()->get('blog.blog_instagram') }}" class="btn btn-social btn-social-o instagram mr-1" target="_blank">
                                                <i class="fa fa-instagram"></i>
                                            </a>
                                        @endif

                                        @if(setting()->get('blog.blog_youtube'))
                                            <a href="{{ setting()->get('blog.blog_youtube') }}" class="btn btn-social btn-social-o youtube mr-1" target="_blank">
                                                <i class="fa fa-youtube"></i>
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Category -->
                        @if($categories->count())
                            <div class="col-md-4">
                                <div class="widget__footer">
                                    <h4 class="footer-title">Categorías</h4>
                                    <div class="link__category">
                                        <ul class="list-unstyled ">
                                            @foreach($categories as $slug => $category)
                                                <li class="list-inline-item">
                                                    <a href="{{ url($slug) }}">{{ $category }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Últimas noticias --}}
                        <div class="col-md-4">
                            <div class="widget__footer">
                                <h4 class="footer-title">Últimas noticias</h4>

                                @if($carousel->count())
                                    @foreach($carousel->take(5)->all() as $corousel_post)
                                        <div class="mb-3">
                                            <div class="card__post card__post-list">
                                                <div class="image-sm">
                                                    <a href="{{ url( optional($corousel_post->category)->slug .'/'. $corousel_post->slug ) }}">
                                                        <img src="{{ $corousel_post->image }}" class="img-fluid" alt="{{ $corousel_post->title }}">
                                                    </a>
                                                </div>

                                                <div class="card__post__body ">
                                                    <div class="card__post__content">
                                                        <div class="card__post__author-info mb-2">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item">
                                                                    <span class="text-white">
                                                                        Publicado por {{ $corousel_post->user->name }}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span class="text-white text-capitalize">
                                                                        {{ $corousel_post->created_at->diffForHumans() }}
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="card__post__title">
                                                            <h6>
                                                                <a href="{{ url( optional($corousel_post->category)->slug .'/'. $corousel_post->slug ) }}" class="text-white">
                                                                    {{ $corousel_post->title }}
                                                                </a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="bg__footer-bottom ">
                <div class="container">
                    <div class="row flex-column-reverse flex-md-row">
                        <div class="col-md-12 text-center">
                            <span>
                                © 2018-{{ date('Y') }} Desarrollado por <a href="https://www.linkedin.com/in/cristian-g%C3%B3mez-evangelista-5b9433174/" style="text-transform: initial;" target="__blank">Cristian Gómez E.</a> & <a href="https://www.linkedin.com/in/luismiguel-rbido/" style="text-transform: initial;" target="__blank">Luis Miguel R.</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</section>

{{-- <footer class="blog-footer bg-dark text-white">
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
</footer> --}}