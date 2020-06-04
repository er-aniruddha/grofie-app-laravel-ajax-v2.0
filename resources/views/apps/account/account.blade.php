@extends('apps.layouts.main_layouts')
@section('menuTitle','Account')
@section('apps_main_content')
<!-- Header2 Start -->
<div class="container-fluid">
  <div class="row header2 cart-header">
    <div class="container">
        <div class="back">
          <a href="{{route('apps.home')}}"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a>
        </div>
        <h3>Account</h3>
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
<!-- Header2 End -->     
<section class="account-page section-padding">
<div class="container">
  <div class="row">
    <div class="card">
      <div class="user-profile-header">
         <img alt="logo" src="{{asset('public/apps/img/account-img.jpg')}}">
         <h5 class="mb-1 text-secondary">Hi, {{ Auth::user()->f_name.' '.Auth::user()->s_name}} </h5> 
         <p><i aria-hidden="true" class="mdi mdi-approval"></i>  +91 {{ Auth::user()->phone }}</p>
      </div>
        <div class="accordion" id="profile-accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <a class="collapseOne">
                  <i aria-hidden="true" class="mdi mdi-account-outline"></i> My Profile
                </a>
              </h2>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#profile-accordion">
            <div class="card-body">
              <div class="section-header ">
                <h5 class="heading-design-h5"></h5>
              </div>
              <form method="POST" id="userInfoEdit">
               @csrf               
                <div class="row">
                   <div class="col-sm-6">
                      <div class="form-group">
                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
                         <input class="form-control border-form-control" name="f_name" id="f_name" value="{{Auth::user()->f_name}}" type="text">
                          <span style="color:red" role="alert">
                            <strong id="fname-error"></strong>
                          </span>
                      </div>
                   </div>
                   <div class="col-sm-6">
                      <div class="form-group">               
                         <input class="form-control border-form-control" name="s_name" id="s_name" value="{{Auth::user()->s_name}}" type="text">
                          <span style="color:red" role="alert">
                            <strong id="sname-error"></strong>
                          </span>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-sm-6">
                      <div class="form-group">
                         <input class="form-control border-form-control" value="{{Auth::user()->phone}}" type="text" disabled="">               
                      </div>
                   </div>
                   <div class="col-sm-6">
                      <div class="form-group">               
                         <input class="form-control border-form-control" name="email" id="email" value="{{Auth::user()->email}}" type="email">
                         <span style="color:red" role="alert">
                            <strong id="email-error"></strong>
                          </span>              
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-sm-12 text-right">            
                      <button type="submit" class="btn btn-success btn-lg saveBtn"> Save Changes </button>
                   </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="list-group">
           <a href="{{route('account.address')}}" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-map-marker-circle"></i>  My Address</a>
           
           <a href="{{url('apps/order')}}" class="list-group-item list-group-item-action"><i aria-hidden="true" class="mdi mdi-format-list-bulleted"></i>  Order List</a> 
            
           <a href="" class="list-group-item list-group-item-action"onclick="event.preventDefault();document.
           getElementById('logout-form').submit();"><i aria-hidden="true" class="mdi mdi-lock" ></i>Logout</a> 
           <form id="logout-form" action="{{ route('apps.logout') }}" method="POST" style="display: none;">
           @csrf
           </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  $(document).ready(function(){
    $(document).on('click','.collapseOne',function(){
      $("#collapseOne").show(); 
    });
    $('#userInfoEdit').on('click','.saveBtn', function(event){
    event.preventDefault();
    $("#cover-spin").show();
      var postData = new FormData($("#userInfoEdit")[0]);   
      $('#fname-error').html("");
      $('#sname-error').html("");
      $('#email-error').html("");
        $.ajax({
        type:'POST',
        url:"{{route('apps.account.edit')}}", 
        contentType: false,
        cache: false,
        processData: false,
        dataType:"json",
        data : postData,
        success:function(data){
          console.log(data);
          if(data.errors)
          {
            if(data.errors.f_name)
            {  
              $( '#fname-error' ).html( data.errors.f_name[0]);
            }
            if(data.errors.s_name)
            {
              $( '#sname-error' ).html( data.errors.s_name[0]);
            }
            if(data.errors.email)
            {  
              $( '#email-error' ).html( data.errors.email[0]); 
            }
         }         
         if(data.tmessage)
         {
            toastr.options.positionClass = "toast-bottom-center";
            toastr.options.preventDuplicates = true;        
            toastr.options.timeOut = 5000;       
            toastr.success(data.tmessage.tmessage);
         }
         if(data.success == 1)
         { 
            $("#cover-spin").hide(); 
            $("#collapseOne").hide();      
         }       
        },
      });
    });

  });
</script>

@endsection