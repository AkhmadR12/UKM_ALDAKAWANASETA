<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notifikasi Member</title>
</head>
<body>
    <h2>Halo {{ $member->name }}</h2>
    <p>Terima kasih telah bergabung sebagai member kami.</p>
    <p>ID Member: {{ $member->id_member }}</p>
    <p>Status: {{ $member->status }}</p>
    <p>Berlaku sampai: {{ \Carbon\Carbon::parse($member->tanggal_berakhir)->format('d/m/Y') }}</p>
</body>
</html>
