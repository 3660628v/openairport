<?php
//		  1		    2		  3		    4		  5		    6		  7		    7	      8		
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//==============================================================================================
//	
//	ooooo	oooo	ooooo	o	o		ooooo	ooooo	oooo	oooo	ooooo	oooo	ooooo
//	o   o	o	o	o		o	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	o	o	o		oo	o		o	o	  o		o	o	o	o	o	o	o	o	  o
//	o	o	oooo	oooo	o o	o		ooooo	  o		oooo	oooo	o	o	oooo	  o	
//	o	o	o		o		o  oo		o	o	  o		o  o	o		o	o	o  o	  o
//	o	o	o		o		o	o		o	o	  o		o	o	o		o	o	o	o     o
//	00000	0		ooooo	o	o		o	o	ooooo	o	o	o		ooooo	o	o     o
//
//	The premium quality open source software soultion for airport record keeping requirements
//
//	Designed, Coded, and Supported by Erick Dahl
//
//	Copywrite 2002 - Whatever the current year is
//
//	~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~
//	
//	Name of Document	:	part139339_b_report_browse.php
//
//	Purpose of Page		:	Browse Inspection Reports
//
//	Special Notes		:	Under normal conditions there should be no need to change this page
//							In the event you wish to change this page, everything should be
//							rather stright forward in what it does and how to change it.
//
//==============================================================================================
//2345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345
//		  1		    2		  3		    4		  5		    6		  7		    7	      8	

	// Load global include files
	
		include("includes/_template_header.php");										// This include 'header.php' is the main include file which has the page layout, css, AND functions all defined.
		include("includes/POSTs.php");													// This include pulls information from the $_POST['']; variable array for use on this page
	
// Load Page Specific Includes

		include("includes/_modules/part139339/part139339.list.php");

// Define Variables...
//						for Auto Entry Function {Beginning of Page}
		
		$navigation_page 			= 39;							// Belongs to this Nav Item ID, see function for notes!
		$type_page 					= 15;							// Page is Type ID, see function for notes!
		$date_to_display_new		= AmerDate2SqlDateTime(date('m/d/Y'));
		$time_to_display_new		= date("H:i:s");

// Build the BreadCrum trail... 
//		which shows the user their current location and how to navigate to other sections.
	
		//buildbreadcrumtrail($strmenuitemid,$frmstartdate,$frmenddate);
	
