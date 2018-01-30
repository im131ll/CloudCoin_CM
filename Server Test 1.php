<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tester</title>
</head>

<body>
<p>The time is now <?php echo date('H:i:s'); ?> </p>
	<?php
		include 'CloudBankUtils.php';
		$keys = new BankKeys("preston@CloudCoin.Global","6e2b96d6204a4212ae57ab84260e747f","Iambadatphp@learning.com");
		
		$coins = new CloudBankUtils($keys);
		echo $coins->showCoins();
		echo '<br>';
		
		$strURL = 'https://bank.cloudcoin.global/service/print_welcome.aspx';
		$strContent = file_get_contents($strURL, "rb");
		echo $strContent;
		
		echo '<br>';
		
		function getCoins()
		{
			//$returnCoins = $coins->showCoins();
			//echo $returnCoins;
		}
	//getCoins();
	?>
	

</body>
</html>