<?php include("ReceiptDetail.php") ?>
<?php
date_default_timezone_set("UTC");
namespace Founders
{
	class Receipt implements JsonSerializable
    {
		var $receipt_id;
		var $time;
		var $timezone;
		var $bank_server;
		var $total_authentic;
		var $total_fracked;
		var $total_counterfeit;
		var $total_lost;
		

        //[JsonProperty("receipt_id")]
		function get_receipt_id()
		{
			return $this->receipt_id;
		}
		function set_receipt_id($new_receipt_id)
		{
			$this->receipt_id = $new_receipt_id;
		}
        //[JsonProperty("time")]
		function timestamp()
		{
			mktime();
		}
        //[JsonProperty("timezone")]
		function timezone()
		{
			
		}
        //[JsonProperty("bank_server")]
		function get_bank_server()
		{
			return $this->bank_server;
		}
		function set_bank_server($new_bank_server)
		{
			$this->bank_server = $new_bank_server;
		}
        //[JsonProperty("total_authentic")]
		function get_total_authentic()
		{
			return $this->total_authentic;
		}
		function set_total_authentic($new_total_authentic)
		{
			$this->total_authentic = $new_total_authentic;
		}
        //[JsonProperty("total_fracked")]
		function get_total_fracked()
		{
			return $this->total_fracked;
		}
		function set_total_fracked($new_)
		{
			$this->total_fracked = $new_total_fracked;
		}
        //[JsonProperty("total_counterfeit")]
		function get_total_counterfeit()
		{
			return $this->total_counterfeit;
		}
		function set_total_counterfeit($new_total_counterfeit)
		{
			$this->total_counterfeit = $new_total_counterfeit;
		}

        //[JsonProperty("total_lost")]
		function get_total_lost()
		{
			return $this->total_lost;
		}
		function set_total_lost($new_total_lost)
		{
			$this->total_lost = $new_total_lost;
		}
	
        //[JsonProperty("receipt")]
        //public ReceiptDetail[] rd 
		function get_ReceiptDetail()
		{
			ReceiptDetail();
		}

    }
}
?>