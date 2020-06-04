<div class="otp-verify">
    
  <div class="container-fluid">
    <div class="row log-reg">    
      <div class="log-img"><img src="{{asset('public/apps/img/loader2.gif')}}" alt=""/></div>
      <div class="login-pop" id="log">
       <!--  <form method="POST" action="{{ route('apps.otp.login.submit') }}"> -->
        <form method="POST" id="otpSubmitForm">
        @csrf
        <fieldset class="form-group">        
            <input type="text" name="otp" id="otp" class="form-control" maxlength="4" autocorrect="off" autofocus="autofocus" autocomplete="off" animate="true">
            <label>Enter OTP</label>          
              <span style="color:red" role="alert">
              <strong id="otp-error"></strong>
            </span>         
        </fieldset>   
        <fieldset class="form-group">
          <button type="submit" class="btn btn-lg btn-secondary btn-block" id="otpBtn"><i class="mdi mdi-pencil"></i> SUBMIT</button>
          <button class="btn btn-primary loader" type="button" id="otpspinerBtn" disabled>
            <span class="spinner-border spinner-border-sm text-success" role="status" aria-hidden="true"></span>
          </button>  
        </fieldset>    
        </form>
          <a id="resendBtn" data-url="{{url('apps/login/verification/resend/otp')}}"><span>Resend</span> <p id="demo_otp"></p></a>
      </div>
    </div>
  </div>
</div>
