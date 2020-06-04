<!-- Footer Block Start -->	
<section class="footer">
	<div class="container">
    <ul>
  	  <li class="{{Request::is('apps/home') ? 'active' : null}}"><a href="{{ url ('/apps/home')}}" id="1"><i class="mdi mdi-home-outline"></i><span>Home</span></a></li>
      <li class="{{Request::is('apps/category') ? 'active' : null}}"><a href="{{ url ('/apps/category')}}" id="1"><i class="mdi mdi-apps"></i><span>Category</span></a></li>
      <li class="{{Request::is('apps/search') ? 'active' : null}}"><a href="{{ url ('apps/search')}}" id="1"><i class="mdi mdi-magnify"></i><span>Search</span></a></li>
      <li class="{{Request::is('apps/order') ? 'active' : null}}"><a href="{{ url('/apps/order')}}" id="1"><i class="mdi mdi-cart-outline"></i><span>Orders</span></a></li>
      <li class="{{Request::is('apps/account') || Request::is('apps/show/account/address') || Request::is('apps/login') ? 'active' : null}}" id="1"><a href="{{ url('/apps/account')}}"><i class="mdi mdi-account-outline"></i><span>Account</span></a></li>
      <div class="clearfix"></div>
    </ul>
  </div>
</section>
<!-- Footer Block End -->
  <!-- Bootstrap core JavaScript -->
  <script  src="{{ asset ('/public/apps/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Owl Carousel -->
  <script  src="{{ asset ('/public/apps/js/owl.carousel.min.js')}}"></script>
  <!-- Custom -->
  <script  src="{{ asset ('/public/apps/js/custom.js')}}"></script> 
  <!-- toaster script -->
  <script src="{{ asset ('/public/apps/js/toastr.min.js')}}"></script>
  <script>
    @if(Session::has('tMessage'))      
      toastr.success("{{ Session::get('tMessage')}}")
    @endif    
  </script>
  <script>
  $(document).ready(function(){
    $(document).on('click',"#1",function(){
      $("#cover-spin").show();
    });
  });
    
  </script>
</body>
</html>