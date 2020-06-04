<!DOCTYPE html>
<html lang="en">  
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@yield('pageTitle')</title>      
      <!-- Bootstrap core CSS -->
      <link href="{{ asset ('/public/apps/css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Material Design Icons -->
      <link href="{{ asset ('/public/apps/css/materialdesignicons.min.css')}}" media="all" rel="stylesheet" type="text/css" />
      <!-- Custom styles for this template -->
      <link href="{{ asset ('/public/apps/css/style.css')}}" rel="stylesheet">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="{{ asset ('/public/apps/css/owl.carousel.css')}}">
      <link rel="stylesheet" href="{{ asset ('/public/apps/css/owl.theme.css')}}">
      <!-- Toaster CSS -->
      <link href="{{ asset ('/public/apps/css/toastr.css')}}" rel="stylesheet"/>
      <!-- Ajax java script -->     
      <script src="{{ asset('/public/apps/js/jquery.min.js') }}"></script>
      <script  src="{{ asset('/public/apps/js/jquery-ui.min.js') }}"></script>
   </head>
<body>
 
<!--loader end-->
<div class="pop-overlay"></div>
<div id="cover-spin"></div>
