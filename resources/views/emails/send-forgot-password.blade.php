<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
</head>
<body>
<p>Hi {{ $first_name }} {{ $last_name }},</p>
<p><a href="{{ url('/') }}/reset-password/{{ $token }}/{{ $code }}">Please click here to reset your password.</a></p>
<p>If the link above did not work. Please copy and paste the below link to your browser.</p>
<p>{{ url('/') }}/reset-password/{{ $token }}/{{ $code }}</p>
</body>
</html>