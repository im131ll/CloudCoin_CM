<?php
namespace CloudBankTester
{
	  /*
     example json file: 
   
        {
           "publickey":"preston.CloudCoin.Global",
           "privatekey":"6e2b96d6204a4212ae57ab84260e747f",
           "email":"preston@ccglobal.com"
         }
         */
	
	class BankKeys
	{
		public $publickey {
			        //Fields
        [JsonProperty("publickey")]
        public string $publickey { get; set; }

        [JsonProperty("privatekey")]
        public string $privatekey { get; set; }

        [JsonProperty("email")]
        public string $email { get; set; }
		}
		
		        //Constructors
        public function BankKeys() {

        }//end of constructor
		
		public function BankKeys($publickey, $privatekey, $email)
        {
            $this->publickey = $publickey;
            $this->privatekey = $privatekey;
            $this->email = $email;
        }//end of constructor
			

	}
}




?>