<?php require('includes/header.php'); 
	
	function safeString($var){
		return strip_tags(htmlspecialchars(trim($var)));
	}
	
	$mysqli2 = new mysqli(HOST, INSERT_USER, INSERT_PASSWORD, DATABASE);
	if ($mysqli2->connect_errno) {
		printf("Connect failed: %s\n", $mysqli2->connect_error);
		exit();
	}

	if(isset($_GET['del'])){
		echo '<div class ="box success">The item with url: "<strong>'.safeString($_GET['del']).'</strong>" has been sucesfully deleted</div>';
		$stmt = $mysqli2->prepare("DELETE FROM redirects WHERE url = ?");
		$stmt->bind_param('s', $_GET['del']);
		$stmt->execute(); 
		$stmt->close();
	}
?>

	<div style = "width:100%; margin:20px; margin-top:0px !important;">
		<p>
			On this page you can delete a database entry.
		</p>
	</div>
	<div style = "max-width:100%; padding:20px;overflow:hidden;">

	<table id = "datatable">
		<thead>
		<tr>
			<th>url</th>
			<th>redirecturl</th>
			<th>Delete</th>
		</tr>
		</thead>
		<tbody>
		<?php 
			if ($stmt = $mysqli2->prepare("SELECT url,redirecturl FROM redirects")) {
				/* execute query */
				$stmt->execute();
				/* bind result variables */
				$stmt->bind_result($url,$redirecturl);
				/* fetch value */
				while($stmt->fetch()){
					echo '<tr>';
						echo '<td><a href = "delete.php?del='.safeString($url).'">X</a></td>';
						echo '<td>'.safeString($url).'</td>';
						echo '<td class = "redirecturl"><a href = "'.safeString($redirecturl).'">'.safeString($redirecturl).'</a></td>';
						
					echo '</tr>';
				}
				/* close statement */
				$stmt->close();
			}		
		?>
		</tbody>
	</table>
	</div>
<?php require('includes/footer.php'); ?>
