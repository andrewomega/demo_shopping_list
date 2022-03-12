<?php
  //Database include
  include 'db_connect.php';

  //Session start
  session_start();
  //Sets return value array for JSON
  $returnArray['Status'] = 'Failed';

  //Only work with validated and logged in users
  if (isset($_SESSION['loggedIn'])) {
    $userid = $_SESSION['userid'];

  //Parse JSON data
  if(empty($_POST) ){ $_POST = json_decode(file_get_contents('php://input', true), true); }

  //Add new entry
  if (isset($_POST['action']) AND $_POST['action'] == "add") {
    $item = $_POST['newItem'];
    
    // Bind parameters
    $stmt = $db->prepare("INSERT INTO items (userid, item) VALUE (?,?)");
    $stmt->bind_param("is", $userid, $item);
    $stmt->execute();
    
    $returnArray['Status'] = 'Success';
    $returnArray['itemID'] = $stmt->insert_id;
  } 
}
echo json_encode($returnArray);
exit();