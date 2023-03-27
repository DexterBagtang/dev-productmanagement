<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">




</head>
<body>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
  <header class="mdl-layout__header navigation_color">
@include('top_header')
  </header>




  <div class="mdl-layout__drawer">
  @include('side_menu')
  </div>

  <main class="mdl-layout__content">
    <div class="page-content">













    <!--Content-->












    </div>
  </main>

</div>
<!--Scripts-->
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</body>
</html>
