<?php
//search.php
session_start();
include "functions.php";
include "regex_validate.php";
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true)
{
  header("Location: login.php");
  exit();
}

if (isset($_GET['search']) && !empty($_GET['search']))
{
  $searchstring = "{$_GET['search']}";
  $searchstring = explode(" ", $searchstring);
  foreach ($searchstring as $searchfragment) 
  {
    $search[] = "/$searchfragment/i";
  }

  $contacts = loadJson("contactlist.txt");
  foreach ($contacts as $contact => $fields) 
  {
    
    $exit = false;
    foreach ($fields as $fieldvalue)
    {
      if ($exit)
        break;

      foreach ($search as $searchvalue)
      {
        if ($exit)
          break;

        if (preg_match($searchvalue, $fieldvalue))
        {
          $search_list[] = $contacts[$contact];
          $exit = true; 
          break;
        }
      }
    }
  }
}
else
{
  // display "no contacts found" error below, by default because $search_list isn't set
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <?php
    if (isset($search_list))
    {
      echo "<div class = 'row'>
              <div class = 'offset1'>
                <h3>Searching for \"{$_GET['search']}\"</h3>
              </div>
            </div>";
      foreach ($search_list as $contact) 
      {
        displayContact($contact['id']);
        echo "<br>";
      }
    }
    else
    {
      echo "<div class = 'row'>
              <div class = 'offset1'>
                <h3>No contacts found that match the search term</h3>
              </div>
            </div>";
    }
    ?>
    <div class = 'row'>
      <div class = 'offset1'>
        <a href = 'main_menu.php' class = 'btn btn-primary'>Return to Menu</a>
      </div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
