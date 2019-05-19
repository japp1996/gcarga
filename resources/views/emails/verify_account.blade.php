@component('mail::message')
# Bienvenido

Has recibido este correo porque fuiste registrado en GCARGA, por favor confirma para acceder a nuestra aplicación.
Tu código de confirmación es: <b>{{ $codes->code }}</b> O pulsa CONFIRMAR para continuar.

@component('mail::button', ['url' => env('APP_URL').'verify/'.$codes->code ])
Confirmar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
