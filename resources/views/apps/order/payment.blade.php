@extends('apps.layouts.main_layouts')
@section('menuTitle','Payment')
@section('apps_main_content')
<!-- Header2 Start -->
<div class="container-fluid">
  <div class="row header2 cart-header">
    <div class="container">
        <div class="back"><a href="{{route('apps.show.cart')}}"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a></div><h3>Payment</h3>
      </div>
  </div>
</div>
<!-- Header2 End -->
<!-- Payment Strat -->
<div class="container-fluid">
  <div class="row">
    <div class="address-block">
      <br>
      <fieldset class="form-group">
        <a class="btn btn-lg btn-secondary btn-block" href="{{route('order.payment.cod')}}"> CASH ON DELIVERY</a>      
      </fieldset>
    </div>
  </div>
</div>
<!-- Payment End -->
          
@endsection
