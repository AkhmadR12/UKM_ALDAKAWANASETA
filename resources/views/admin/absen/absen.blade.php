<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <h2>Absensi Hari Ini</h2>
    <button id="btnAbsen" class="btn btn-primary">Absen Sekarang</button>
    <p id="status"></p>
</div>
<script>
document.getElementById('btnAbsen').addEventListener('click', function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            fetch("{{ route('absen.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('status').innerText = data.message;
            })
            .catch(err => console.error(err));
        }, function(error) {
            alert("Gagal mengambil lokasi: " + error.message);
        });
    } else {
        alert("Browser tidak mendukung GPS!");
    }
});
</script>
</body>
</html>