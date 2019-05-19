@extends('layouts.public')
@section('title', 'E-Mail | Recuperación de Contraseña')
@section('content')
<password-recovery :codes="{{$code}}"></password-recovery>
@endsection
@section('script')
<script type="text/javascript" language="javascript" src="{{ asset('assets/vendor/jquery/jquery.min.j') }}s"></script>
<script type="text/javascript" language="javascript" src="{{ asset('assets/vendor/jquery.easing/js/jquery.easing.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('assets/vendor/tether.min.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('assets/vendor/bootstrap/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript" language="javascript" >
	$('#accept').click(function(){
	  if ($(this).is(':checked') === true) {$(this).val('1');}
	  else{$(this).val('0')}
	});
</script>
@endsection
