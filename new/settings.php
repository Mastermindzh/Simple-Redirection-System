<?php
  #site headers
  define("HEADER", "TITLE");                                             // Add new redirect page header
  define("SUB_HEADER", "Create a new redirecturl");                              // Add new redirect page sub header

  #global settings
  #only change "images", keep the uploads dir
  $desired_path = "files/";
  
  define("MAX_SIZE", 500000);                                                    // Max filesize
  #error messages
  define("SUCCESS","Redirect created succesfully");                              // This message will be shown when upload is successful
  define("EXISTS","The requested url already exists");                           // This message will be shown when the requested url already exists
  define("FILE-EXISTS","A file with the same name already exists");              // This message will be shown when a file exists with the same name
  define("LARGE","The file is too large");                                       // This message will be shown when the file upload is too big
  define("UPLOAD","Something went wrong with the upload");                       // This message will be shown when the upload has gone wrong

  #database settings
  define("HOST", "localhost");                                                   // The host you want to connect to.
  define("DATABASE", "Redirects");                                               // The database name.

  #users
  define("INSERT_USER", "");                                               // The username of the user with insert privileges
  define("INSERT_PASSWORD", "");                                 // The password of the user with insert privileges
  define("USER", "");                                                   // The username of the user with select privileges.
  define("PASSWORD", "");                                        // The password of the user with select privileges.
  
  
  //DON'T EDIT THESE
  define("FILEPATH", "../uploads/".$desired_path);                                    // The location were we will save the files
  define("REDIRECTPATH", 'http://'.$_SERVER['SERVER_NAME'].'/uploads/'.$desired_path);          // The location were we will redirect too. (should point to domain/filepath)
?>
