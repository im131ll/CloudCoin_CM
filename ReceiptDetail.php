<?php

namespace Founders
{
    public class ReceiptDetail
    {
        //Fields
        //[JsonProperty("nn")]
        public int $nn { get; set; }

        //[JsonProperty("sn")]
        public int $sn { get; set; }

        //[JsonProperty("status")]
        public string $status { get; set; }

        //[JsonProperty("pown")]
        //public string $pown { get; set; }
		public function get_pown()
		{ 
			return $this->pown; 
		}
		public function set_pown($new_pown)
		{ 
			$this->pown = $new_pown; 
		}

        //[JsonProperty("note")]
        public string $note { get; set; }


        //Constructors
        public function ReceiptDetail()
        {

        }//end of constructor

        public function ReceiptDetail(int $nn, int $sn, string $status, string $pown, string $note)
        {
            $this->nn = $nn;
            $this->sn = $sn;
            $this->status = $status;
            $this->pown = $pown;
            $this->note = $note;

        }//end of constructor

    }//End Class
}//End Namespace
?>