<?php

//namespace CloudBankTester
{
    class BankTotal
    {	
		var $ones;
 		var $fives;
 		var $twentyfives;
 		var $hundreds;
 		var $twohundredfifties;

		function get_ones()
		{
			return $this->ones;
		}
		function set_($new_ones)
		{
			$this->ones = $new_ones;
		}
		function get_fives()
		{
			return $this->fives;
		}
		function set_fives($new_fives)
		{
			$this->fives = $new_fives;
		}
		function get_twentyfives()
		{
			return $this->twentyfives;
		}
		function set_twentyfives($new_twentyfives)
		{
			$this->twentyfives = $new_twentyfives;
		}
		function get_hundreds()
		{
			return $this->hundreds;
		}		
		function set_hundreds($new_hundreds)
		{
			$this->hundreds = $new_hundreds;
		}
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