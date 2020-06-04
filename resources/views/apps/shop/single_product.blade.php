@extends('apps.layouts.main_layouts')
@section('menuTitle','Single Product')
@section('apps_main_content')
<!-- Single Product Page start-->
<div class="container-fluid">
  <div class="row">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 single-pro-img">
          <div class="single-slider owl-carousel owl-theme">
            <div class="item">                      
            <img class="img-fluid" src="https://grofie.in/{{$single_product->product_image_main}}" alt="First slide">
            </div>
            @if($single_product->product_image1)
            <div class="item">
               <img class="img-fluid" src="https://grofie.in/{{$single_product->product_image1}}" alt="N/A">
            </div>
            @else
            @endif
            @if($single_product->product_image2)
            <div class="item">
               <img class="img-fluid" src="https://grofie.in/{{$single_product->product_image2}}" alt="N/A">
            </div>
            @else
            @endif
            @if($single_product->product_image3)
            <div class="item">
               <img class="img-fluid" src="https://grofie.in/{{$single_product->product_image3}}" alt="N/A">
            </div>
            @else
            @endif
             @if($single_product->product_image4)
            <div class="item">
               <img class="img-fluid" src="https://grofie.in/{{$single_product->product_image4}}" alt="N/A">
            </div>
            @else
            @endif
          </div>  
          <div class="pro-desc single-pro-desc">
           <h5>{{$single_product->product_name}}</h5>
           <p>{{$single_product->brand_name}}</p>
           <div class="qty">
            <h6><span class="mdi mdi-approval"></span> Unite - <span>{{$single_product->unit_name_sm}}</span></h6>                         
           </div>
           @if($single_product->product_offers > 0)
           <div class="price">₹ {{$single_product->product_sell_price_after_offer}} <span class="regular-price">₹ {{$single_product->product_sell_price}}</span> <span class="offer-price">{{$single_product->product_offers}}%</span></div>
           @else
           <div class="price">₹ {{$single_product->product_sell_price}}</div>
           @endif           
          </div>

          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 single-pro-info">
            <h5>Quick Overview</h5>
          <p>{{$single_product->product_description}}</p>

          </div>
          <!-- Header Block-->
          <a href="{{url('apps/category/product/'.$single_product->category_id)}}" class="single-back"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a>
          <!-- Header Block Start-->
            @if($i>0)
             <a href="{{ url('/apps/show-cart')}}" class="single-cart-btn"><i class="mdi mdi-cart"></i> <small class="cart-value">{{$i}}</small></a>
            @else 
              <a href="{{ url('/apps/show-cart')}}" class="single-cart-btn"><i class="mdi mdi-cart"></i></a>
            @endif
         <!-- Header Block End-->
      </div>
    </div>
  </div>
</div>
<!-- Single Product Page End-->
<div class="footer-btn">
  <form action="{{url('/apps/add-to-cart')}}" action="POST">
    @csrf 
      <input type="hidden" value="1" name="qty" class="form-control">
      <input type="hidden" name="product_id" value="{{$single_product->product_id}}">
     
      <button type="submit" class="chkout-btn"><h4 class="float-centre"><i class="mdi mdi-cart-outline"></i> Add to Cart </h4></button>
 </form> 
        
     
</div>  

@endsection
