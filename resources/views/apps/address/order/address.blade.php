@extends('apps.layouts.main_layouts')
@section('menuTitle','Order Address')
@section('apps_main_content')
<!-- Header2 Start -->
<div class="head-load">
    <div class="container-fluid">
      <div class="row header2 cart-header">
        <div class="container">
            <div class="back"><a href="{{url()->previous()}}"><svg class="header-icon menu-icon" viewBox="0 0 24 24"><path fill="#3E4152" fillrule="evenodd" d="M20.25 11.25H5.555l6.977-6.976a.748.748 0 000-1.056.749.749 0 00-1.056 0L3.262 11.43A.745.745 0 003 12a.745.745 0 00.262.57l8.214 8.212a.75.75 0 001.056 0 .748.748 0 000-1.056L5.555 12.75H20.25a.75.75 0 000-1.5"></path></svg></a></div><h3>Address</h3>
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
                <a add-id="{{$u_address->address_id}}" distance="{{$u_address->distance}}" kmChrg="{{$delCharges->km_charges}}" delArea="{{$delCharges->delivery_area}}" delfreeArea="{{$delCharges->delivery_free_area}}" id="select-add">               
                    <h3>{{$u_address->f_name.' '.$u_address->s_name}}</h3>
                    <p>{{$u_address->place_name }}</p>
                    <p>City : {{$u_address->select_city }}</p>
                    <p>Mobile No : {{$u_address->phone }}</p>
                    <p>Alt No : {{$u_address->alt_phone }}</p>
                </a>
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
@include('apps.address.modal')
<!-- Address End -->
<script>

$(document).ready(function(){
    var id,charge;
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
  $(document).on('click',"#select-add",function(event){
    event.preventDefault();
    $('#title').text('Confirm Address');
    id = $(this).attr('add-id');
    var delfreeArea = $(this).attr('delfreeArea'), kmChrg = $(this).attr('kmChrg') , delArea = $(this).attr('delArea') , distance = ($(this).attr('distance')/2000);

    if(distance > delArea)
    {   
        $("#body").text('Sorry!!! Delivery is not possible in selected address. We will reach you soon. Have a nice day.');
        $("#okBtn").hide();
        $("#closeBtn").text('OK');
    }
    else
    {
        if(distance > delfreeArea)
        {
            charge = Math.round(distance*kmChrg);
            $("#body").text('Rs: '+charge+' /- delivery charges applied for selected address.');
            $("#closeBtn").text('No');
        }
        else
        {   
            charge = 0;
            $("#body").text('Wow!!! You have free delivery.');
            $("#closeBtn").text('No');
        }
    }
    $('#address_modal').modal('show');
  });
  $(document).on('click',"#okBtn",function(event){
    event.preventDefault();
    var url = '{{url('apps/order/payment/')}}/'+id+'/'+charge+'';
    window.location = url;
  });

    /*
    |--------------------------------------------------------------------------
    | This is for Another Screen In App
    |--------------------------------------------------------------------------s
    */
    $("#_open_app_add_SC").click(function(){
        $("#cover-spin").show();
        window.AppInventor.setWebViewString("order_address_SC/"+$(this).data('ux'));
    });
});
</script>
@endsection