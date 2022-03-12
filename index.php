<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  //Database include
  include 'db_connect.php';

  //Session start
  session_start();

  if (isset($_SESSION['loggedIn'])) {
    $userid = $_SESSION['userid'];
    $items = array();

    //Gather list items and pass to view.
    $stmt = $db->query("SELECT * FROM `items` WHERE `userid` = $userid");
    while(($row = $stmt->fetch_assoc()) !== null) {
      array_push($items,$row); 
    }
    include 'views/shoppingList.inc.php';
    
  } else {
    if (isset($_SESSION['loginError'])) { $loginError = $_SESSION['loginError']; }

    include 'views/login.inc.php';
  }
  ?>

