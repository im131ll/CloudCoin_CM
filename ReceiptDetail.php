<?php

namespace Founders 
{
	class ReceiptDetail implements JsonSerializable
	{
		var $nn;
		var $sn;
		var $status;
		var $pown;
		var $note;
        //Fields
        //[JsonProperty("nn")]

		function get_nn()
		{
			return $this->nn;
		}
		
		function set_nn($new_nn)
		{
			$this->nn = $new_nn;
		}

        //[JsonProperty("sn")]
		function get_sn()
		{
			return $this->sn;
		}
		
		function set_sn($new_sn)
		{
			$this->sn = $new_sn;
		}

        //[JsonProperty("status")]
		function get_status()
		{
			return $this->status;
		}
		
		function set_status($new_status)
		{
			$this->status = $new_status;
		}

        //[JsonProperty("pown")]
        //public string $pown { get; set; }
		function get_pown()
		{ 
			return $this->pown; 
		}
		function set_pown($new_pown)
		{ 
			$this->pown = $new_pown; 
		}

        //[JsonProperty("note")]
		function get_note()
		{ 
			return $this->note; 
		}
		function set_note($new_note)
		{ 
			$this->note = $new_note; 
		}



        //Constructors
		/*
		function ReceiptDetail()
        {

        }//end of constructor
		*/

		function ReceiptDetail($nn, $sn, $status, $pown, $note)
        {
            $this->nn = $nn;
            $this->sn = $sn;
            $this->status = $status;
            $this->pown = $pown;
            $this->note = $note;

        }//end of constructor

	}
		
}//End Namespace
?>