@extends('apps.layouts.main_layouts')
@section('menuTitle','My Cart')
@section('apps_main_content')

<button id="location-button">Get User Location</button>
<div id="lat"></div>
<div id="long"></div>


<script>
	$(document).ready(function(){
		 $('#location-button').click(function(){
		 	
		 	  //check if geolocation is available
                    geolocation.getCurrentPosition(function(position){
                      var lat =  position.coords.latitude;
                      var long = position.coords.longitude;
	                      if(lat == '')
	                      {
	                      	location.reload();
	                      }
	                      else
	                      {
	                      	$('#lat').html(lat);
	                        $('#long').html(long);	
	                      }
                      
                    });   
             
		 });
	});
</script>


@endsection