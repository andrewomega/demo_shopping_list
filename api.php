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

  //Delete entry
  if (isset($_POST['action']) AND $_POST['action'] == "delete") {
    $item = abs($_POST['itemID']);
    
    // Bind parameters
    $stmt = $db->prepare("DELETE FROM items WHERE userid = ? AND id = ?");
    $stmt->bind_param("ii", $userid, $item);
    $stmt->execute();
    
    $returnArray['Status'] = 'Success';
    $returnArray['itemID'] = $item;
  } 

  //Update entry
  if (isset($_POST['action']) AND $_POST['action'] == "update") {
    $item = $_POST['itemID'];
    $text = $_POST['text'];
    
    // Bind parameters
    $stmt = $db->prepare("UPDATE items SET item = ? WHERE userid = ? AND id = ?");
    $stmt->bind_param("sii", $text, $userid, $item);
    $stmt->execute();
    
    $returnArray['Status'] = 'Success';
    $returnArray['itemID'] = $item;
  } 
}
echo json_encode($returnArray);
exit();