@extends('apps.layouts.main_layouts')
@section('menuTitle','Login')
@section('apps_main_content')
<!-- Header2 Start -->
<div class="container-fluid">
  <div class="row header2 cart-header">
    <div class="container">
      <div class="back"><a href="{{url()->previous()}}"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a></div><h3 id="title"></h3>
      </div>
  </div>
</div>
<!-- Header2 End -->

<!-- Log In Strat -->
<div class="login">
  <div class="container-fluid">
    <div class="row log-reg">    
      <div class="log-img"><img src="{{asset('public/apps/img/loader2.gif')}}" alt=""/></div>
      <div class="login-pop" id="log">
        <!-- <form method="POST" action="{{ route('apps.login.submit') }}"> -->
        <form method="POST" id="loginForm">
        @csrf   
        <fieldset class="form-group">        
          <input type="text" name="phone" id="phone" class="form-control" maxlength="10" autocorrect="off" autofocus="autofocus" autocomplete="off" animate="true">
          <label>Enter Mobile Number</label>
            <span style="color:red" role="alert">
              <strong id="phone1-error"></strong>
              <strong id="phone2-error"></strong>
            </span>   
        </fieldset>
          <fieldset class="form-group">
          <button type="submit" id="loginBtn" class="btn btn-lg btn-secondary btn-block">
            <i class="mdi mdi-lock"></i> LOGIN
          </button>
          <button class="btn btn-primary loader" type="button" id="spinerBtn" disabled>
            <span class="spinner-border spinner-border-sm text-success" role="status" aria-hidden="true"></span>
          </button>  
        </fieldset>
      <!-- <div class="custom-control custom-checkbox">
      <input type="checkbox" checked="checked" class="custom-control-input" id="customCheck1" required="">
      <label class="custom-control-label" for="customCheck1">Remember me</label>
      </div> -->
      <a id="loginToggle"><i class="mdi mdi-pencil"></i> New to Our store? <span>Sign up</span></a>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Log In End -->
<!-- Otp Verify Start -->
@include('apps.auth.otp_verify')
@include('apps.auth.register')
@include('apps.auth.auth_script')
<!-- Otp Verify Start -->
@endsection