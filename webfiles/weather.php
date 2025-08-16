<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>What's Growing On?</title>
    <link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon.svg" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Plants" />
    <link rel="manifest" href="site.webmanifest" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap-overrides.css" />
    <link rel="stylesheet" href="css/weather.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <img src="imgs/logo-with-copyright.png" alt="Logo" width="28" height="28" class="d-inline-block align-text-top">
          What's Growing On?
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="todo.php">To-Do</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="">Weather</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="calendar.php">Calendar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="plants.php">Plants</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="locations.php">Locations</a>
            </li>
          </ul>
          <ul class="navbar-nav mr-0 mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="settings.php">Settings</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="forecast-container">
      <h1>7-Day Weather Forecast</h1>
      <div class="forecast-grid">
        <div class="day-card">
          <h2>Monday</h2>
          <p>High: 25°C</p>
          <p>Low: 16°C</p>
          <p>Rain: 10%</p>
        </div>
        <div class="day-card">
          <h2>Tuesday</h2>
          <p>High: 27°C</p>
          <p>Low: 17°C</p>
          <p>Rain: 20%</p>
        </div>
        <div class="day-card">
          <h2>Wednesday</h2>
          <p>High: 26°C</p>
          <p>Low: 18°C</p>
          <p>Rain: 15%</p>
        </div>
        <div class="day-card">
          <h2>Thursday</h2>
          <p>High: 24°C</p>
          <p>Low: 15°C</p>
          <p>Rain: 30%</p>
        </div>
        <div class="day-card">
          <h2>Friday</h2>
          <p>High: 23°C</p>
          <p>Low: 14°C</p>
          <p>Rain: 5%</p>
        </div>
        <div class="day-card">
          <h2>Saturday</h2>
          <p>High: 28°C</p>
          <p>Low: 19°C</p>
          <p>Rain: 25%</p>
        </div>
        <div class="day-card">
          <h2>Sunday</h2>
          <p>High: 29°C</p>
          <p>Low: 20°C</p>
          <p>Rain: 40%</p>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>
