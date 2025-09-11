{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 - Halaman Tidak Ditemukan</title>
    <style>
        body {
            background-color: #fefefe;
            color: #2d3748;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            font-size: 6rem;
            margin-bottom: 0;
        }
        p {
            font-size: 1.5rem;
        }
        a {
            margin-top: 20px;
            padding: 10px 20px;
            background: #2d3748;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }
        a:hover {
            background: #4a5568;
        }
    </style>
</head>
<body>
    <h1>404</h1>
    <p>Oops! Halaman yang Anda cari tidak ditemukan.</p>
    <a href="{{ url('/') }}">Kembali ke Beranda</a>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
  <title>404 - Halaman Tidak Ditemukan</title>
  <style>@import url("https://fonts.googleapis.com/css?family=Bungee");
    body {
      background: #1b1b1b;
      color: white;
      font-family: "Bungee", cursive;
      margin-top: 50px;
      text-align: center;
    }
    a {
      color: #2aa7cc;
      text-decoration: none;
    }
    a:hover {
      color: white;
    }
    svg {
      width: 50vw;
    }
    .lightblue {
      fill: #444;
    }
    .eye {
      cx: calc(115px + 30px * var(--mouse-x));
      cy: calc(50px + 30px * var(--mouse-y));
    }
    #eye-wrap {
      overflow: hidden;
    }
    .error-text {
      font-size: 120px;
    }
    .alarm {
      animation: alarmOn 0.5s infinite;
    }

    @keyframes alarmOn {
      to {
        fill: darkred;
      }
    }
  </style>
</head>
<body>
  <svg xmlns="http://www.w3.org/2000/svg" id="robot-error" viewBox="0 0 260 118.9" role="img">
    <title xml:lang="en">404 Error</title>
    <defs>
      <clipPath id="white-clip"><circle id="white-eye" fill="#cacaca" cx="130" cy="65" r="20" /></clipPath>
      <text id="text-s" class="error-text" y="106">404</text>
    </defs>
    <path class="alarm" fill="#e62326" d="M120.9 19.6V9.1c0-5 4.1-9.1 9.1-9.1h0c5 0 9.1 4.1 9.1 9.1v10.6" />
    <use xlink:href="#text-s" x="-0.5px" y="-1px" fill="black"></use>
    <use xlink:href="#text-s" fill="#2b2b2b"></use>
    <g id="robot">
      <g id="eye-wrap">
        <use xlink:href="#white-eye"></use>
        <circle id="eyef" class="eye" clip-path="url(#white-clip)" fill="#000" stroke="#2aa7cc" stroke-width="2" stroke-miterlimit="10" cx="130" cy="65" r="11" />
        <ellipse id="white-eye" fill="#2b2b2b" cx="130" cy="40" rx="18" ry="12" />
      </g>
      <circle class="lightblue" cx="105" cy="32" r="2.5" id="tornillo" />
      <use xlink:href="#tornillo" x="50"></use>
      <use xlink:href="#tornillo" x="50" y="60"></use>
      <use xlink:href="#tornillo" y="60"></use>
    </g>
  </svg>
  <h1>Oops! Halaman Tidak Ditemukan</h1>
  <h2><a href="{{ url('/') }}">Kembali ke Beranda</a></h2>

  <script>
    var root = document.documentElement;
    var eyef = document.getElementById('eyef');
    var cx = document.getElementById("eyef").getAttribute("cx");
    var cy = document.getElementById("eyef").getAttribute("cy");

    document.addEventListener("mousemove", evt => {
      let x = evt.clientX / innerWidth;
      let y = evt.clientY / innerHeight;

      root.style.setProperty("--mouse-x", x);
      root.style.setProperty("--mouse-y", y);

      cx = 115 + 30 * x;
      cy = 50 + 30 * y;
      eyef.setAttribute("cx", cx);
      eyef.setAttribute("cy", cy);
    });

    document.addEventListener("touchmove", touchHandler => {
      let x = touchHandler.touches[0].clientX / innerWidth;
      let y = touchHandler.touches[0].clientY / innerHeight;

      root.style.setProperty("--mouse-x", x);
      root.style.setProperty("--mouse-y", y);
    });
  </script>
</body>
</html>
