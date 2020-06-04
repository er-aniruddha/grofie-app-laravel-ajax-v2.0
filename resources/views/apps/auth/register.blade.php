<!-- Header2 End -->
<div class="reg">
  <!-- Register In Strat -->
<div class="container-fluid">
  <div class="row log-reg">  
  <div class="log-img"><img src="{{asset('public/apps/img/loader2.gif')}}" alt=""/></div>  
    <div class="login-pop" id="log">
      <!-- <form method="POST" action="{{ route('apps.register') }}"> -->
      <form method="POST" id="regForm">
      @csrf   
      <fieldset class="form-group">        
        <input type="text" name="f_name" id="f_name" class="form-control" autocorrect="off" autofocus="autofocus" autocomplete="off" animate="true">
        <label>First Name</label>
        <span style="color:red" role="alert">
          <strong id="fname-error"></strong>
        </span>
      </fieldset>
      <fieldset class="form-group">        
        <input type="text" name="s_name" id="s_name" class="form-control" autocorrect="off" autofocus="autofocus" autocomplete="off" animate="true">
        <label>Surname</label>
        <span style="color:red" role="alert">
          <strong id="sname-error"></strong>
        </span>
      </fieldset>
      <fieldset class="form-group">        
        <input type="text" name="phone" id="phone" class="form-control" minlength="10" maxlength="10" autocorrect="off" autofocus="autofocus" autocomplete="off" animate="true">
        <label>Phone</label>
        <span style="color:red" role="alert">
          <strong id="phone-error"></strong>
        </span>
      </fieldset>
      <fieldset class="form-group">        
        <input type="email" name="email" id="email" class="form-control"autocorrect="off" autofocus="autofocus" autocomplete="off" animate="true">
        <label>Email ID</label>
        <span style="color:red" role="alert">
          <strong id="email-error"></strong>
        </span>
      </fieldset>
      <fieldset class="form-group">
        <button type="submit" class="btn btn-lg btn-secondary btn-block" id="regBtn"><i class="mdi mdi-pencil"></i> REGISTER</button>
        <button class="btn btn-primary loader" type="button" id="regspinerBtn" disabled>
        <span class="spinner-border spinner-border-sm text-success" role="status" aria-hidden="true"></span>
          </button>  
      </fieldset>
   <!--  <div class="custom-control custom-checkbox">
    <input type="checkbox" checked="checked" class="custom-control-input" id="customCheck1" required="">
    <label class="custom-control-label" for="customCheck1">I Agree with <a href="#">Term and Conditions</a></label>
    </div> -->
    <a id="regToggle"><i class="mdi mdi-lock"></i> Already have an Account? <span>Log in</span></a>
</form>
    </div>

  </div>
</div>
<!-- Register In End -->
</div>



