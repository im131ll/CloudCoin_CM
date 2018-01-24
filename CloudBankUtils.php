<?php include("ReceiptDetail.php") ?>
<?php include("BankKeys.php") ?>
<?php include("BankTotal.php") ?>
<?php include("Receipt.php") ?>

<?php
//using System.Collections.Generic;
//using System.IO;
//using System;
//using System.Net.Http;
//using System.Threading.Tasks;
//using Newtonsoft.Json;
//using Founders;

//create curl resource
//$ch = curl_init();

$r = new Receipt();

namespace CloudBankTester
{	
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
		public $hundresInBank;
		public $twohundredfiftiesInBank;
		
		
		

        //Constructor
        public function __construct($BankKeys,$startKeys) {
            $keys = $startKeys;
            //cli = new HttpClient();
            $totalCoinsWithdrawn = 0;
            $onesInBank = 0;
            $fivesInBank = 0;
            $twentyFivesInBank = 0;
            $hundresInBank = 0;
            $twohundredfiftiesInBank = 0;
        }//end constructor

        //Methods
        public function showCoins() {
            echo("https://" + $keys.$publickey + "/show_coins.aspx?k=" + $keys.$privatekey);
            $json = "error";
            try {
                $showCoins = file_get_contents("https://" + $keys.$publickey + "/show_coins.aspx?k=" + $keys.$privatekey);
                $json = file_get_contents($showCoins);
            } catch(Exception $ex)
            {
                echo("Exception" + $ex.Message);
            }//end try catch
                        
            if ($json.Contains("error"))
            {
                echo($json);
            }
            else
            {
                $bankTotals = unserialize($json);
                $onesInBank = $bankTotals.$ones;
                $fivesInBank = $bankTotals.$fives;
                $twentyFivesInBank = $bankTotals.$twentyfives;
                $hundresInBank = $bankTotals.$hundreds;
                $twohundredfiftiesInBank = $bankTotals.$twohundredfifties;
                //rawStackFromWithdrawal = GET(cloudBankURL, receiptNumber);
            }

        }//end show coins


        public function loadStackFromFile($filename)
        {
            //rawStackForDeposit = ReadFile( filename);
            $rawStackForDeposit = File.ReadAllText($filename);
        }

        public function sendStackToCloudBank($toPublicURL)
        {
            $CloudBankFeedback = "";
			
            $formContent = new FormUrlEncodedContent(new[] { new $KeyValuePair<string, string>("stack", $rawStackForDeposit) });

            echo("CloudBank request: " + $toPublicURL + "/deposit_one_stack.aspx");
            echo("Stack File: " + $rawStackForDeposit);

            try
            {
                $result_stack = file_get_contents("https://" + toPublicURL + "/deposit_one_stack.aspx", formContent);
                $CloudBankFeedback = file_get_contents($result_stack);
            }
            catch (Exception $ex)
            {
                echo($ex.Message);
            }

            echo("CloudBank Response: " + $CloudBankFeedback);
			
            $cbf = JsonConvert.DeserializeObject<Dictionary<string, string>>($CloudBankFeedback);
			
            //rawReceipt = cbf["receipt"];
            //receiptNumber = cbf["rn"];
            $receiptNumber = $cbf["receipt"];
            //Console.Out.WriteLine("Raw Receipt: " + rawReceipt);
        }//End send stack




        public function getReceipt(string $toPublicURL)
        {
            echo("Geting Receipt: " + "https://" + $toPublicURL + "/" + $keys.$privatekey + "/Receipts/" + $receiptNumber + ".json");
            $result_receipt = file_get_contents("https://" + $toPublicURL + "/" + $keys.$privatekey + "/Receipts/" + $receiptNumber + ".json");
           
            $rawReceipt = file_get_contents($result_receipt);
            echo("Raw Receipt: " + $rawReceipt);
        }//End get Receipt

        public function getStackFromCloudBank(int $amountToWithdraw)
        {
            $totalCoinsWithdrawn = $amountToWithdraw;
            $result_stack = file_get_contents("https://" + $keys.$publickey + "/withdraw_account.aspx?amount=" + $amountToWithdraw + "&k=" + $keys.$privatekey);
            $rawStackFromWithdrawal = file_get_contents($result_stack);
            //rawStack = GET(cloudBankURL, receiptNumber);
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

        public function getReceiptFromCloudBank(string $toPublicURL)
        {
            $result_receipt = file_get_contents("https://" + $keys.$publickey + "/get_receipt.aspx?rn=" + $receiptNumber + "&k=" + $keys.$privatekey);
            $rawReceipt = file_get_contents($result_receipt);
            if (strpos($rawReceipt,'Error') !== false)
            {
                echo($rawReceipt);
            }
            else
            {
                $deserialReceipt = unserialize($r, $rawReceipt);
				
                for ($i = 0; $i < $deserialReceipt.rd.Length; $i++)
                    if ($deserialReceipt.rd[i].status == "authentic")
                        $totalCoinsWithdrawn += getDenomination(deserialReceipt.rd[i].sn);
                $result_stack = file_get_contents($keys.$publickey + "/withdraw_one_stack.aspx?amount=" + $totalCoinsWithdrawn + "&k=" + $keys.$privatekey);
                $rawStackFromWithdrawal = file_get_contents($result_stack);
                //rawStackFromWithdrawal = GET(cloudBankURL, receiptNumber);
            }
        }

        public function interpretReceipt()
        {
            $interpretation = "";
            if ($rawReceipt.Contains("Error"))
            {
                //parse out message
                $interpretation = $rawReceipt;
            }
            else
            {
                //tell the client how many coins were uploaded how many counterfeit, etc.
                $deserialReceipt = unserialize($r,$rawReceipt);
                $totalNotes = $deserialReceipt.$total_authentic + $deserialReceipt.$total_fracked;
                $totalCoins = 0;
				
                for (int i = 0; i < deserialReceipt.rd.Length; i++)
                    if (deserialReceipt.rd[i].status == "authentic")
                        $totalCoins += getDenomination($deserialReceipt.rd[i].sn);
                $interpretation = "receipt number: " + $deserialReceipt.receipt_id + " total authentic notes: " + $totalNotes + " total authentic coins: " + $totalCoins;


            }//end if error
            return $interpretation;
        }

        public function saveStackToFile(string $path)
        {
            echo ($path . $getStackName . $rawStackFromWithdrawal);
            //WriteFile(path + stackName, rawStackFromWithdrawal);
        }

        public function getStackName()
        {
            return $totalCoinsWithdrawn + ".CloudCoin." + $receiptNumber + ".stack";
        }

        public function transferCloudCoins( string $toPublicKey, int $coinsToSend) {
            //Download amount
            $getStackFromCloudBank($coinsToSend);
            $rawStackForDeposit = $rawStackFromWithdrawal;//Make it so it will send the stack it recieved
            $sendStackToCloudBank($toPublicKey);
            //Upload amount
        }//end transfer


    }//end class
}//end namespace

?>