<?
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o		o	ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		oo		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		o o		o	o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o 	o	o	ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  	 o	o	o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	  o	o	o	o	  o		o	o	o		o	o	o   o	  o
//	00000	0		ooooo	o		o	o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document		:	gs_config.php
//
//	Purpose of Page			:	To set certain global variables in the system
//
//	Special Notes			:	Changce the information here for your airport.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

	// Set Global Variables

		global $nameofairport;
		global $nameofdatabase;
		global $passwordofdatabase;
		global $hostdomain;
		global $hostusername;
	
	// Define Values of Global Variables	
	
		$nameofairport		= "Watertown Regional Airport";								// Change this value to the name of your airport
		$hostdomain			= "localhost";												// Change this to the IP or name of the server hosting OpenAirport (localhost should be ok)
		$hostusername		= "webuser";												// Change this to the name of the user approved to access to MySQL database for OpenAirport
		$nameofdatabase		= "OpenAirport";											// Change this to the name of the OpenAirport database in MySQL
		$passwordofdatabase	= "limitaces";												// Change this to the password the user uses to access the database
		
	// Language Variables
			
		$en_start_date		= "Start Date :";
		$en_end_date		= "End Date :";
		$en_turned_off		= "This options has been turned off";
		$en_joined			= "Join Fields ? :";
		$en_textlike		= "Text Like ? :";
		$en_archived		= "Display Archives ? :";
		$en_closed			= "Display Closed ?:";
		$en_calendarprint	= "Calendar Printout";
		$en_printerprint	= "Printer Friendly Report";
		$en_optionsforu		= "The following options are avilable to you";
		$en_distribution	= "Distribution Chart";
		$en_linechart		= "Line Chart";
		

?>