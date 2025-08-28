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
	
	
	//Check if value was passed from plants.php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$locName = $_POST['locName'];

		// Save to db
		$stmt = $db->prepare("INSERT INTO locations (loc_name) VALUES (:locName)");
		$stmt->bindParam(':locName', $locName);
		
		$res = $stmt->execute();
		if(!$res)
		{
			echo $db->lastErrorMsg();
		}
		else
		{
			echo "Location added successfully";
		}
		
		echo "Form submitted successfully! Name: " . $locName;
	}
	$db->close();
?>
