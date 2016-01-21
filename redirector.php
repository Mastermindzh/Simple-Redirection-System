<?php
  require_once(getcwd().'/new/settings.php');
  $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
  if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }
  //if i is set, redirect
  if (isset($_GET['i'])) {
    $query = $_GET['i'];
    /* create a prepared statement */
    if ($stmt = $mysqli->prepare("SELECT redirecturl FROM redirects WHERE url=?")) {
      /* bind parameters for markers */
      $stmt->bind_param("s", $query);
      /* execute query */
      $stmt->execute();
      /* bind result variables */
      $stmt->bind_result($redirect);
      /* fetch value */
      $stmt->fetch();
      /* close statement */
      $stmt->close();
    }
    /* close connection */
    $mysqli->close();
    header('Location: '.$redirect);
  }
?>
