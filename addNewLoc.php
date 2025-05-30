<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $locName = $_POST['locName'];

    // Perform your desired action (e.g., save to database, send email)
    // ...

    // Echo a response to the JavaScript (for display)
    echo "Form submitted successfully! Name: " . $locName;
  }
?>
