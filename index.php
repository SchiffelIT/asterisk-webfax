<!doctype html>
<html lang="de">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width = device-width, initial-scale = 1.0" />  
	<title>Webfax</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="wrapper">
	<div class="container">
	<?PHP
		if($_POST["submit"]) {
			if(!$_FILES["file"]["tmp_name"]) die("Sie haben keine Datei hochgeladen!");
			if(!$_POST["to"]) die("Sie haben keine Ziel-Rufnummer angegeben!");
			
			move_uploaded_file($_FILES["file"]["tmp_name"], "sendfax.pdf");
			file_put_contents("to", $_POST["to"]);
			system("gs -q -dNOPAUSE -dBATCH -sDEVICE=tiffg4 -sPAPERSIZE=letter -sOutputFile=sendfax.tiff sendfax.pdf");
			system("asterisk -rx 'channel originate local/".$_POST['to']."@from-internal extension s@webfax'");
		}
		
		if(!file_exists("sendfax.pdf")) {
	?>
		<h1>Webfax</h1>
		<form action="index.php" method="post" enctype="multipart/form-data">
			<div class="wrapper-input">
				<label>Empfänger</label>
				<input name="to" type="number" value="" placeholder="05711234" required />
			</div>
			
			<div class="wrapper-input">
				<label>Wählen Sie eine *.pdf-Datei von Ihrem PC aus.</label>
				<input name="file" type="file" size="50" accept="application/pdf" required />
			</div>
			
			<div class="wrapper-input">
				<input type="submit" value="… und ab geht die Post!" name="submit">
			</div>
		</form>
	<?PHP
		} else {
	?>
		<h1>Fax Senden...</h1>
		<div class="loader"><div>
		<script>setTimeout(function(){ location.href='./index.php'; }, 3000);</script>
	<?PHP
		}
	?>
	</div>
</div>     

</body>
</html>