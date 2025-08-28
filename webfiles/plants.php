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

	function showNewPlantPage() {
		
	?>
	<h1 class="text-center mt-3 mb-3">Create New Plant</h1>
	<div class="mb-3">
	<label for="formPlantName" class="form-label">Plant Name:</label>
	<input type="email" class="form-control" id="formPlantName" placeholder="Spinach">
	</div>
	<div class="mb-3">
	<label for="formPlantDescription" class="form-label">Plant Description:</label>
	<textarea class="form-control" placeholder="Our spinach is planted in the middle of our raised bed. It is a hybrid and requires watering twice a week." id="formPlantDescription" rows="3"></textarea>
	</div>
	<div class="mb-3">
	<label for="formPlantImg" class="form-label">Plant Image:</label>
	<input class="form-control" type="file" id="formPlantImg">
	</div>
	<div class=mb-3>
	<label for="formPlantColor" class="form-label">Choose ID Color</label>
	<input type="color" class="form-control form-control-color" id="formPlantColor" value="#563d7c" title="Choose your color">
	</div>
	<div>
		<div class="row">
		  <label for="plantLocDatalist" class="form-label">Locations (click box and select from list or add with plus button)</label>
		</div>
		<div class="row">
		  <div class="col">
			<input class="form-control" list="locDatalistOptions" id="plantLocDatalist" placeholder="Type to search...">
			<datalist id="locDatalistOptions">
				<?php
				$dbFile = '../data/whats-growing-on.db';
				$con = "sqlite:$dbFile";
				
				try {
					$pdo = new PDO($con);
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					echo "Database file opened successfully!";
				} catch (PDOException $e)
				{
					echo "Error opening database: " . $e->getMessage();
				}
				
				$results = $pdo->query("SELECT * FROM locations ORDER BY loc_name ASC");
				
				while($row = $results->fetch(PDO::FETCH_ASSOC))
				{
					$item = htmlspecialchars($row['loc_name']);
					echo "<option value='{$item}'>";
				}
				?>
			  <option value="Raised Bed #1">
			  <option value="Raised Bed #2">
			  <option value="Indoor Planter">
			  <option value="Front Yard">
			  <option value="West Yard">
			</datalist>
		  </div>
		  <div class="col-2">
			<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newLocModal">
			  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
				<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
			  </svg>
			</button>
		  </div>
		</div>
		<div class="modal fade" id="newLocModal" tabindex="-1" role="dialog" aria-labelledby="newLocModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="newLocModalLabel">Add New Location</h5>
			  </div>
			  <div class="modal-body">
				<form method="post" id="newLocForm">
				  <div class="form-group">
					<label for="formLocName">Location Name</label>
					<input type="text" class="form-control" id="formLocName" placeholder="i.e. Backyard, Raised Bed, Indoor Planter">
				  </div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="submit" id="newLocSubmit" class="btn btn-success">Add</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>
	</div>
	<?php
	}
	
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap-overrides.css" />
    <link rel="stylesheet" href="css/plants.css" />
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
              <a class="nav-link" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="todo.html">To-Do</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="weather.html">Weather</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="calendar.html">Calendar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="">Plants</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="locations.html">Locations</a>
            </li>
          </ul>
          <ul class="navbar-nav mr-0 mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="settings.html">Settings</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div "container-fluid">
      <div class="row gx-0">
        <div class="col-2 mx-w-100">
          <div class="d-flex flex-column align-items-center text-center border-bottom">
            <h3 class="d-flex align-items-center flex-shrink-0 mb-0 p-2 link-dark text-decoration-none">Plants</h3>
            <button type="button" onclick="location.href='plants.php?plantId=new';" class="btn btn-success mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"></path>
              </svg>
            </button>
          </div>
          <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white mx-w-100" style="width: 100%;">
            <div class="list-group list-group-flush border-bottom scrollarea" style="height: 86vh; overflow-y: scroll;">
              <a href="" style="border-left-color:#AA00AA;"class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Plant Name</strong>
                  <small>Location</small>
                </div>
                <div class="col-10 mb-1 small">Last Task</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Spinach</strong>
                  <small>Raised Bed</small>
                </div>
                <div class="col-10 mb-1 small">Last Task:<br/>Watered May 2, 2025 2:15pm</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Onions</strong>
                  <small>Raised Bed</small>
                </div>
                <div class="col-10 mb-1 small">Last Task:<br/>Fertilized May 10, 2025 5:45pm</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Plant Name</strong>
                  <small>Location</small>
                </div>
                <div class="col-10 mb-1 small">Last Task</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Plant Name</strong>
                  <small>Location</small>
                </div>
                <div class="col-10 mb-1 small">Last Task</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Plant Name</strong>
                  <small>Location</small>
                </div>
                <div class="col-10 mb-1 small">Last Task</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Plant Name</strong>
                  <small>Location</small>
                </div>
                <div class="col-10 mb-1 small">Last Task</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Plant Name</strong>
                  <small>Location</small>
                </div>
                <div class="col-10 mb-1 small">Last Task</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Plant Name</strong>
                  <small>Location</small>
                </div>
                <div class="col-10 mb-1 small">Last Task</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Plant Name</strong>
                  <small>Location</small>
                </div>
                <div class="col-10 mb-1 small">Last Task</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Plant Name</strong>
                  <small>Location</small>
                </div>
                <div class="col-10 mb-1 small">Last Task</div>
              </a>
              <a href="" class="list-group-item list-group-item-action py-3 lh-tight">
                <div class="d-flex w-100 align-items-center justify-content-between">
                  <strong class="mb-1">Plant Name</strong>
                  <small>Location</small>
                </div>
                <div class="col-10 mb-1 small">Last Task</div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-auto d-flex" style="height: 94vh">
          <div class="vr" style="height: 100%;"></div>
        </div>
        <div class="col justify-content-center p-5" id="content-col" style="border-color: #00AA00; border-right-style: solid; border-left-style: solid; margin-left: 400px; margin-right: 400px;">
          <?php
            if(isset($_GET['plantId']) && $_GET['plantId'] == 'new')
            {
				showNewPlantPage();
            }
           ?>	
		   
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $('#newLocSubmit').click(function() {
          // Prevent default form submission (if it's still a regular submit button)
          event.preventDefault();

          // Collect form data
          var formData = {
            'locName': $('#formLocName').val()
          };

          // Send data using AJAX
          $.ajax({
            type: 'POST',
            url: 'addNewLoc.php', // PHP file to handle the data
            data: formData,
            success: function(response) {
              // Handle the server's response (e.g., display a message)
              $('#message').html(response);
              alert(response);
			  // Reload the page after user closes alert box to reload results in location search box
			  location.reload();
            },
            error: function(error) {
              // Handle errors
              console.log(error);
            }
          });
        });
      });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>
