<?PHP
	$to = 'kunde@kundedomain.com';
	$subject = 'Fax-Sendebericht';
	$header = 'From: service@s-it.io' . "\r\n" .
		'Reply-To: support@schiffel.it' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	
	if($argv[1] == "SUCCESS") {
		$msg = "Ihr Fax wurde erfolgreich verschickt.

Ziel-Rufnummer: ".file_get_contents("/var/www/html/webfax/to")."
Seiten: ".$argv[4]."
Uebertragungsrate: ".$argv[5]."
Aufloesung: ".$argv[6]."
Remote-Station-ID: ".$argv[7]."
";
	} else {
		$msg = "Ihr Fax konnte nicht versendet werden.

Ziel-Rufnummer: ".file_get_contents("/var/www/html/webfax/to")."
Fehlermeldung: ".$argv[3]."
Remote-Station-ID: ".$argv[7]."
";
	}

	mail($to, $subject, $msg, $header);
	
	unlink("/var/www/html/webfax/sendfax.pdf");
	unlink("/var/www/html/webfax/sendfax.tiff");
	unlink("/var/www/html/webfax/to");
?>