<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tester</title> 
</head>

<body>
<p>The time is now <?php echo date('H:i:s'); ?> </p>
	
	<?php
		//test curl to URL response for code
		$urlTest = 'https://bank.cloudcoin.global/service/print_welcome.aspx';
		$report = curl_init($urlTest);
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

		$response = curl_exec($report);

		$check = curl_getinfo($report, CURLINFO_HTTP_CODE);

		echo $check;

		curl_close($report);

	?>
</body>
</html>