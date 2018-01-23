<?php

namespace CloudBankTester
{
    class BankTotal implements JsonSerializable
    {	
		var $ones;
 		var $fives;
 		var $twentyfives;
 		var $hundreds;
 		var $twohundredfifties;
		
		
		
        //Fields

		//use as get and set function
		function get_()
		{
			return $this->
		}
		
		function set_($new_)
		{
			$this-> = $new_
		}

		

        //[JsonProperty("ones")]
		function get_ones()
		{
			return $this->ones;
		}
		
		function set_($new_ones)
		{
			$this->ones = $new_ones;
		}

        //[JsonProperty("fives")]
		function get_fives()
		{
			return $this->fives;
		}
		
		function set_fives($new_fives)
		{
			$this->fives = $new_fives;
		}

        //[JsonProperty("twentyfives")]
		function get_twentyfives()
		{
			return $this->twentyfives;
		}
		
		function set_twentyfives($new_twentyfives)
		{
			$this->twentyfives = $new_twentyfives;
		}
        //[JsonProperty("hundreds")]
		function get_hundreds()
		{
			return $this->hundreds;
		}
		
		function set_hundreds($new_hundreds)
		{
			$this->hundreds = $new_hundreds;
		}

        //[JsonProperty("twohundredfifties")]
		function get_twohundredfifties()
		{
			return $this->twohundredfifties;
		}
		
		function set_twohundredfifties($new_twohundredfifties)
		{
			$this->twohundredfifties = $new_twohundredfifties;
		}
		


        //Constructors
		/*
		function __construct($ones, $fives, $twentyfives, $hundreds, $twohundredfifties)
		{
			$this->ones = $ones;
            $this->fives = $fives;
            $this->twentyfives = $twentyfives;
            $this->hundreds = $hundreds;
            $this->twohundredfifties = $twohundredfifties;
		}
		/*
		function BankTotal()
        {

        }
		*/
		
		function BankTotal($ones, $fives, $twentyfives, $hundreds, $twohundredfifties)
        {
            $this->ones = $ones;
            $this->fives = $fives;
            $this->twentyfives = $twentyfives;
            $this->hundreds = $hundreds;
            $this->twohundredfifties = $twohundredfifties;

        }//end of constructor

    }
}
?>