// Start Procedures...
//		Main Page Procedures and Functions	

		
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// 	vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		
		// Set Variables for general use (No need to change)
		$displayrow					= 1;												// NO NEED TO CHANGE THIS VALUE.
		$tbldisplaytotal			= 0;												// 1: Add the value of given columns together;	0: Do not add given columns together.
		
		
		// Show Controls (Interface)
		$tbl_show_datesort 			= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbl_show_textsort			= 0;												// 1: Allow User to Show Records by Text; 		0: Prevent User from sorting records by Text.
		$tbl_show_headersort		= 1;												// 1: Allow User to Show Records by Header; 	0: Prevent User from sorting records by Header.
		$tbl_show_duplicatesort		= 0;												// 1: Default to Show DUPLICATE Records;		0: Default to NOT show DUPLICATE Recrords. 
		$tbl_show_archivedsort		= 1;												// 1: Default to Show ARCHIVED Records; 		0: Default to NOT show ARCHIVED Recrords.
		$tbl_show_closedsort		= 1;												// 1: Default to Show CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$tbl_show_joinedsort		= 1;												// 1: Allow User to Show Records by Text; 		0: Prevent User from sorting records by Text.
		$tbl_show_pagation			= 1;
		
		// Sorting Controls (Interface / Saved Settings)
		// These are only used on the inital display of the report (then by user control)
		$tbldatesort 				= 1;												// 1: Allow User to Sort Records by Date; 		0: Prevent User from sorting records by Date.
		$tbltextsort 				= 0;												// 1: Allow User to Sort Records by Text; 		0: Prevent User from sorting records by Text.
		$tblheadersort				= 1;												// 1: Allow User to Sort Records by Header; 	0: Prevent User from sorting records by Header.
		$tblduplicatesort			= 0;												// 1: Default to Use DUPLICATE Records;			0: Default to NOT show DUPLICATE Recrords. 
		$tblarchivedsort			= 0;												// 1: Default to Use ARCHIVED Records; 			0: Default to NOT show ARCHIVED Recrords.
		$tblclosedsort				= 0;												// 1: Default to Use CLOSED Records; 			0: Default to NOT show CLOSED Recrords
		$tbljoinedsort				= 0;												// 1: Default to Use JOINED Records; 			0: Default to NOT show JOINED Recrords
		
		$tblpagation				= 1;
		$tblpagationgroup			= 7;
		
		// Preflight Settings	
		//	Proivides the recordset with additional controls not part of the database record
		//	Each preflight is run before the recordset is displayed and controls if the record set is displayed. 
		
		$runpreflights				= 1;												// Tells the Program if it should run the 
		$function_duplicatesort		= '';												// The Name of the function to call to sort out DUPLICATE Records.
		$function_archivedsort		= 'preflights_tbl_139_339_sub_n_a_yn';				// The Name of the function to call to sort out ARCHIEVED Records.
		$function_closedsort		= 'preflights_tbl_139_339_sub_n_r_yn';												// The Name of the function to call to sort out CLOSED Records.
		
		// Postflight Controls
		//	Provides the record set with additional controls not part of the database record
		//	Like Preflight settings, but run after the record set is displayed and allows for additional commands
		
		$runpostflights				= 1;												// Tells the program if it should run the postflight controls
		
		$array_archivedcontrol		= array("SELECT * FROM tbl_139_339_sub_n_a WHERE 139339_n_a_inspection_id = "	,	"139339",	"part139339_b_report_display_archived.php");
		$array_errorcontrol			= array("SELECT * FROM tbl_139_339_sub_n_e WHERE 139339_n_e_inspection_id = "	,	"139339",	"part139339_b_report_display_error.php");
		$array_closedcontrol		= array("SELECT * FROM tbl_139_339_sub_n_r WHERE 139339_sub_n_r_cancelled_id_int = "	,	"139339_sub_n",	"part139339_b_report_display_closed.php");

		//$array_bouncedcontrol		= array("SELECT * FROM tbl_139_327_sub_d_b WHERE discrepancy_bounced_inspection_id = ",		"discrepancy",	"part139327_discrepancy_report_display_bounced.php");
		//$array_duplicatecontrol	= array("SELECT * FROM tbl_139_327_sub_d_d WHERE discrepancy_duplicate_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_duplicate.php");
		//$array_repairedcontrol	= array("SELECT * FROM tbl_139_327_sub_d_r WHERE discrepancy_repaired_inspection_id = ",	"discrepancy",	"part139327_discrepancy_report_display_repaired.php");

		// Report Page Settings		
		
		$function_calendar			= 'part139339_b_report_calendar.php';					// The URL of the webpage to load to display the Calendar.
		$function_printout			= '_general_printouts_get.php';							// The URL of the webpage to load to display the Printout.
		$function_distribution		= '';													// The URL of the webpage to load to display the Distribition Chart.
		$function_linechart			= '';													// The URL of the webpage to load to display the Line Chart.		
		$function_mapit				= 'part139339_b_report_display_mapit_loader.php';		// The URL of the webpage to load to display the Mapit.		
		$function_googleearthit		= 'part139339_b_report_export_makekml_loader.php';		// The URL of he webpage used to generate this information.	
	
		$functioneditpage 			= "part139339_b_report_edit.php";						// Name of page used to edit the record
		$functionsummarypage 		= "part139339_b_report_summary.php";					// Name of page used to display a summary of the record
		$functionprinterpage 		= "part139339_b_report_display_new.php";				// Name of page used to display a printer friendly report
		$functionworkorderpage		= '';
		$functionclosedpage			= "part139339_b_report_closed.php";

		$functionduplicatepage		= '';
		$functionarchievedepage		= "part139339_b_report_archieved.php";
		$functionerrorpage			= "part139339_b_report_error.php";
		$functionbouncepage			= '';
		$functionrepairpage			= '';		

	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//	^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
	//	THE CONTAIN CONTENTS IS THE SAME FORMAT FOR ALL BROWSE DOCUMENTS, ALTHOUGH THE DATA MAY BE DIFFERENT
	// ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
		
	// this information is needed to program the datafields and sql statements on the fly without any user interuption
		// what is the primary key field (id field) of the table
		$tblkeyfield			= "139339_sub_n_id";												// What is the Auto Increment Field for this table ?
		$tbldatesortfield		= "139339_sub_n_date";														// What is the name of field use in date sorting ?
		$tbldatesorttable		= "tbl_139_339_sub_n";													// What table  is that field part of ?
		$tbltextsortfield		= "";																// What is the name of the field used in text sorting ?
		$tbltextsorttable		= "tbl_139_339_sub_n";													// What is the name of the table used for text sorting ?
		$tblarchivedfield		= "";																// What is the name of the field used to mark the record archived ?
		$tblname				= "Part 139.339 (b) NOTAM Summary Report";								// What is the name of the table ? (used on edit/summary/printer report pages)
		$tblsubname				= "Here is the information you selected";									// What is the subname of the table ? (used on edit/summary/printer report pages)
	
	// What php pages are used to control the summary, printer reports, and edit functions?
		// by default these pages should be the following
		// $functioneditpage 			= "edit_record_general.php";
		// $functionsummarypage 		= "summary_report_general.php";
		// $functionprinterpage 		= "printer_report_general.php";
		//$functioneditpage 		= "part139327_report_edit.php";											// Name of page used to edit the record
		//$functionsummarypage 	= "summary_report_general.php";											// Name of page used to display a summary of the record
		//$functionprinterpage 	= "part139327_report_display_new.php";											// Name of page used to display a printer friendly report

	// what columns should the datagrid display?
		// this is an array of information, from [0] to [...], you may have an unlimited number of columns
		$adatafield[0]			= "139339_sub_n_date";
		$adatafield[1]			= "139339_sub_n_time";
		$adatafield[2]			= "139339_sub_n_type_cb_int";
		$adatafield[3]			= "139339_sub_n_by_cb_int";
	// in each array specified above, what table does that field come from?
		$adatafieldtable[0]		= $tbltextsorttable;
		$adatafieldtable[1]		= $adatafieldtable[0];
		$adatafieldtable[2]		= $adatafieldtable[0];
		$adatafieldtable[3]		= $adatafieldtable[0];	
	// do you want the user ot be able to click on the information and have something happen?
		// "notjoined" will cause nothing to happen, only the data will be displayed
		// the name of any field in any of the selected tables will cause only records that have that information to be displayed.
		$adatafieldid[0]		= "justsort";
		$adatafieldid[1]		= "justsort";
		$adatafieldid[2]		= "139339_sub_n_type_cb_int";
		$adatafieldid[3]		= "139339_sub_n_by_cb_int";
	// in some cases you may want the information displayed to be prefecned with a $ sign or followed by a % sign. here you can tell the program what to display if anything
		// 0 : nothing ; 2 : @ ; 4 : $ ; 5 : %
		$adataspecial[0]		= 0;
		$adataspecial[1]		= 0;
		$adataspecial[2]		= 0;
		$adataspecial[3]		= 0;	
	// what do you want to name the columns
		$aheadername[0]			= "Date";
		$aheadername[1]			= "Time";
		$aheadername[2]			= "Type";
		$aheadername[3]			= "Inspector";
	// Any special comments to make after the input box?
		$ainputcomment[0]		= "( mm/dd/yyyy )";
		$ainputcomment[1]		= "( 24 hour )";
		$ainputcomment[2]		= "(select from the list)";
		$ainputcomment[3]		= "(select from the list)";
	// what type of input is this field?
		// this can be any type of input
		// text, textarea, select, etc.
		$ainputtype[0]			= "TEXT";
		$ainputtype[1]			= "TEXT";
		$ainputtype[2]			= "SELECT";
		$ainputtype[3]			= "SELECT";
	// if the input type is a SELECT type you should define the name of the function you want to call to load into that select statement
		$adataselect[0]			= "";
		$adataselect[1]			= "";
		$adataselect[2]			= "part139339typescombobox";
		$adataselect[3]			= "systemusercombobox";
	// in the event of an error when a user enteres a wrong date, what should the datagrid say to the user?
		$tmpDateEventErrorMessage	= "Error, reset to default";
		
		$displayerrors			= 0;
		
	include("includes/_template_browse.php");	

// Define Variables...
//						for Auto Entry Function {End of Page}

		if (!isset($_POST["formsubmit"])) {
				// Not defined, set to zero
				$submit = 0;
			} else {
				$submit = $_POST["formsubmit"];
			}
				
		$last_main_id	= "-";	// NO Useable ID
		$auto_array		= array($navigation_page, $_SESSION["user_id"], $submit, $date_to_display_new, $time_to_display_new, $type_page,$last_main_id); 

		ae_completepackage($auto_array);	
	
// Load End of page includes
//	This page closes the HTML tag, nothing can come after it.

		include("includes/_userinterface/_ui_footer.inc.php");							// Include file providing for Tool Tips			
?>		