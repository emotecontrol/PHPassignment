<?php
//create_contact.php
session_start();
include "functions.php";
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true)
{
  header("Location: login.php");
  exit();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Create Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class='row'>
      <div class = "span10 offset1">
        <h1>Contact Created Successfully</h1>
      </div>
    </div>
    <?php
    foreach ($_SESSION as $key => $value) {
      if ($key != "logged_in" && $key != "user_n")
      {
        $newcontact[$key] = $value;
      }
    }
    echo "<br>";
    
    if (!empty($newcontact["firstName"]))
    { 
      $id = getID();
      $newcontact["id"] = $id;
      if (file_exists("contactlist.txt"))
        {
          $contact_list = loadJson("contactlist.txt");
        }
      $contact_list[$id] = $newcontact;
      saveJson("contactlist.txt", $contact_list);
    displayContact($id);
    clearContact();
    }

    ?>
    <div class = 'row'>
      <div class = 'offset1'>
        <br />
        <a href="main_menu.php" class="btn btn-primary">Return to menu</a>
      </div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
