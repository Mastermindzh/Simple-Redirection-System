<?php require_once('settings.php');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>New url</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link href="style.css" rel="stylesheet" type="text/css">
		<script src="validate.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script>
		$(document).ready(function() {
			$("input[name$='radio']").click(function() {
				var test = $(this).val();
				$("div.desc").hide();
				$("#radio" + test).show();
			});
		});
		$(document).ready(function() {
        $('#toggle').click(function() {
                $('#usage').slideToggle("fast");
        });
    });
		</script>
	</head>
	<body>
		<div id="mainForm">
			<div id="formHeader">
					<h2 class="formInfo"><?php echo HEADER;?></h2>
					<p class="formInfo"><?php echo SUB_HEADER;?></p>
			</div>
			<br />
			<?php
				if (isset($_GET['e'])) {
					$divtext="Error";
					$divclass="box";
					$query = $_GET['e'];
					switch ($query) {
    				case "successful":
							$divclass = $divclass.' success';
        			$divtext = SUCCESS;
        			break;
						case "exists":
							$divtext = EXISTS;
							$divclass = $divclass.' error';
							break;
						case "file-exists":
							$divtext = FILE-EXISTS;
							$divclass = $divclass.' warning';
							break;
						case "large":
							$divtext = LARGE;
							$divclass = $divclass.' warning';
							break;
						case "upload":
							$divtext = UPLOAD;
							$divclass = $divclass.' error';
							break;
					}
					echo '<div class ="'.$divclass.'">'.$divtext.'</div>';
				}
			?>

			<form method=post enctype=multipart/form-data action=processor.php onSubmit="return validatePage();"><ul class=mainForm id="mainForm_1">
					<li class="mainForm">
						<div id="myRadioGroup">
							url <input type="radio" name="radio" id="urlcheck" checked="checked" value="2"  />
							File <input type="radio" name="radio" id="image" value="3" />
						</div>
					</li>
					<li class="mainForm">
						<label class="formFieldQuestion">Desired url</label><input class=mainForm type=text name=url id=url size='40' value=''>
					</li>
					<div id="radio2" class="desc">
						<li class="mainForm">
							<label class="formFieldQuestion">Redirect URL</label><input class=mainForm type=text name=redirecturl id=redirecturl size='40' value=''>
						</li>
					</div>
					<div id="radio3" class="desc" style="display: none;">
						<li class="mainForm">
							<label class="formFieldQuestion">Preffered path:</label><input class=mainForm type=text name=pref id=pref size='40' value="" placeholder="cars/yelow/"><br /><br />
							<label class="formFieldQuestion">Select a file:</label><input class=mainForm type=file name=image id=image value="">
						</li>
					</div>
					<script type=text/javascript>
						function validatePage(){
							retVal = true;
							if(document.getElementById('urlcheck').checked) {// if url checked
								if (validateField('url','text',1) == false)
									retVal=false;
								if (validateField('redirecturl','text',1) == false)
									retVal=false;
							}else if(document.getElementById('image').checked){//else
							  if (validateField('url','text',1) == false)
										retVal=false;
								if (validateField('pref','text',0) == false)
										retVal=false;
							}
							if(retVal == false){
								alert('Please correct the errors shown in red.');
							}
							return retVal;
						}
					</script>
					<li class="mainForm">
						<br />
						<input id="saveForm" class="mainForm" type="submit" value="Submit" />
					</li>
			</form>
		</ul>

		<span style = "margin-left:20px;"><a href="#" id="toggle">Show/hide Guidelines</a></span>

		<div id="usage" style = "display:none;">
			<h2>Usage guidelines</h2>
			<ul class = "guide">
				<li>The Desired url is the url you want to have. If you enter "test" you will get: http://domain.com/test as your url.</li>
				<li>The redirecturl is the url you want to point to, in our test this could be: http://test.com. http://domain.com/test would then redirect to http://test.com</li>
				<li>The "preffered path" is an optional field, if you want to upload an image to a subdirectory you can enter the directory in here.</li>
				<li>The desired url can't have a / in it. (this would defeat the purpose anyways)</li>
				<li>If you select a preffered path make sure to exlude a leading slash and add a trailing slash. (cars/red/)</li>
			</ul>
		</div>
		<div class = "footer">
			<p>
				Created by<a href = "http://mi-soft.nl/about.php"> Rick van Lieshout</a> from <a href = "http://mi-soft.nl">mi-soft.nl</a>
			</p>
		</div>
		</div>
	</body>
</html>
