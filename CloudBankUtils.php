<?php
	include("BankTotal.php");
	include("BankKeys.php");
	include("Receipt.php");
	
    class CloudBankUtils
    {
        //Fields
		private $BankKeys;
        private $keys;
        private $rawStackForDeposit;
        private $rawStackFromWithdrawal;
        private $rawReceipt;
        private $receiptNumber;
		public $totalCoinsWithdrawn;
		public $onesInBank;
		public $fivesInBank;
		public $twentyFivesInBank;
		public $hundredsInBank;
		public $twohundredfiftiesInBank;
		public $startKeys;
		public $publickey;
		public $privateKey;
		public $ones;
		public $fives;
		public $twentyfives;
		public $hundreds;
		public $twohundredfifties;
		
        //Constructor
        public function __construct(BankKeys $BankKeys) {
			$publickey = $BankKeys->get_publickey();
			$privatekey = $BankKeys->get_privatekey();
			$this->BankKeys = $BankKeys;
			$startKeys = null;
            $keys = $startKeys;
            $totalCoinsWithdrawn = 0;
            $onesInBank = 0;
            $fivesInBank = 0;
            $twentyFivesInBank = 0;
            $hundredsInBank = 0;
            $twohundredfiftiesInBank = 0;
			}//end constructor
			
        //Methods
        function showCoins() {
			global $publickey;
			global $privatekey;
			global $ones;
			global $fives;
			global $twentyfives;
			global $hundreds;
			global $twohundredfifties;
			global $bankTotals;
			global $onesInBank;
			global $fivesInBank;
			global $twentyFivesInBank;
			global $hundredsInBank;
			global $twohundredfiftiesInBank;

            echo("https://" . $publickey . "/show_coins.aspx?k=" . $privatekey);
            $json = "error";
            try {
                $showCoins = curl_init();
				curl_setopt($showCoins, CURLOPT_URL, "https://" . $publickey . "/show_coins.aspx?k=" . $privatekey);
                $json = curl_setopt($showCoins, CURLOPT_POST, 1);
				$showCoinsOut = curl_exec($showCoins);
				curl_close($showCoins);
            } catch(Exception $ex)
            {
                echo('Exception' + $ex->getMessage());
            }//end try catch
			
            if (strpos($json,"error")!== false)
            {
                echo($json);
            }
            else
            {
                $bankTotals = json_decode($json);
                $onesInBank = $bankTotals.$ones;
                $fivesInBank = $bankTotals.$fives;
                $twentyFivesInBank = $bankTotals.$twentyfives;
                $hundredsInBank = $bankTotals.$hundreds;
                $twohundredfiftiesInBank = $bankTotals.$twohundredfifties;
            }
			
        }//end show coins
		
        function loadStackFromFile($filename)
        {
            $rawStackForDeposit = file_get_contents($filename);
        }
		
        function sendStackToCloudBank($toPublicURL)
        {
            $CloudBankFeedback = "";
            $datatopost = array("stack" => $rawStackForDeposit);
            echo("CloudBank request: " . $toPublicURL ."/deposit_one_stack.aspx");
            echo("Stack File: " . $rawStackForDeposit);
            try
            {
                $result_stack = curl_init(CURLOPT_URL, "https://" . $toPublicURL . "/deposit_one_stack.aspx", $formContent);
                $CloudBankFeedback = curl_setopt($result_stack, CURLOPT_POST, 1); //curl function returning error
				$resultStackOut = curl_exec($result_stack);
				curl_close($result_stack);
            }
            catch (Exception $ex)
            {
                echo('Exception' . $ex->getMessage());
            }
            echo("CloudBank Response: " . $CloudBankFeedback);
            $cbf = json_decode($CloudBankFeedback);
            $receiptNumber = $cbf["receipt"];
			
        }//End send stack
		
        function getReceipt(string $toPublicURL)
        {
            echo("Geting Receipt: " . "https://" . $toPublicURL . "/" . $privatekey . "/Receipts/" . $receiptNumber . ".json");
            $result_receipt = curl_init(CURLOPT_URL, "https://" . $toPublicURL . "/" . $privatekey . "/Receipts/" . $receiptNumber . ".json");
            $rawReceipt = curl_setopt($result_receipt, CURLOPT_POST, 1); //curl function returning error
			$resultReceiptOut = curl_exec($result_receipt);
			curl_close($result_receipt);
            echo("Raw Receipt: " . $rawReceipt);
        }//End get Receipt
		
        function getStackFromCloudBank(int $amountToWithdraw)
        {
            $totalCoinsWithdrawn = $amountToWithdraw;
            $result_stack = curl_init(CURLOPT_URL, "https://" . $publickey . "/withdraw_account.aspx?amount=" . $amountToWithdraw . "&k=" . $privatekey);
            $rawStackFromWithdrawal = curl_setopt($result_stack, CURLOPT_POST, 1); //curl function returning error
			$resultStackOut = curl_exec($result_stack);
			curl_close($result_stack);
        }//End get stack from cloudbank
		
        function getDenomination($sn)
        {
            $nom = 0;
            if (($sn < 1))
            {
                $nom = 0;
            }
            else if (($sn < 2097153))
            {
                $nom = 1;
            }
            else if (($sn < 4194305))
            {
                $nom = 5;
            }
            else if (($sn < 6291457))
            {
                $nom = 25;
            }
            else if (($sn < 14680065))
            {
                $nom = 100;
            }
            else if (($sn < 16777217))
            {
                $nom = 250;
            }
            else
            {
                $nom = '0';
            }

            return $nom;
        }//end get denomination
		
        function getReceiptFromCloudBank(string $toPublicURL)
        {
            $result_receipt = curl_init(CURLOPT_URL, "https://" . $publickey . "/get_receipt.aspx?rn=" . $receiptNumber . "&k=" . $privatekey);
            $rawReceipt = curl_setopt($result_receipt, CURLOPT_POST, 1);
			$resultReceiptOut = curl_exec($result_receipt);
			curl_close($result_receipt);
            if (strpos($rawReceipt,'Error') !== false)
            {
                echo($rawReceipt);
            }
            else
            {
                $deserialReceipt = json_decode($r, $rawReceipt);
                for ($i = 0; $i < $deserialReceipt.rd.Length; $i++)
                    if ($deserialReceipt.rd[$i].status == "authentic")
                        $totalCoinsWithdrawn += getDenomination($deserialReceipt.rd[$i].sn);
                $result_stack = curl_init(CURLOPT_URL, $publickey . "/withdraw_one_stack.aspx?amount=" . $totalCoinsWithdrawn . "&k=" . $privatekey);
                $rawStackFromWithdrawal = curl_setopt($result_stack, CURLOPT_POST, 1);
				$resultStackOut = curl_exec($result_stack);
				curl_close($result_stack);
            }
        }
		
        function interpretReceipt()
        {
            $interpretation = "";
            if (strpos($rawReceipt,"Error")!== false)
            {
                //parse out message
                $interpretation = $rawReceipt;
            }
            else
            {
                //tell the client how many coins were uploaded how many counterfeit, etc.
                $deserialReceipt = json_decode($r,$rawReceipt);
                $totalNotes = $deserialReceipt.$total_authentic + $deserialReceipt.$total_fracked;
                $totalCoins = 0;
				
                for ($i = 0; $i <= $deserialReceipt.rd.Length; $i++)
                    if ($deserialReceipt.rd[$i].status == "authentic")
                        $totalCoins += getDenomination($deserialReceipt.rd[$i].sn);
                $interpretation = "receipt number: " . $deserialReceipt . " total authentic notes: " . $totalNotes . " total authentic coins: " . $totalCoins;
            }//end if error
            return $interpretation;
        }
		
        function saveStackToFile(string $path)
        {
            echo ($path . $getStackName . $rawStackFromWithdrawal);
        }
		
        function getStackName()
        {
            return $totalCoinsWithdrawn . ".CloudCoin." . $receiptNumber . ".stack";
        }
		
        function transferCloudCoins(string $toPublicKey, int $coinsToSend) {
            //Download amount
            getStackFromCloudBank($coinsToSend); //needs to be cURL
            $rawStackForDeposit .= $rawStackFromWithdrawal;//Make it so it will send the stack it recieved
            sendStackToCloudBank($toPublicKey); //needs to be cURL
            //Upload amount
        }//end transfer

    }//end class

?>