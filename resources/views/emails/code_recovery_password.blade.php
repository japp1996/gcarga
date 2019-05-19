@component('mail::message')

Has recibido este correo porque haz solicitado la recuperacion de contraseña, por favor registra el siguiente código para recuperarla
<br>
<b><h2>{{ $codes->code }}</h2></b>

Gracias!,<br>
{{ config('app.name') }}
@endcomponent
