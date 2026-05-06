<!DOCTYPE html>
<html>
<head>
    <title>Nouveau message de contact</title>
</head>
<body>
<h1>Nouveau message de contact</h1>
<p><strong>Nom :</strong> {{ $donnees['name'] }}</p>
<p><strong>Email :</strong> {{ $donnees['email'] }}</p>
<p><strong>Sujet :</strong> {{ $donnees['subject'] }}</p>
<p><strong>Message :</strong></p>
<p>{{ $donnees['message'] }}</p>
</body>
</html>
