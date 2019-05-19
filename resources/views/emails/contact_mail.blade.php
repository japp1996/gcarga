<!DOCTYPE html>
<html>
<head>
 <title>Example</title>
</head>
<body>

<h1>Ha recibido un correo desde la web</h1>
<p>Quien escribe: {{ $data['nombre'] }}</p>
<p>Asunto: {{ $data['asunto'] }}</p>
<p>Numero de teléfono: {{ $data['phone'] }}</p>
<p>Mensaje: {{ $data['message'] }}</p>

</body>
</html> 
