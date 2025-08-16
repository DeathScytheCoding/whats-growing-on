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
              <a class="nav-link active" aria-current="page" href="">To-Do</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="weather.php">Weather</a>
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
    <div class="container-fluid">
      <div class="container mx-w-100 todo-list">
        <h1 class="text-center">To-Do</h1>
        <hr style="color: #000000; padding: 5px;"/>
        <div class="list-group list-group-flush border-bottom scrollarea">
          <a href="#exampleModal" data-bs-toggle="modal" data-target="#exampleModal" class="list-group-item list-group-item-action active py-3 lh-tight">
            <div class="d-flex w-100 align-items-center justify-content-between">
              <strong class="mb-1">Task</strong>
              <small>Today</small>
            </div>
            <div class="col-10 mb-1 small">Task description.</div>
          </a>
          <a href="" class="list-group-item list-group-item-action active py-3 lh-tight">
            <div class="d-flex w-100 align-items-center justify-content-between">
              <strong class="mb-1">Task</strong>
              <small>Today</small>
            </div>
            <div class="col-10 mb-1 small">Task description.</div>
          </a>
          <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
            <div class="d-flex w-100 align-items-center justify-content-between">
              <strong class="mb-1">Task</strong>
              <small>Day</small>
            </div>
            <div class="col-10 mb-1 small">Task description.</div>
          </a>
          <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
            <div class="d-flex w-100 align-items-center justify-content-between">
              <strong class="mb-1">Task</strong>
              <small>Day</small>
            </div>
            <div class="col-10 mb-1 small">Task description.</div>
          </a>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Task Title</h5>
            <button type="button" class="close ms-auto" data-bs-dismiss="modal" aria-label="Close" style="float:right;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Task Description
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" >Edit</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Mark as Complete</button>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>
