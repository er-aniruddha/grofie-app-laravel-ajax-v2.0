@extends('apps.layouts.main_layouts')
@section('menuTitle','Orders')
@section('apps_main_content')
@php $base_url="http://www.grofie.in/" @endphp
<!-- Header2 Start -->
<div class="container-fluid">
  <div class="row header2 cart-header">
    <div class="container">
        <div class="back">
          <a href="{{route('apps.home')}}"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a>
        </div>
        <h3>Orders</h3>
      </div>
  </div>
</div>
<!-- Header2 End -->
<!-- Cart Details Start -->
<section class="order-page">
  <div class="container">
      <div class="row">
        <div class="cart-table">
          <div class="orders">                       
          <div id="_each_order">
            @php               
             $i = 0;
            @endphp
            @foreach ($orders as $order)
            @if($i != $order->order_id)
            @php
              $i = $order->order_id;
            @endphp        
            <div class="order-info"><h4>Order Id: <span>{{$i}}</span></h4>
              <p><a href="{{url('apps/order/view/details/'.$order->order_id)}}">View Order</a></p>
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
                    @else
                    <div class="price">&#8377; {{$order->sell_price*$order->qty}} </div> 
                  @endif
                <div class="deli-option">
                  @if($order->order_stat == 1)
                  <button type="button" class="cancel btn badge-danger" data-url="{{route('order.cancel',[$order->order_id,$order->product_id])}}">Cancel Order</button>
                  @elseif($order->order_stat == 0)
                  <h3 class="badge-secondary">Cancelled</h3>
                  @elseif($order->order_stat == 2)
                  <h3 class="badge-info">Out for Delivery</h3>
                  @elseif($order->order_stat == -1)
                  <h3 class="badge-warning">Return</h3>
                  @elseif($order->order_stat == 3)
                  <h3 class="badge-success">Delivered {{$order->delivery_date}}</h3>
                  @endif
                </div>             
              </div>
            </div>
            @endforeach    
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
      console.log(data);
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