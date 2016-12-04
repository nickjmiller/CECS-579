<?php
include_once 'db_connect.php';
include_once 'functions.php';
sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['pres'], $_POST['prop'])) {
    $voterID = $_SESSION['voterID'];
    $pres = $_POST['pres']; 
    $prop = $_POST['prop'];

    //get admin id
      if ($stmt = $mysqli->prepare("SELECT adminID
                                FROM voters
                                WHERE voterID = ? LIMIT 1")) {
      $stmt->bind_param('i', $voterID);
      $stmt->execute();   // Execute the prepared query.
      $stmt->store_result();
      if ($stmt->num_rows == 1) {
        // If the user exists get variables from result.
        $stmt->bind_result($adminID);
        $stmt->fetch();
      }
      
      //process vote
      if ($insert_stmt = $mysqli->prepare("INSERT INTO votes1 (adminID, pres, prop) VALUES (?, ?, ?)")) {
            $insert_stmt->bind_param('sss', $adminID, $pres, $prop);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=vote failure: INSERT');
            }
      }
      if ($insert_stmt = $mysqli->prepare("INSERT INTO votes2 (adminID, pres, prop) VALUES (?, ?, ?)")) {
            $insert_stmt->bind_param('sss', $adminID, $pres, $prop);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=vote failure: INSERT');
            }
      }
      if ($insert_stmt = $mysqli->prepare("INSERT INTO votes3 (adminID, pres, prop) VALUES (?, ?, ?)")) {
            $insert_stmt->bind_param('sss', $adminID, $pres, $prop);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=vote failure: INSERT');
            }
      }
      $query = mysql_query("UPDATE voterInfo set hasVoted = 1 WHERE voterID = " . $voterID);
      
    header('Location: ../protected_page.php');

} else {
    // The correct POST variables were not sent to this page.
    echo 'Invalid Request';
}
?>
