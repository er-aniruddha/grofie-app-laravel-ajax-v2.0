<script>
$('.otp-verify').hide();
$('.reg').hide();
$("#title").text('Login');
$("#spinerBtn").hide();
$("#regspinerBtn").hide();
$("#otpspinerBtn").hide();
$(document).ready(function(){
  $(document).on('click','#loginToggle',function(event){
    event.preventDefault();
    $("#title").text('Register');
    $('.login').hide();
    $('.reg').show();
    $('.otp-verify').hide();
  });
  $(document).on('click','#regToggle',function(event){
    event.preventDefault();
    $("#title").text('Login');
    $('.reg').hide();
    $('.login').show();
    $('.otp-verify').hide();
  });
  $('#loginForm').on('click','#loginBtn', function(event){
    event.preventDefault();
    $("#loginBtn").hide();
    $("#spinerBtn").show();
    var postData = new FormData($("#loginForm")[0]);   
    $('#phone1-error').html("");
    $('#phone2-error').html("");
      $.ajax({
      type:'POST',
      url:"{{route('apps.login.submit')}}", 
      contentType: false,
      cache: false,
      processData: false,
      dataType:"json",
      data : postData,
      success:function(data){
        if(data.errors)
        {
          $("#spinerBtn").hide();
          $("#loginBtn").show();
          if(data.errors.phone){
            $( '#phone1-error' ).html( data.errors.phone);
          }
          $('#phone2-error').html( data.errors);          
        }
        if(data.tmessage){
          $("#spinerBtn").hide();
          $("#loginBtn").show();
          toastr.options.positionClass = "toast-bottom-center";      
          toastr.options.timeOut = 5000;       
          toastr.success(data.tmessage.tmessage);
          $('.otp-verify').hide();
          $('.login').show();
        } 
        if(data.success == 1)
        {
          $('.otp-verify').show();
          $('.login').hide();
          $('.reg').hide();
          $("#demo_otp").html(data.otp);
        }
      },
    });
  });
  $('#otpSubmitForm').on('click','#otpBtn', function(event){
    event.preventDefault();
    $("#otpBtn").hide();
    $("#otpspinerBtn").show();
    var postData = new FormData($("#otpSubmitForm")[0]);  
    $('#otp-error').html("");
      $.ajax({
      type:'POST',
      url:"{{route('apps.otp.login.submit')}}", 
      contentType: false,
      cache: false,
      processData: false,
      dataType:"json",
      data : postData,
      success:function(data){
        console.log(data);
        if(data.errors)
        {
          $("#otpBtn").show();
          $("#otpspinerBtn").hide();
          $('#otp-error').html(data.errors);          
        }
        if(data.login == 1)
        {
          var url = "@php echo url()->previous(); @endphp";
          location.href = url;
        }
      },
    });
  });
  $(document).on('click','#resendBtn',function(event){
    event.preventDefault();
    $.ajax({
      type:'GET',
      url:"{{route('apps.otp.resend')}}",
      dataType:"json",
      success:function(data){
        console.log(data);
        if(data.tmessage)
        {
          toastr.options.positionClass = "toast-bottom-center";      
          toastr.options.timeOut = 5000;
          toastr.options.preventDuplicates = true;       
          toastr.success(data.tmessage.tmessage);
        } 
        if(data.success == 1)
        {
          $('.otp-verify').show();
          $('.reg').hide();
          $('.login').hide();
          $("#demo_otp").html(data.otp);
        }
      },
    });
  });
  $('#regForm').on('click','#regBtn', function(event){
    event.preventDefault();
    $("#regspinerBtn").show();
    $("#regBtn").hide(); 
    var postData = new FormData($("#regForm")[0]);   
    $('#fname-error').html("");
    $('#sname-error').html("");
    $('#phone-error').html("");
    $('#email-error').html("");
      $.ajax({
      type:'POST',
      url:"{{route('apps.register')}}", 
      contentType: false,
      cache: false,
      processData: false,
      dataType:"json",
      data : postData,
      success:function(data){
        if(data.errors)
        {
          $("#regspinerBtn").hide();
          $("#regBtn").show();
          if(data.errors.f_name){
            $( '#fname-error' ).html( data.errors.f_name[0]);
          }
          if(data.errors.s_name){
            $( '#sname-error' ).html( data.errors.s_name[0]);
          }  
          if(data.errors.phone){
            $( '#phone-error' ).html( data.errors.phone[0]);
          }
          if(data.errors.email){
            $( '#email-error' ).html( data.errors.email[0]);
          }
        }
        if(data.tmessage){
          $("#regspinerBtn").hide();
          $("#regBtn").show();
          toastr.options.positionClass = "toast-bottom-center";      
          toastr.options.timeOut = 5000;       
          toastr.success(data.tmessage.tmessage);
          $('.otp-verify').hide();
          $('.reg').show();
        } 
        if(data.success == 1)
        {
          $('.otp-verify').show();
          $('.reg').hide();
          $('.login').hide();
          $("#demo_otp").html(data.otp);
        }
      },
    });
  });
});
</script>