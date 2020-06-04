@extends('apps.layouts.main_layouts')
@section('menuTitle','My Cart')
@section('apps_main_content')
@php $base_url="http://www.grofie.in/" @endphp
<!-- Header2 Start -->
<div class="head-load">
  <div class="container-fluid">
    <div class="row header2 cart-header">
      <div class="container">
        <div class="back">
          <a href="{{route('apps.category')}}"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a>
        </div>
        <h3>My Cart</h3>
        <div class="cart-btn cartbtn">
          @if($i>0)
          <a href="{{ url('/apps/show-cart')}}" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> <small class="cart-value">{{$i}}</small></a>
          @else 
          <a href="{{ url('/apps/show-cart')}}" class="btn btn-link border-none"><i class="mdi mdi-cart"></i></a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Header2 End -->
<!-- Cart Details Start -->
<div id="_cartPage">
  <section class="cart-page">
    <div class="container">
      <div class="row">
        <div class="cart-table">
          <div class="cart-body">
            @php               
            $total=0;   
            @endphp   
            @foreach( $carts as $cart )
            @if($cart->product_stat == 1 && $cart->product_in_hand_stock > 0)
            <div class="cart-list-product">
              <a  class="del float-right remove-cart" data-url="{{route('apps.cart.del',$cart->cart_id)}}"><i class="mdi mdi-close"></i></a>
              <div class="pro-img"><img class="img-fluid" src="{{$base_url}}{{$cart->product_image_main}}" alt=""></div>
              <div class="pro-desc">
                <h5><a href="#">{{$cart->product_name}}</a></h5>
                <p>{{$cart->brand_name}}</p>
                <div class="qty">
                  <h6><span class="mdi mdi-approval"></span> Unite - <span>{{$cart->unit_name_sm}}</span></h6>
                  @php 
                  $qty = $cart->product_in_hand_stock; 
                  @endphp
                  <div class="select-qty" data-qty1="{{$qty}}" data-cartid="{{$cart->cart_id}}">                
                    Qty: <label>{{$cart->qty}}</label>
                  </div>  

                  <div class="qty-pop">
                    <ul class="show-qty dropdeli">
                      <h4>Change Quantity</h4>
                      @for ($i=1; $i <=5 && $i<=$qty;  $i++)
                      <li class="selected" data-url="{{route('cart.add.qty',[$cart->cart_id,$i])}}">
                        <label>{{$i}}</label>
                      </li>
                      @endfor                                       
                    </ul>
                  </div>           
                </div>
                @if($cart->product_offers>0)
                <div class="price">&#8377; {{$cart->product_sell_price_after_offer}} <span class="regular-price">&#8377; {{$cart->product_sell_price}}</span> <span class="offer-price"> {{$cart->product_offers}} %</span></div> 
                @php
                $price = $cart->product_sell_price_after_offer;
                @endphp
                @else
                <div class="price">&#8377; {{$cart->product_sell_price}} </div> 
                @php
                $price = $cart->product_sell_price;
                @endphp
                @endif


                @php
                $subtotal = $cart->qty*$price;
                @endphp
                <div class="price">Total Price : &#8377; {{$subtotal}}</div> 
                @php               
                $total = $total+$subtotal;
                @endphp                 
              </div>
            </div> 
            @else
            <div class="cart-list-product">
              <a  class="del float-right remove-cart" data-url="{{route('apps.cart.del',$cart->cart_id)}}"><i class="mdi mdi-close"></i></a>
              <div class="pro-img not-aviable"><img class="img-fluid" src="{{$base_url}}{{$cart->product_image_main}}" alt=""></div>
              <div class="pro-desc not-aviable">
                <h5><a href="#">{{$cart->product_name}}</a></h5>
                <p>{{$cart->brand_name}}</p>
                <div class="qty">
                  <h6><span class="mdi mdi-approval"></span> Unite - <span>{{$cart->unit_name_sm}}</span></h6>

                  <div class="select-qty" data-qty1="{{$qty}}" data-cartid="{{$cart->cart_id}}">                
                    Qty: <label>{{$cart->qty}}</label>
                  </div>              
                </div>
                @if($cart->product_offers>0)
                <div class="price">&#8377; {{$cart->product_sell_price_after_offer}} <span class="regular-price">&#8377; {{$cart->product_sell_price}}</span> <span class="offer-price"> {{$cart->product_offers}} %</span></div> 
                @php
                $price1 = $cart->product_sell_price_after_offer;
                @endphp
                @else
                <div class="price">&#8377; {{$cart->product_sell_price}} </div> 
                @php
                $price1 = $cart->product_sell_price;
                @endphp
                @endif
                @php
                $subtotal = $cart->qty*$price1;
                @endphp
                <div class="price">Total Price : &#8377; {{$subtotal}}</div> 
              </div>
            </div> 
            @endif
            @endforeach 
          </div>
          <!-- <div class="coupon-block">
            <h5><a href="javascript:void(0);"><span class="mdi mdi-percent"></span> Apply coupon</a></h5>
          </div> -->
        </div>
      </div>
    </div>
  </section>
