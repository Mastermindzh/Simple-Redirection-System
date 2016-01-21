<?php
	require_once('settings.php');

	$mysqli2 = new mysqli(HOST, INSERT_USER, INSERT_PASSWORD, DATABASE);
	if ($mysqli2->connect_errno) {
		printf("Connect failed: %s\n", $mysqli2->connect_error);
		exit();
	}
	$error = "";

	//validate wether the value isn't used yet.
	$url=$_POST['url'];

	$redirect = 0;
		/* create a prepared statement */
		if ($stmt = $mysqli2->prepare("SELECT count(*) FROM redirects WHERE url=?")) {
			/* bind parameters for markers */
			$stmt->bind_param("s", $url);
			/* execute query */
			$stmt->execute();
			/* bind result variables */
			$stmt->bind_result($redirect);
			/* fetch value */
			$stmt->fetch();
			/* close statement */
			$stmt->close();
		}

		if($redirect >= 1){
			$mysqli2->close();
			$error = "exists";
		}else{
			//url doesn't exist yet so we can continue
			if($_POST['radio'] == 2){//if url is selected
				$redirecturl=$_POST['redirecturl'];
					$stmt = $mysqli2->prepare("INSERT INTO redirects (url, redirecturl) VALUES (?,?)");
					$stmt->bind_param('ss',$url,$redirecturl);

					// *now* we can execute
					$stmt->execute();
					$stmt->close();
					$error = "succesful";
			}else{
					$custom_path = $_POST['pref'];
					$target_dir = FILEPATH.$custom_path;
					if (!file_exists($target_dir)) {// check wether directory exists, else create it.
							mkdir($target_dir, 0777, true);
					}
					$target_dir = $target_dir . basename( $_FILES["image"]["name"]);

					$uploadOk=1;

					// Check if file already exists
					if (file_exists($target_dir . $_FILES["image"]["name"])) {
							$error = "file-exists";
							$uploadOk = 0;
					}
					// Check file size
					if ($uploadFile_size > MAX_SIZE) {
							$error = "large";
							$uploadOk = 0;
					}

					// Check if $uploadOk is set to 0 by an error
					if (!($uploadOk == 0)) {
						if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir)) {
								$error = "succesful";
						} else {
								$error = "upload";
						}
					}
					//file is uploaded, put path in database
					$redirecturl = REDIRECTPATH.$custom_path.$_FILES["image"]["name"];
					$stmt = $mysqli2->prepare("INSERT INTO redirects (url, redirecturl) VALUES (?,?)");
					$stmt->bind_param('ss',$url,$redirecturl);
					$stmt->execute();
					$stmt->close();
					$error = "succesful";
			}
		}
$mysqli2->close();
//redirects
switch($error){
	case "exists":
		header('Location: index.php?e=exists');
		break;
	case "file-exists":
		header('Location: index.php?e=file-exists');
		break;
	case "large":
		header('Location: index.php?e=large');
		break;
	case "upload":
		header('Location: index.php?e=upload');
		break;
		case "no-image":
			header('Location: index.php?e=no-image');
			break;
	default:
	header('Location: index.php?e=successful');
}
?>
