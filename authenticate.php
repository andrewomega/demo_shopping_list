<?php
  //Database include
  include 'db_connect.php';

  //Session start
  session_start();

  $username = stripslashes($_POST['username']);
  $password = stripslashes($_POST['password']);

  //User is already logged in, nothing to do here
if (!isset($_SESSION['loggedIn'])) {
    // Bind parameters
    $stmt = $db->prepare("SELECT userid FROM users WHERE username = ? AND password = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    // Fetch the value for userid
    $stmt->bind_result($db_userid);

    if ($stmt->fetch() == true) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['userid'] = $db_userid;

        //Clean up any old error messages
        if (isset($_SESSION['loginError'])) { unset($_SESSION['loginError']); }

        //Redirect to main page
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['loginError'] = 'Invalid Login Attempt.';
        //Redirect to main page
        header('Location: index.php');
        exit();
    }
}
