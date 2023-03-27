@if(Auth::user())
  <script>window.location = "/home";</script>
@else
  <script>window.location = "/login";</script>
@endif
