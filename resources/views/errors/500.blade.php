<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>500 - Kesalahan Server</title>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Bungee&display=swap");

    body {
      background-color: #1b1b1b;
      color: white;
      font-family: "Bungee", cursive;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      text-align: center;
    }

    .error-container {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 8rem;
    }

    .digit {
      margin: 0 10px;
    }

    .eye-wrapper {
      position: relative;
      width: 100px;
      height: 100px;
      background: #cacaca;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .pupil {
      width: 30px;
      height: 30px;
      background: #000;
      border: 3px solid #2aa7cc;
      border-radius: 50%;
      position: absolute;
      transition: all 0.05s linear;
    }

    a {
      color: #2aa7cc;
      text-decoration: none;
      font-size: 1.2rem;
    }

    a:hover {
      color: white;
    }

    .alarm {
      width: 20px;
      height: 20px;
      background-color: #e62326;
      border-radius: 50%;
      animation: alarmOn 0.5s infinite;
      margin-bottom: 20px;
    }

    @keyframes alarmOn {
      to {
        background-color: darkred;
      }
    }
  </style>
</head>
<body>
  <div class="alarm"></div>
  <div class="error-container">
    <div class="digit">5</div>
    <div class="eye-wrapper">
      <div class="pupil" id="pupil1"></div>
    </div>
    <div class="eye-wrapper">
      <div class="pupil" id="pupil2"></div>
    </div>
  </div>
  <h1>Oops! Terjadi Kesalahan Server</h1>
  <h2><a href="{{ url('/') }}">Kembali ke Beranda</a></h2>

  <script>
    const pupil1 = document.getElementById("pupil1");
    const pupil2 = document.getElementById("pupil2");

    document.addEventListener("mousemove", (e) => {
      const eyes = [pupil1, pupil2];
      eyes.forEach(pupil => {
        const rect = pupil.parentElement.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        const angle = Math.atan2(y, x);
        const radius = 20;
        const pupilX = Math.cos(angle) * radius;
        const pupilY = Math.sin(angle) * radius;
        pupil.style.transform = `translate(${pupilX}px, ${pupilY}px)`;
      });
    });
  </script>
</body>
</html>
