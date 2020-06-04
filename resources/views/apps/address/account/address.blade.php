@extends('apps.layouts.main_layouts')
@section('menuTitle','Account Address')
@section('apps_main_content')
<!-- Header2 Start -->
<div class="head-load">
    <div class="container-fluid">
      <div class="row header2 cart-header">
        <div class="container">
            <div class="back"><a href="{{route('apps.account')}}"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a></div><h3>Address</h3>
          </div>
      </div>
    </div>    
</div>
<!-- Header2 End -->
<!-- Address Strat -->
<div class="address-load">
    <div class="container-fluid new-add">
        <div class="row">
        @if($address)
            @foreach($address as $u_address)
            <div class="save-add">          
                <h3>{{$u_address->f_name.' '.$u_address->s_name}}</h3>
                <p>{{$u_address->place_name }}</p>
                <p>City : {{$u_address->select_city }}</p>
                <p>Mobile No : {{$u_address->phone }}</p>
                <p>Alt No : {{$u_address->alt_phone }}</p>
                
                <div class="add-btn">
                    <a data-url="{{route('address.destroy',$u_address->address_id)}}" class="remove-add float-left">Remove</a>
                </div>
            </div>
            @endforeach  
        @endif      
         <div class="save-add add-new-add">                
            <a href="javascript:void();" class="add-add" id="_open_app_add_SC" data-ux="{{Auth::id()}}"><span class="mdi mdi-plus-circle-outline"></span> Add new address</a></div>
        </div>
    </div>  
</div>
<!-- Address End -->
<script>
$(document).ready(function(){
  $(document).on('click' ,'.remove-add',function(event){
    event.preventDefault();
    $("#cover-spin").show();
    $.ajax({
    type:'GET',
    url: $(this).data("url"), 
    dataType: 'json',
    success:function(data){
      if(data.delAdd)
      {        
        $(".address-load").load(window.location + " .address-load");  
        $(".head-load").load(window.location + " .head-load");  
        $("#cover-spin").hide(); 
      }
    },
    });
  });

  /*
    |--------------------------------------------------------------------------
    | This is for Another Screen In App
    |--------------------------------------------------------------------------s
    */
    $("#_open_app_add_SC").click(function(){
        $("#cover-spin").show();
        window.AppInventor.setWebViewString("account_address_SC/"+$(this).data('ux'));
    });
  
});
</script>
@endsection