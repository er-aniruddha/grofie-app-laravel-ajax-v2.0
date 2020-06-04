@extends('apps.layouts.main_layouts')
@section('menuTitle','Product Category')
@section('apps_main_content')
@php $base_url="http://www.grofie.in/" @endphp
<!-- Header2 Start -->
<!-- Search Start -->
<div class="search-div">
	<fieldset class="form-group">
		<input type="text" class="form-control" autocorrect="off"autofocus="autofocus" autocomplete="off" animate="true" autocomplete="off" autocapitalize="off" spellcheck="false" name="search" id="search" placeholder="Search your product">
		<input type="submit" id="search_btn">

    <div class="spinner-border"><span class="sr-only">Loading...</span></div>
	</fieldset>
</div>
<section class="search cart-page">
 <div class="container">
    <div class="row">
      <div class="cart-table">
        <!-- Show Result Section -->
          <div class="cart-body" id="result"> 

         </div>
      </div>
    </div>
 </div>
</section>
<!-- Cart Details End -->
<script>
$('.spinner-border').hide();  
$(document).ready(function(){
  //on key serach after 3 input
  $("#search").autocomplete({
    source: function(request, response) {    
    $('.spinner-border').show();
      var query =  $('#search').val(); 
      if(query != '')
      {
        $.ajax({
          type:'GET',
          url:"{{route('search.product')}}",
          cache: false,
          dataType:"json",
          data:{query:query},
          beforeSend:function(){
            $("#result").load(window.location + " #result");
          },
          success:function(data){
          setTimeout(function(){ 
            $('.spinner-border').hide();
            for(var count=0; count < data.products.length ; count++){ 
              if(data.products[count].product_offers > 0){
                $('#result').prepend(' <a href={{ url('/apps/show-single-product')}}/'+data.products[count].product_id+'>'
                +'<div class="cart-list-product">'
                +'<div class="pro-img">'
                +'<img class="img-fluid" src="{{$base_url}}'+data.products[count].product_image_main+'" alt=""></div>'
                +'<div class="pro-desc"><h5>'+data.products[count].product_name+
                '</h5><p>'+data.products[count].brand_name+'</p>'
                +'<div class="qty"><h6>'
                +'<span class="mdi mdi-approval"></span> Unite - '+data.products[count].unit_name_sm+'<span></span></h6></div>'
                +'<div class="price">&#8377; '+data.products[count].product_sell_price_after_offer+' <span class="regular-price">&#8377; '+data.products[count].product_sell_price+'</span> <span class="offer-price"> '+data.products[count].product_offers+'%</span></div></div></div>');              
              }
              else{
                $('#result').prepend(' <a href={{ url('/apps/show-single-product')}}/'+data.products[count].product_id+'>'
                +'<div class="cart-list-product">'
                +'<div class="pro-img">'
                +'<img class="img-fluid" src="{{$base_url}}'+data.products[count].product_image_main+'" alt=""></div>'
                +'<div class="pro-desc"><h5>'+data.products[count].product_name+
                '</h5><p>'+data.products[count].brand_name+'</p>'
                +'<div class="qty"><h6><span class="mdi mdi-approval"></span> Unite - '+data.products[count].unit_name_sm+'<span></span></h6></div>'
                +'<div class="price">&#8377; '+data.products[count].product_sell_price+'</div></div></div>');      
              }  
            }
          },1000); 
         
          },
        }); 
      }
      else
      {
        $('.spinner-border').hide(); 
      }
    }  
  });

  //onclick submit btn
  $("#search_btn").click(function(){
    $('.spinner-border').show();
      var query =  $('#search').val(); 
      if(query != '')
      {
        $.ajax({
          type:'GET',
          url:"{{route('search.product')}}",
          data:{query:query},
          dataType:'json',
          beforeSend:function(){
            $("#result").load(window.location + " #result");
          },
          success:function(data){
          setTimeout(function(){ 
            $('.spinner-border').hide();
            for(var count=0; count < data.products.length ; count++){ 
              if(data.products[count].product_offers > 0){
                $('#result').prepend(' <a href={{ url('/apps/show-single-product')}}/'+data.products[count].product_id+'>'
                +'<div class="cart-list-product">'
                +'<div class="pro-img">'
                +'<img class="img-fluid" src="https://grofie.in/'+data.products[count].product_image_main+'" alt=""></div>'
                +'<div class="pro-desc"><h5>'+data.products[count].product_name+
                '</h5><p>'+data.products[count].brand_name+'</p>'
                +'<div class="qty"><h6>'
                +'<span class="mdi mdi-approval"></span> Unite - '+data.products[count].unit_name_sm+'<span></span></h6></div>'
                +'<div class="price">&#8377; '+data.products[count].product_sell_price_after_offer+' <span class="regular-price">&#8377; '+data.products[count].product_sell_price+'</span> <span class="offer-price"> '+data.products[count].product_offers+'%</span></div></div></div>');              
              }
              else{
                $('#result').prepend(' <a href={{ url('/apps/show-single-product')}}/'+data.products[count].product_id+'>'
                +'<div class="cart-list-product">'
                +'<div class="pro-img">'
                +'<img class="img-fluid" src="https://grofie.in/'+data.products[count].product_image_main+'" alt=""></div>'
                +'<div class="pro-desc"><h5>'+data.products[count].product_name+
                '</h5><p>'+data.products[count].brand_name+'</p>'
                +'<div class="qty"><h6><span class="mdi mdi-approval"></span> Unite - '+data.products[count].unit_name_sm+'<span></span></h6></div>'
                +'<div class="price">&#8377; '+data.products[count].product_sell_price+'</div></div></div>');      
              }  
            }
          },1000); 
         
          },
        }); 
      }
      else
      {
        $('.spinner-border').hide(); 
      }

  });
});
</script>
@endsection