<footer class="blog-footer">
   <div class="container">
       <div class="row">
           <div class="col-md-4">
               @if(config('ads.ads_bottom',false) )
                   <h4 class="text-dark font-weight-bold">Anucios</h4>
                   {!! config('ads.ads_bottom') !!}
               @endif
           </div>
           <div class="col-md-4 font-weight-bold text-dark">
              @if($category->count())
                   <h4 class="font-weight-bold">Secciones</h4>
                   <ul class="list-inline">
                       @foreach($category as $index => $name)
                           <a href="{{ url($index) }}" class="list-inline-item text-dark">{{ $name }}</a>
                       @endforeach
                   </ul>
              @endif
           </div>
               <div class="col-md-4 font-weight-bold text-dark">

                   <h4 class="font-weight-bold">{{ config('blog.name'). ' Información de contacto' }}</h4>

                   @if(config('blog.contact_email',false))
                       <p>{{ 'Correo Electrónico: '. config('blog.contact_email') }}</p>
                   @endif


                   @if(config('blog.contact_number',false))
                       <p>{{ 'Teléfono: '. config('blog.contact_number') }}</p>
                   @endif

                   @if(config('blog.address',false))
                       <p>{{ 'Dirección: '. config('blog.address') }}</p>
                   @endif
               </div>
       </div>
   </div>
</footer>