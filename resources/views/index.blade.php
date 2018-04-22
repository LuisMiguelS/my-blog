@extends('layouts.app')

@component('component.content')

    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="row">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-627516.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-632744.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-626490.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <br>
            <br>
            <br>
            <br>

               <div class="row">
                   <div class="col-md-12">
                       <div class="card mb-3">
                           <img class="card-img-top" src="https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-191602.jpg" alt="Card image cap">
                           <div class="card-body">
                               <h4 class="card-title">Card title</h4>
                               <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                               <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                           </div>
                       </div>
                   </div>
               </div>

        </div>
    </div>

@endcomponent