</div>
<!-- Cart Details End -->
<div class="footer-btn">
  <div class="final-price">
    <p>Sub Total <span class="float-right">&#8377; {{ $total }}</span></p>
    <input type="hidden" name="sub_total" value=" {{ $total }}">
    <input type="hidden" name="sub_total" value=" {{ $total }}">
    @if( $total <= $charges->min_ordr_amount && $total != 0)
    <?php $deliveryCharge = $charges->delivery_charges; ?>
    <p>Delivery Charge <span class="float-right text-success">+ &#8377; {{$charges->delivery_charges}}</span></p>
    @else
    <?php $deliveryCharge = 0; ?>
    <p>Delivery Charge <span class="float-right text-success">Free</span></p>
    @endif

    <!--    <p>Your total savings <span class="float-right text-success">&#8377; 55 (42.31%)</span></p> -->
    <div class="cart-total"><p>Total  <span class="float-right">&#8377; {{ $total+$deliveryCharge }}</span></p></div>
    <!--<a class="chkout-btn" href="checkout.html"><button type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Checkout </span><span class="float-right"><strong>&#8377; 1200.69</strong> </span></button></a>-->
    @php
    Session::put('delivery_charges' , $deliveryCharge)
    @endphp
  </div>
  <a class="chkout-btn" href="{{route('order.address')}}"><h4 class="float-left"><i class="mdi mdi-cart-outline"></i> Checkout </h4><span class="float-right"><strong>&#8377; {{ $total+$deliveryCharge }}</strong> </span></a>     
</div>  

      <script>
        $(document).ready(function(){
          $(document).on('click' ,'.del',function(event){
            event.preventDefault();
            $("#cover-spin").show();
            $.ajax({
              type:'GET',
              url: $(this).data("url"), 
              dataType: 'json',
              success:function(data){
                if(data.delete)
                {        
                  $("#_cartPage").load(window.location + " #_cartPage");  
                  $(".footer-btn").load(window.location + " .footer-btn"); 
                  $(".head-load").load(window.location + " .head-load");  
                  $("#cover-spin").hide(); 
                }
              },
            });
          });

          $(document).on('click','.selected',function(event){
            event.preventDefault();
            $("#cover-spin").show();
            $.ajax({
              type:'GET',
              url: $(this).data("url"), 
              dataType: 'json',
              success:function(data){
                if(data.success)
                {        
                  $(".cart-body").load(window.location + " .cart-body");  
                  $(".footer-btn").load(window.location + " .footer-btn");
                  $("#cover-spin").hide(); 
                }
              },
            });
          }); 
          $(document).on("click",".select-qty", function(){
            $(this).next(".qty-pop").fadeIn();
            $(".pop-overlay").fadeIn();
          }); 
          $(document).on("click",".pop-overlay",function(){
            $(".pop-overlay").fadeOut();
            $(".qty-pop").fadeOut();
          });
          $(document).on("click",".show-qty li",function(){
            $(".qty-pop").fadeOut();
            $(this).addClass("selected");
            $('.pop-overlay').fadeOut();
          });
          $(document).on("click",".dropdeli li",function(){
            $(this).parents('.qty').children('.selectdelimain').children('label').text($(this).children('label').text());
            $(this).parents(".qty-pop").fadeOut();
            $(this).addClass("selected");
          });
        });
      </script>
      @endsection