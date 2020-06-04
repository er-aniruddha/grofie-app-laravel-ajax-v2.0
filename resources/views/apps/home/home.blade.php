@extends('apps.layouts.main_layouts')
@section('menuTitle','Product Category')
@section('apps_main_content')

<!-- Header Start -->
<div class="container-fluid">
  <div class="row header">
    <div class="container">
    <ul class="header-info">
     
      <li class="logo">
        <a href="{{ url('/apps/home')}}" ><img src="{{ asset ('public/apps/img/app-logo.jpeg')}}" alt="Logo"/></a>
      </li>
      <li class="cart-btn">
      @if($i>0)
      <a href="{{ url('/apps/show-cart')}}" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> <small class="cart-value">{{$i}}</small></a>
      @else
      <a href="{{ url('/apps/show-cart')}}" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> </a>
      @endif
      </li> 
    </ul> 

    </div>
  </div>
</div>
<!-- Header End -->

<!-- Welcome Img -->
<div class="container-fluid welcome-img">
   <img src="{{asset('/public/apps/img/welcome.jpg')}}" alt=""/>
</div>
<!-- Welcome Img -->
<!-- Banner Start -->
<div class="banner-slider owl-carousel owl-theme">
   <div class="item">
         <a href="shop.html"><img class="img-fluid" src="{{url('public/apps/img/slider/slider1.jpg')}}" alt="First slide"></a>
      </div>
      <div class="item">
         <a href="shop.html"><img class="img-fluid" src="{{url('public/apps/img/slider/slider2.jpg')}}" alt="First slide"></a>
      </div>
   <div class="item">
         <a href="shop.html"><img class="img-fluid" src="{{url('public/apps/img/slider/slider1.jpg')}}" alt="First slide"></a>
      </div>
      <div class="item">
         <a href="shop.html"><img class="img-fluid" src="{{url('public/apps/img/slider/slider2.jpg')}}" alt="First slide"></a>
      </div>
</div>
<!-- Banner End -->
<!-- Product slider1 Start -->
<section class="product-items-slider">
   <div class="section-header">
      <h5 class="heading-design-h5">Top Savers Today </h5>
   </div>
   <div class="text-center home-spiner-margin">
     <div class="spinner-border pageload text-success" role="status">
       <span class="sr-only">Loading...</span>
     </div>
   </div>
   <div class="saver-load">
      <div class="container">
         <div id="top-savers" class="pro-slider owl-carousel owl-theme">
          <!-- Show Top Save Products -->        
            
         </div>
      </div>
   </div>
</section>
<!-- Product slider1 End -->      
<!-- Offer Section Start -->
<section class="offer-product">
   <div class="container">
      <div class="offer-slider owl-carousel owl-theme">
         <div class="item">
            <img class="img-fluid" src="{{asset('public/apps/img/ad/1.jpg')}}" alt="">
         </div>
         <div class="item">
           <img class="img-fluid" src="{{asset('public/apps/img/ad/2.jpg')}}" alt="">
         </div>
      </div>
   </div>
</section>
<!-- Offer Section End -->
      
<!-- Featured Block Start --> 
<section class="feature-block">
   <div class="container">
      <div class="feature-slider owl-carousel owl-theme">
         <div class="item">
            <div class="feature-box">
               <i class="mdi mdi-truck-fast"></i>
               <h6>Free & Next Day Delivery</h6>
               <p>Lorem ipsum dolor sit amet, cons...</p>
            </div>
         </div>
         <div class="item">
            <div class="feature-box">
               <i class="mdi mdi-basket"></i>
               <h6>100% Satisfaction Guarantee</h6>
               <p>Rorem Ipsum Dolor sit amet, cons...</p>
            </div>
         </div>
         <div class="item">
            <div class="feature-box">
               <i class="mdi mdi-tag-heart"></i>
               <h6>Great Daily Deals Discount</h6>
               <p>Sorem Ipsum Dolor sit amet, Cons...</p>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Featured Block End -->
<script>
$(document).ready(function(){   
   $.ajax({
      type:'GET',
      url:"{{route('apps.product.top.savers')}}",
      cache:false,
      dataType: 'json',
      success:function(data){
         console.log(data);
         for(var count=0; count < data.topsevers.length ; count++)
         {
            if(data.topsevers[count].product_in_hand_stock > 0)
            {
               $("#top-savers").append('<div class="item">'+
                  '<div class="product ">'
                     +'<a href="single.html">'
                        +'<div class="product-header">'                           
                           +'<img class="img-fluid" src="http://grofie.in/'+data.topsevers[count].product_image_main+'" alt="">'                           
                        +'</div>'
                        +'<div class="product-body">'
                           +'<h5>'+data.topsevers[count].product_name+'</h5>'
                           +'<h6>'+data.topsevers[count].unit_name_sm+' gm</h6>'
                        +'</div>'
                        +'<div class="product-footer">'
                           +'<p class="offer-price mb-0">'
                           +'<span class="regular-price">Rs. '+data.topsevers[count].product_sell_price+'</span> <span class="badge badge-danger">'+data.topsevers[count].product_offers+'% OFF</span> </p>'
                           +'<p class="price">Rs. '+data.topsevers[count].product_sell_price_after_offer+'</p>'
                           +'<div class="clearfix"></div>'
                        +'</div>'
                     +'</a>'
                  +'</div>'
               +'</div>');
            } 
            else
            {
               $("#top-savers").append('<div class="item">'+
                  '<div class="product not-aviable">'
                     +'<a href="single.html">'
                        +'<div class="product-header">'                           
                           +'<img class="img-fluid" src="http://grofie.in/'+data.topsevers[count].product_image_main+'" alt="">'                           
                        +'</div>'
                        +'<div class="product-body">'
                           +'<h5>'+data.topsevers[count].product_name+'</h5>'
                           +'<h6>'+data.topsevers[count].unit_name_sm+' gm</h6>'
                        +'</div>'
                        +'<div class="product-footer">'
                           +'<p class="offer-price mb-0">'
                           +'<span class="regular-price">Rs. '+data.topsevers[count].product_sell_price+'</span> <span class="badge badge-danger">'+data.topsevers[count].product_offers+'% OFF</span> </p>'
                           +'<p class="price">Rs. '+data.topsevers[count].product_sell_price_after_offer+'</p>'
                           +'<div class="clearfix"></div>'
                        +'</div>'
                     +'</a>'
                  +'</div>'
               +'</div>');
            }
         }
         $('.pro-slider').owlCarousel({
               loop:true,
               autoplay:false,
               dots:false,
               //center:true,
               items:2     
            }); 
         $(".home-spiner-margin").hide();
      }

   });
});

   
</script>   
      

@endsection