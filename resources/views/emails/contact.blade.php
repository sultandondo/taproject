<!DOCTYPE html>
<html>
<head>
    <title>Pesan Baru dari Formulir Kontak SkyLinkCal</title>
</head>
<body>
    <p>Anda menerima pesan baru dari formulir kontak SkyLinkCal.</p>
    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subjek:</strong> {{ $data['subject'] }}</p>
    <p><strong>Pesan:</strong></p>
    <p>{!! nl2br(e($data['message'])) !!}</p>
</body>
</html>