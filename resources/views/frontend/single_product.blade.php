@extends('layouts.app')
@section('main')  
  
  
<!-- content -->
<section class="py-5">
    <div class="container">
      <div class="row gx-5">
        <aside class="col-lg-6">
          <div class="border rounded-4 mb-3 d-flex justify-content-center">
            <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="#">
              <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="{{URL::asset('uploads/products/' . $singleProduct->product_images)}}" />
            </a>
          </div>
          <div class="d-flex justify-content-center mb-3">
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="#" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="{{URL::asset('uploads/products/' . $singleProduct->images2)}}" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="#" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="{{URL::asset('uploads/products/' . $singleProduct->images3)}}" />
            </a>
          </div>
          <!-- thumbs-wrap.// -->
          <!-- gallery-wrap .end// -->
        </aside>
        <main class="col-lg-6">
          <div class="ps-lg-3">
            <h4 class="title text-dark">
              {{$singleProduct->product_name}}
            </h4>
            <div class="d-flex flex-row my-3">
              <div class="text-warning mb-1 me-2">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span class="ms-1">
                  4.5
                </span>
              </div>
              <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span>
            </div>
  
            <div class="mb-3">
              <span class="h5">$75.00</span>
            </div>
  
            <p>
             {{$singleProduct->product_description}}
            </p>

  
            <hr />
            <a href="#" class="btn btn-warning shadow-0"> Call </a>
            <a href="#" class="btn btn-primary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i>What's App</a>
            <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-heart fa-lg"></i>Email</a>
          </div>
        </main>
      </div>
    </div>
  </section>
  <!-- content -->

    @endsection