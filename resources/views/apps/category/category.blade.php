@extends('apps.layouts.main_layouts')
@section('menuTitle','Category/Products')
@section('apps_main_content')
@php $base_url="http://www.grofie.in/" @endphp
<!-- Head Start -->
<div class="container-fluid">
  <div class="row header2 cart-header">
    <div class="container">
        <div class="cat-back back">
          <a href="{{url()->previous()}}"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a>
        </div>
        <h3 id="title"></h3>
        <div class="cart-item">
          <div class="cart-btn">
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
<!-- Category Start --> 
<div class="sb-list-bg"></div> 
<section class="top-category">  
  <div class="container">
    <div id="_cat">      
    </div>
     <div class="cat-sb-list">
         <ul  id="_sub_list">
            
                                   
         </ul>
      </div>
    <div class="clearfix"></div>
  </div> 
</section>
<!-- Category End --> 

<!-- All Product Show End --> 
<script>
  $("#cover-spin").show();
  $(document).ready(function(){
    $.ajax({
      type:'GET',
      url:"{{route('apps.category')}}",
      cache:false,
      dataType: 'json',
      success:function(data){
        $('#title').text('All Categories');
        for(var count=0; count < data.categories.length ; count++)
          {
            $("#_cat").append('<div class="category-item">'
                +'<a class="sc" >'
                  +'<img class="img-fluid" src="{{$base_url}}'+data.categories[count].image+'" alt="">'
                  +'<h6>'+data.categories[count].category_name+'</h6>'
                +'</a>'
                 
                +'<div class="cat-sb-list" >'
                  +'<h3>'+data.categories[count].category_name+'</h3>'
                  +'<ul id="_sub_list'+count+'">'
                   
                  +'</ul>'
                    

                +'</div>'
              +'</div>');

            for(var count1=0; count1 < data.sub_categories.length ; count1++)
            {
              if(data.categories[count].category_id == data.sub_categories[count1].category_id )
              {
                $("#_sub_list"+count).append('<li><button id="_sub_cat_btn" data-url="{{url('apps/category/sub/product')}}/'+data.sub_categories[count1].sub_cat_id+'">'+data.sub_categories[count1].sub_cat_name+'</button></li>')
              }
            }
          }
        $("#cover-spin").hide(); 
      }
    });

  $(document).on('click','.sc',function() { 
      $(this).next(".cat-sb-list").fadeIn();
    $(".sb-list-bg").fadeIn();
  });

  $(document).on('click','.sb-list-bg',function() {     
    $(".sb-list-bg").fadeOut();
    $(".cat-sb-list").fadeOut();
  });

  // $(document).on('click','.cat-sb-list li',function() {      
  //   $(".cat-sb-list").hide();
  //   $(".sb-list-bg").hide();
  //   //$(".cat-sb-list").hide();
  // });
  $(document).on('click',"#_sub_cat_btn",function(){
    $("#cover-spin").show();    
    window.location.href = $(this).data('url');
  //   $(".cat-sb-list").hide();
  //   $(".sb-list-bg").hide();
  });


  });
</script>
@endsection
