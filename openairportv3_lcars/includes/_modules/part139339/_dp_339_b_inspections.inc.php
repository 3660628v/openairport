<?php
function _dp_339_b_inspections($dasharray) {
		//						0					1						2					3					4					5					6					7					8					9
		//$dasharray	= array($tmp_dash_main_id	,$tmp_dash_main_func	,$tmp_dash_main_nl	,$tmp_dash_main_ns	,$tmp_dash_main_p	,$tmp_dash_main_ml	,$tmp_menu_item_id	,$tmp_menu_item_loc	,$tmp_menu_item_nl	,$tmp_menu_item_ns);
		?>
<div class="table_dashpanel_container" id="div_339binspections" />
<table align="left" valign="top"  width="100%" border="0" cellpadding='0' cellspacing='0' />
	<tr>
		<form style="margin: 0px; margin-bottom:0px; margin-top:-1px;" name="menuitem<?php echo $dasharray[6];?>" id="menuitem<?php echo $dasharray[6];?>" method="POST" action="<?php echo $dasharray[7];?>" target="layouttableiframecontent">
			<input type="hidden" name="menuitemid" value="<?php echo $dasharray[6];?>">
		<td colspan="2">
			<input class="table_dashpanel_container_header" type="button" name="button" value="<?php echo $dasharray[2];?>" onclick="javascript:document.getElementById('menuitem<?php echo $dasharray[6];?>').submit();" />
			</td>
			</form>	
		</tr>
	<?php
	
		// Loop through active discrepancies and display a summary report for each one
		$sql 		= "SELECT * FROM tbl_139_339_sub_n 
		INNER JOIN tbl_systemusers 		ON tbl_systemusers.emp_record_id = tbl_139_339_sub_n.139339_sub_n_by_cb_int  
		INNER JOIN tbl_139_339_sub_t 	ON tbl_139_339_sub_t.139339_type_id = tbl_139_339_sub_n.139339_sub_n_type_cb_int
		ORDER BY 139339_sub_n_date, 139339_sub_n_time";
		
		//echo $sql;
		$objconn 	= mysqli_connect($GLOBALS['hostdomain'], $GLOBALS['hostusername'], $GLOBALS['passwordofdatabase'], $GLOBALS['nameofdatabase']);

		$shown	= 0;
		
		if (mysqli_connect_errno()) {
				printf("connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			else {
				$objrs = mysqli_query($objconn, $sql);		
				if ($objrs) {
						$number_of_rows 	= mysqli_num_rows($objrs);
						if($number_of_rows == 0){
								// Nothing to Display
								?>
	<tr>
		<td colspan="2" class="table_dashpanel_container_noresults" align="left" valign="top" />
			No Inspections Today
			</td>
		</tr>
								<?php
							}
						
						while ($objarray 	= mysqli_fetch_array($objrs, MYSQLI_ASSOC)) {
						
								$skipping		= 0;
						
								$displayrow					= 1;
								$displayrow_a				= 0;
								$displayrow_b				= 0;
	
								$tmp_inspection_id			= $objarray['139339_sub_n_id'];
								$tmp_inspection_type		= $objarray['139339_sub_n_type_cb_int'];	
								
								// Test for archived. If 1 not archived, 0 is archived?
								$display_archived		= preflights_tbl_139_339_sub_n_a_yn($objarray['139339_sub_n_id'],0);	
								//echo "Display Archived = ".$display_archived."<br>";
								$display_closed			= preflights_tbl_139_339_sub_n_r_yn($objarray['139339_sub_n_id'],0);
								//echo "Display Closed = ".$display_closed."<br>";
								
								if($display_archived == 0) {
										// Surface is archived, skipp the rest
										$skipping = 1;
									} else {														
										
										if($display_closed == 1) {
												// Surface NOTAM has no closed records
												$message = "Closed";
												$skipping = 0;
											} else {
												$skipping = 1;
											}
										
										
									}
								
								
								
								if($skipping == 1) {
										// display nothing
										$displayrow = 0;
										?>
										
										<?php
									}
									else {
										// Check Status of this Discrepancy, ie. Get the current stage
												?>
	<tr>
		<td colspan="2" class="table_dashpanel_container_summary" />
		<?php
			$shown = $shown + 1;
										_339_b_display_report_summary($tmp_inspection_id,0,0);
										?>
			</td>
		</tr>
										<?php
										
									}
							}	
					}
			}

		if($shown == 0) {
				?>
					<tr>
		<td colspan="2" class="table_dashpanel_container_noresults" align="left" valign="top" />
			No Active Notams
			</td>
		</tr>
				<?php
		}
?>
	<tr>
		<td colspan="2" class='table_dashpanel_container_footer' />	
			</td>
		</tr>
	</table>
	</div>
	<?php
	}
?>