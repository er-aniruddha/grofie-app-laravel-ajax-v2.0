@extends('apps.layouts.main_layouts')
@section('menuTitle','Orders Details')
@section('apps_main_content')
@php $base_url="http://www.grofie.in/" @endphp
<!-- Header2 Start -->
<div class="container-fluid">
  <div class="row header2 cart-header">
    <div class="container">
      <div class="back">
        <a href="{{route('apps.order')}}"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a>
      </div>
      <h3>Orders Details</h3>
    </div>
  </div>
</div>
<!-- Header2 End -->
<!-- Cart Details Start -->
<section class="details order-page">
  <div class="container">
    <div class="row">
      <div class="cart-table">
        <div class="orders">                       
          <div id="_each_order">
            @php               
            $i = 0;
            $total=0;
            @endphp
            @foreach ($orderDetails as $order)
            @if($i != $order->order_id)
            @php
            $i = $order->order_id;
            $delCharges = $order->delivery_charges;
            $delKmCharges = $order->delivery_km_charges;
            @endphp        
            <div class="order-info"><h4>Order Id: <span>{{$i}}</span></h4>             
            </div>    
            @endif
            <div class="cart-list-product">
              <div class="pro-img">
                <img class="img-fluid" src="{{$base_url}}{{$order->product_image_main}}" alt="">
              </div>
              <div class="pro-desc">
                <h5>{{$order->product_name}}</h5>
                <p>{{$order->brand_name}}</p>         
                <div class="qty">
                  <h6><span class="mdi mdi-approval"></span> Qty - <span>{{$order->qty}}</span></h6>
                </div>
                
                @if($order->offers>0)
                <div class="price">&#8377; {{$order->sell_price_after_offer*$order->qty}} <span class="regular-price">&#8377; {{$order->sell_price*$order->qty}}</span> <span class="offer-price"> {{$order->offers}} %</span></div>
                @if($order->order_stat != 0  && $order->order_stat != -1)
                @php
                $subtotal = $order->qty*$order->sell_price_after_offer;
                $total = $total +  $subtotal;
                @endphp
                @endif
                @else
                <div class="price">&#8377; {{$order->sell_price*$order->qty}} </div> 
                @if($order->order_stat != 0 && $order->order_stat != -1)
                @php
                $subtotal = $order->qty*$order->sell_price;
                $total = $total +  $subtotal;
                @endphp
                @endif
                @endif

                <div class="deli-option">
                  @if($order->order_stat == 1)
                  <button type="button" class="cancel btn badge-danger" data-url="{{route('order.cancel',[$order->order_id,$order->product_id])}}">Cancel Order</button>
                  @elseif($order->order_stat == 0)
                  <h3 class="badge-secondary">Cancelled</h3>
                  @elseif($order->order_stat == 2)
                  <h3 class="badge-info">Out for Delivery</h3>
                  @elseif($order->order_stat == 3)
                  <h3 class="badge-success">Delivered {{$order->delivery_date}}</h3>
                  @endif
                </div>             
              </div>
            </div>            
            @endforeach 
            

            <div class="order final-price">
              @if($total == 0)
              <p>Sub Total <span class="float-right">Cancelled/Returned</span></p>
              <div class="cart-total"><p>Total  <span class="float-right">Cancelled/Returned</span></p></div>
              @else
              <p>Sub Total <span class="float-right">&#8377; {{$total}}</span></p>
              

              <!-- Charges on AMount-->             
              @if($delCharges == 0)
              <p>Delivery Charge on Amount <strong class="float-right text-success"> Free</strong></p>
              @else
              <p>Delivery Charge on Amount<span class="float-right text-success">+ &#8377; {{$delCharges}}</span></p>
              @endif 
              <!-- Charges on KM-->
              @if($delKmCharges == 0)
              <p>Delivery Charge on Distance <strong class="float-right text-success"> Free</strong></p>
              @else
              <p>Delivery Charge on Distance<span class="float-right text-success">+ &#8377; {{$delKmCharges}}</span></p>
              @endif
              <!--  <p>Your total savings <span class="float-right text-success">&#8377; 55 (42.31%)</span></p> -->
              <div class="cart-total"><p>Total  <span class="float-right">&#8377; {{ $total+$delCharges+$delKmCharges }}</span></p></div>
              <!--<a class="chkout-btn" href="checkout.html"><button type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Checkout </span><span class="float-right"><strong>&#8377; 1200.69</strong> </span></button></a>-->
              @endif
            </div>          
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Cart Details End -->   
<script>
  $(document).ready(function(){
    $(document).on('click' ,'.cancel',function(event){
      event.preventDefault()
      $("#cover-spin").show();
      $.ajax({
        type:'GET',
        url: $(this).data("url"), 
        dataType: 'json',
        success:function(data){
          if(data.cancelorder)
          {
            $("#cover-spin").hide();
            $("#_each_order").load(window.location + " #_each_order");  
          }
        },
      });
    });
  });
</script>
@endsection