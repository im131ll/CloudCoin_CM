<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tester</title>
</head>

<body>
<p>The time is now <?php echo date('H:i:s'); ?> </p>

	
	<?php
	
		$strURL = 'https://raida0.cloudcoin.global/service/echo';
		$strContent = file_get_contents($strURL, "rb");
		echo $strContent;
	
	?>
	

</body>
</html>