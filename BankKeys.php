<?php
namespace CloudBankTester
{
	$publickey;
	$privatekey;
	$email;
	
    /*
     example return file:
        {
           "publickey":"preston.CloudCoin.Global",
           "privatekey":"6e2b96d6204a4212ae57ab84260e747f",
           "email":""
         }
         */
 	class BankKeys implements JsonSerializable
    {
		

        //Fields
		function get_publickey()
		{
			return $this->publickey; 
		}
		function set_publickey($new_publickey)
		{
			$this->publickey = $new_publickey;
		}
		function get_privatekey()
		{
			return $this->privatekey;
		}
		
		function set_privatekey($new_privatekey)
		{
			$this->privatekey = $new_privatekey;
		}
		function get_email()
		{
			return $this->email;
		}
		function set_email($new_email)
		{
			$this->email = $new_email;
		}
        public function BankKeys($publickey, $privatekey, $email)
        {
            $this->publickey = $publickey;
            $this->privatekey = $privatekey;
            $this->email = $email;
        }//end of constructor


    }
}
?>