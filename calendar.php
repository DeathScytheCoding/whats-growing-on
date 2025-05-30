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
    <link rel="stylesheet" href="css/calendar.css" />
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
              <a class="nav-link" href="weather.php">Weather</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="">Calendar</a>
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
    <div class="calendar-container">
      <h1>May 2025</h1>
      <div class="calendar">
        <div class="day-label">Sun</div>
        <div class="day-label">Mon</div>
        <div class="day-label">Tue</div>
        <div class="day-label">Wed</div>
        <div class="day-label">Thu</div>
        <div class="day-label">Fri</div>
        <div class="day-label">Sat</div>

        <!-- Empty cells for padding (May 1st, 2025 is a Thursday) -->
        <div class="day empty"></div>
        <div class="day empty"></div>
        <div class="day empty"></div>
        <div class="day empty"></div>

        <!-- Days of May -->
        <div class="day">1
          <div class="day-tasks">
            <a href="#task1modal"><p style="background-color:#00CCFF">Water Spinach and prune turnips</p></a>
            <a href="#task2modal"><p style="background-color:#00FFCC">Fertilize Onions</p></a>
          </div>
        </div>
        <div class="day">2</div>
        <div class="day">3</div>
        <div class="day">4</div>
        <div class="day">5</div>
        <div class="day">6</div>
        <div class="day">7</div>
        <div class="day">8</div>
        <div class="day">9</div>
        <div class="day">10</div>
        <div class="day">11</div>
        <div class="day">12</div>
        <div class="day">13</div>
        <div class="day">14</div>
        <div class="day">15</div>
        <div class="day">16</div>
        <div class="day">17</div>
        <div class="day">18</div>
        <div class="day">19</div>
        <div class="day">20</div>
        <div class="day">21</div>
        <div class="day">22</div>
        <div class="day">23</div>
        <div class="day">24</div>
        <div class="day">25</div>
        <div class="day">26</div>
        <div class="day">27</div>
        <div class="day">28</div>
        <div class="day">29</div>
        <div class="day">30</div>
        <div class="day">31</div>
      </div>
    </div>
