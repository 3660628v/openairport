<?php
function _337_display_summary($discrepancyid = 0,$detail_level = 0,$returnhtml = 0) {
		// Display Discrepancy Summary
		// Detail Level:
		//					0 : Name and Remark
		//					1 : All Local Table Values
		//					2 : Everything!!!! (1,3,4,5,6,7,8,etc...)
		//					3 : 1 + Archieved
		//					4 : 1 + Error
		
		$display_basic 		= 0;
		$display_extended 	= 0;
		$display_archived	= 0;
		$display_error		= 0;

		$webroot			= "http://localhost/openairportv3_lcars/";
		
		if($detail_level == 0) {
				$display_basic 		= 1;
		
			}
		if($detail_level == 1) {
				$display_basic 		= 1;
				$display_extended 	= 1;

			}			
		if($detail_level == 2) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_archived	= 1;
				$display_error		= 1;
		
			}
		if($detail_level == 3) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_archived	= 1;
		
			}			
		if($detail_level == 4) {
				$display_basic 		= 1;
				$display_extended 	= 1;
				$display_error		= 1;
		
			}			
			
		$sql 		= "SELECT * FROM tbl_139_337_main 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id 			= tbl_139_337_main.139337_author_by_cb_int 
		INNER JOIN tbl_139_337_sub_an 	ON tbl_139_337_sub_an.139337_sub_an_id 		= tbl_139_337_main.139337_action_cb_int 
		INNER JOIN tbl_139_337_sub_ay 	ON tbl_139_337_sub_ay.139337_sub_ay_id 		= tbl_139_337_main.139337_activity_cb_int 
		INNER JOIN tbl_139_337_sub_s 	ON tbl_139_337_sub_s.139337_sub_s_id 		= tbl_139_337_main.139337_species_cb_int  ";
		
		if($discrepancyid == 0) {
				// No discrepancy is defined, find all
			}
			else {
				// Use the specific entry
				$sql = $sql."WHERE 139337_id = '".$discrepancyid."' ";
			}
		
		//echo $sql;
		$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
		
		if($returnhtml == 0) {
				// Just display the results now
				echo "<table width='100%' cellpaddin='1' cellspacing='1' border='0' class='layout_dashpanel_container_div'>";
			}
			else {
				// DO NOT display anything YET!!!!!
				$table_i = "<table width='100%' cellpaddin='1' cellspacing='1' border='0' class='layout_dashpanel_container_div'>";
			}

		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);		
				if ($objrs) {
						$number_of_rows 	= mysqli_num_rows($objrs);
						while ($objarray 	= mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$discrepancyid = $objarray['139337_id'];
								
								$basicHTML = "
												<tr>		
													<td class='table_dashpanel_container_summary_rowheader'>
														ID
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>
														<a class='table_dashpanel_container_summary_link' href='#' onclick='openmapchild(&quot;part139337_report_display.php?recordid=".$discrepancyid."&quot;,&quot;SummaryWindow&quot;)'; />".$discrepancyid."</a>
														</td>
													</tr>
												<tr>		
													<td class='table_dashpanel_container_summary_rowheader'>
														Date / Time
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>".
														$objarray['139337_date']." / ".$objarray['139337_time']." 
														</td>
													</tr>													
												<tr>		
													<td class='table_dashpanel_container_summary_rowheader'>
														Species
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>".
														$objarray['139337_sub_s_name']."
														</td>
													</tr>
												<tr>		
													<td class='table_dashpanel_container_summary_rowheader'>
														Action Taken
														</td>
													<td class='table_dashpanel_container_summary_rowresult'>".
														$objarray['139337_sub_an_name']."
														</td>
													</tr>";

								if($returnhtml == 0) {
										// Just display the results now
										echo $basicHTML;
									}
									else {
										// DO NOT display anything YET!!!!!
									}

								if($display_extended == 1) {
							
										$extendedHTML = "
														<tr>
															<td colspan='2' class='table_dashpanel_container_summary_header'>
																Extended Information
																</td>
															</tr>									
														<tr>		
															<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																Species Activity
																</td>
															<td class='table_dashpanel_container_summary_rowresult'>".
																$objarray['139337_sub_ay_name']."
																</td>
															</tr>
														<tr>		
															<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																Number of Species
																</td>
															<td class='table_dashpanel_container_summary_rowresult'>".
																$objarray['139337_numberofspecies']." 
																</td>
															</tr>
														<tr>		
															<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																Results of Action Taken
																</td>
															<td class='table_dashpanel_container_summary_rowresult'>".
																$objarray['139337_resultsofaction']." 
																</td>
															</tr>									
														<tr>		
															<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																Weather
																</td>
															<td class='table_dashpanel_container_summary_rowresult'>".
																$objarray['139337_weather']." 
																</td>
															</tr>		
														<tr>		
															<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																METAR
																</td>
															<td class='table_dashpanel_container_summary_rowresult'>".
																$objarray['139337_metar']." 
																</td>
															</tr>
														<tr>		
															<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																Location
																</td>
															<td class='table_dashpanel_container_summary_rowresult'>
																X:".$objarray['139337_location_x'].", Y:".$objarray['139337_location_y']." 
																</td>
															</tr>
														";

										if($returnhtml == 0) {
												// Just display the results now
												echo $extendedHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}								
									}
								
								if($display_archived == 1) {	

										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_337_main_a
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_337_main_a.139337_a_by_cb_int 
										WHERE 139337_a_inspection_id = '".$discrepancyid."' 
										ORDER BY 139337_a_date,139337_a_time";
										
										$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
										if (mysqli_connect_errno()) {
												// there was an error trying to connect to the mysql database
												printf("connect failed: %s\n", mysqli_connect_error());
												exit();
											}
											else {
												$objrs2 = mysqli_query($objconn2, $sql2);
												if ($objrs2) {
														$number_of_rows = mysqli_num_rows($objrs2);
														if($number_of_rows >=1) {
																
																$archievedHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Archived Information
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $archievedHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															else {
															
																$archievedHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Archived Information
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_rowresult'>
																						<b>There are no records to display</b>
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $archievedHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}																
															}
															
														while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	
														
																$archivedHTML = $archivedHTML."
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Date / Time
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['139337_a_date']." / ".$objarray2['139337_a_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Archieved By
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['emp_firstname']." ".$objarray2['emp_lastname']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Comments
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['139337_a_reason']." 
																						</td>
																					</tr>
																				";
															}
													}
											}
										if($returnhtml == 0) {
												// Just display the results now
												echo $archivedHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}
									}		
									
								if($display_error == 1) {	

										// Display all Bounced Information
										// Display all Bounced Information
										$sql2 = "SELECT * FROM tbl_139_337_main_e
										INNER JOIN tbl_systemusers ON tbl_systemusers.emp_record_id = tbl_139_337_main_e.139337_e_by_cb_int 
										WHERE 139337_e_inspection_id = '".$discrepancyid."' 
										ORDER BY 139337_e_date,139337_e_time";
										
										$objconn2 = mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);
										if (mysqli_connect_errno()) {
												// there was an error trying to connect to the mysql database
												printf("connect failed: %s\n", mysqli_connect_error());
												exit();
											}
											else {
												$objrs2 = mysqli_query($objconn2, $sql2);
												if ($objrs2) {
														$number_of_rows = mysqli_num_rows($objrs2);
														if($number_of_rows >=1) {
																
																$errorHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Error Information
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $errorHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}		
															}
															else {
															
																$errorHTML_i = "
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_header'>
																						Error Information
																						</td>
																					</tr>
																				<tr>
																					<td colspan='2' class='table_dashpanel_container_summary_rowresult'>
																						<b>There are no records to display</b>
																						</td>
																					</tr>
																				";
																				
																if($returnhtml == 0) {
																		// Just display the results now
																		echo $errorHTML_i;
																	}
																	else {
																		// DO NOT display anything YET!!!!!
																	}															
															}
															
														while ($objarray2 = mysqli_fetch_array($objrs2, MYSQLI_ASSOC)) {	

																$errorHTML = $errorHTML."												
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Date / Time
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['139337_e_date']." / ".$objarray2['139337_e_time']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Error By
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['emp_firstname']." ".$objarray2['emp_lastname']." 
																						</td>
																					</tr>
																				<tr>		
																					<td align='center' valign='middle' class='table_dashpanel_container_summary_rowheader'>
																						Comments
																						</td>
																					<td class='table_dashpanel_container_summary_rowresult'>".
																						$objarray2['139337_e_reason']." 
																						</td>
																					</tr>
																				";
															}
													}
											}
										if($returnhtml == 0) {
												// Just display the results now
												echo $errorHTML;
											}
											else {
												// DO NOT display anything YET!!!!!
											}
									}
									
							}
					}
			}
			
		if($returnhtml == 0) {
				// Just display the results now
				echo "</table>";
			}
			else {
				// DO NOT display anything YET!!!!!
				$table_o = "</table>";
			}			
			
		if($returnhtml == 0) {
				// Just display the results now
				// Display Nothing
			}
			else {
				// Assemble a return variable
				$return_string = $table_i."".$basicHTML."".$extendedHTML."".$archievedHTML_i."".$archievedHTML."".$errorHTML_i."".$errorHTML."".$table_o."";
				return $return_string;
			}			
	}
	?>