@extends('apps.layouts.main_layouts')
@section('menuTitle','Order Success')
@section('apps_main_content')
<!-- Header2 Start -->
<div class="container-fluid">
  <div class="row header2 cart-header">
    <div class="container">
        <div class="back"><a href="{{url()->previous()}}"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a></div><h3>Order Success</h3>
      </div>
  </div>
</div>
<!-- Header2 End -->
<!-- Cart Details Start -->
      <section class="success-page">
         <div class="container">
            <div class="row">
            	<div class="col-xl-12 order-done">
                <img src="{{asset ('public/apps/img/check.gif')}}" alt=""/>
                <h4 class="text-success">Congrats! Your Order has been Accepted..</h4>
                
                <div class="text-center">
                   <a href="{{route('apps.order')}}"><button type="submit" class="btn btn-secondary mb-2 btn-lg">See Order</button></a>                  
                </div>
                </div>
            </div>
         </div>
      </section>
      <!-- Cart Details End -->

@endsection
