



@if(count($errors) > 0)

@foreach($errors->all() as $error)
<div id="okaymainpopupwrapper" class="mainpopupwrapper okay" onload="loadpopup()">       
<p class="popuptext"><i class="fa fa-bell" aria-hidden="true"></i> {{ $error }}</p>         
</div>   
@endforeach

<script>
$(window).on("load", function () {
$( "div.okay" ).fadeIn(200 ).delay(1200).fadeOut( 2000 );
});
</script>
@endif


@if(Session::get('success'))
<div id="okaymainpopupwrapper" class="mainpopupwrapper okay" onload="loadpopup()">       
<p class="popuptext"><i class="fa fa-bell" aria-hidden="true"></i> {{ Session::get('success') }}</p>         
</div>  
<script>
$(window).on("load", function () {
$( "div.okay" ).fadeIn(200 ).delay(1200).fadeOut( 2000 );
});
</script>
@endif