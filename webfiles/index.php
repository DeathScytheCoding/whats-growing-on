<?php
	//Open db file and make sure all tables are created
	
	class whatsGrowingDB extends SQLite3 {
      function __construct() {
         $this->open('../data/whats-growing-on.db');
      }
	}
	
	//$databaseFile = '../data/whats-growing-on.db';
	
	//$db = new SQLite3($databaseFile);

	$db = new whatsGrowingDB();
	if(!$db) {
	  echo $db->lastErrorMsg();
	} else {
	  print( "Opened database successfully\n");
	}

	$sql =<<<EOF
		CREATE TABLE IF NOT EXISTS locations (
			loc_id INTEGER PRIMARY KEY,
			loc_name TEXT NOT NULL
		);

		CREATE TABLE IF NOT EXISTS plants (
		  plant_id integer PRIMARY KEY,
		  plant_name varchar,
		  plant_desc varchar,
		  plant_img varchar,
		  plant_color varchar(7),
		  plant_loc integer
		);

		CREATE TABLE IF NOT EXISTS tasks (
		  task_id integer primary key,
		  task_name varchar,
		  task_desc varchar,
		  task_anch bool,
		  task_due datetime
		);
	EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
   $db->close();
?>

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
        <a class="navbar-brand" href="">
          <img src="imgs/logo-with-copyright.png" alt="Logo" width="28" height="28" class="d-inline-block align-text-top">
          What's Growing On?
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="todo.php">To-Do</a>
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
    <div "container-fluid">
      <div class="row gx-0">
        <div class="col-2 mx-w-100">
          <div class="d-flex flex-column align-items-center text-center border-bottom">
            <h3 class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none">Weather Today</h3>
            <p class="d-flex m-0">Indianapolis, IN</p>
            <p class="d-flex pt-1 m-0">70°</p>
            <p class="d-flex">55% Chance of Rain</p>
          </div>
          <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white mx-w-100" style="width: 100%; margin-bottom: 24px;">
            <a href="" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
              <span class="fs-5 fw-semibold text-center d-flex align-items-center flex-shrink-0 link-dark text-decoration-none">To-Do This Week</span>
            </a>
            <div class="list-group list-group-flush border-bottom scrollarea">
              <a href="" class="list-group-item list-group-item-action active py-3 lh-tight" aria-current="true">
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
        <div class="col-auto d-flex">
          <div class="vr" style="height: 100%;"></div>
        </div>
        <div class="col ms-auto p-0">
          <h1 class="text-center mb-0 pt-4">Plants</h1>
          <div class="d-flex flex-column mr-auto px-4 py-4">
            <div class="row row-cols-1 row-cols-md-3 g-4" style="margin-right:0;padding-right:0;">
              <div class="col">
                <div class="card h-100">
                  <img src="imgs/test_1.jpg" class="card-img-top card_img" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card h-100">
                  <img src="imgs/test_2.jpg" class="card-img-top card_img" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a short card.</p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card h-100">
                  <img src="imgs/test_3.webp" class="card-img-top card_img" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card h-100">
                  <img src="imgs/test_4.jpg" class="card-img-top card_img" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>
