<?php
function part139327discrepancydisplaybox($txtdisplay, $bsize, $fsize,$hsize, $jsize, $wpost, $xpost, $ypost, $zpost, $disid, $disname,$disremarks,$disx,$disy, $distools = 0) {
		// The purpose of this function is to generalize the Discrepancy Display box found on the Part 139.327 reports.
		
		//Target Locator Required Offsets
		$addedoffset	= 0;
		$OffSetX 		= -15;
		$OffSetY 		= 65;
		$disheight		= 0;
		$tempX 			= ($disx + $OffSetX);
		$tempY 			= ($disy + $OffSetY);
		
		if($txtdisplay <> "Targets Only") {
				// DISPLAY RIGHT SIDE INFORMATION
				//
				?>
		<div style="position:absolute; width:<?php echo ($wpost);?>; left:<?php echo ($xpost);?>px; top:<?php echo ($ypost);?>px; z-index:<?php echo ($zpost);?>; align="center">
			<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border:1px #000000 solid" />
				<tr>
					<td width="12" rowspan="8" bgcolor="#C0C0C0" style="opacity:.7;" />
						D
						</td>
					<td bgcolor="#C8C8C8" style="opacity:.7;" />
						ID
						</td>
					<td bgcolor="#FFFFFF" style="opacity:.7;" />
						<?php echo $disid;?>
						<?php
						$disheight 	= ($disheight + 12);
						?>
						</td>
					</tr>					
				<tr>
					<td colspan="2" bgcolor="#C8C8C8" style="opacity:.7;" />
						Name 
						</td>
					</tr>
				<tr>
					<td colspan="2" bgcolor="#FFFFFF" style="opacity:.7;" />
						<?php
						// Count chars in name string and limit string to the limiting factor
						$limit 		= 15;
						$name_len 	= strlen($disname);
						if($name_len > $limit) {
								$display_name = substr($disname, 0, $limit) . '...';
								$disheight 	= ($disheight + 56);
							} else {
								$display_name  = $disname;
								$disheight 	= ($disheight + 24);
							}
						?>
						<?php echo $display_name;?>
						</td>
					</tr>					
				<tr>
					<td colspan="2" bgcolor="#C8C8C8" style="opacity:.7;" />
						Description
						</td>
					</tr>
				<tr>
					<td colspan="2" bgcolor="#FFFFFF" style="opacity:.7;" />
						<?php
						// Count chars in name string and limit string to the limiting factor
						$limit 		= 30;
						$name_len 	= strlen($disremarks);
						if($name_len > $limit) {
								$display_remarks = substr($disremarks, 0, $limit) . '...';
								$disheight 	= ($disheight + 56);
							} else {
								$display_remarks  = $disremarks;
								$disheight 	= ($disheight + 24);
							}
						?>
						<?php echo $display_remarks;?>
						</td>
					</tr>
				<tr>
					<td colspan="2" bgcolor="#C8C8C8" style="opacity:.7;" />
						Flags
						</td>
					</tr>
				<tr>
					<td colspan="2" bgcolor="#FFFFFF" style="opacity:.7;" style="border-width: 0px;padding: 1px;border-style: none;border-color: gray;-moz-border-radius: ;"/>				
				<?php
					if ($distools == 1) {
							// Display all functions and buttons for this Discrepancy
							
							$discrepancybouncedid 	= "";
							$discrepancybounceddate = "";
							$discrepancybouncedtime = "";
							$discrepancyrepairid 	= "";
							$discrepancyrepairdate 	= "";
							$discrepancyrepairtime 	= "";
							$isduplicate			= "";
							$isarchived				= "";
						
								//test 3). Determine if the Discrepancy is currently outstanding or has been fixed. This involves checking both the repaired and bounced tables for information about the
								//current discrepancy ID. This will be done in three phases. 
								//Phase 1 will be to check the bounced table to see if there is any records about this discrepancy ID there. if so get the date of the latest record and put the ID of the record in a variable
								//phase two will be to check the repaired table and see if there is any information about this discrepancy there. if so get the date of the latest record and put the ID of the record in a variable
								//phase three will be to compare the two dates provided and see which event is most recent.
								
								// Need to figure out what the current status of this discrepancy is!
								// Status:
								//				0 - Work Order
								//				1 - Repaired
								//				2 - Bounced	
								//				3 - Closed
								$status 				= part139327discrepancy_getstage($disid,0,0,0,0);
								// Lie to the blockform
								$imclearlyahijacker		= 1;
								$functionworkorderpage 	= 1;
								$functionworkorderpage	= 'part139327_discrepancy_report_display_workorder.php';
								$functionrepairpage		= 'part139327_discrepancy_report_repair.php';
								$functionbouncepage		= 'part139327_discrepancy_report_bounce.php';
								$functionclosedpage		= 'part139327_discrepancy_report_closed.php';
								$array_repairedcontrol	= array(0,0,'part139327_discrepancy_report_display_repaired.php');
								$array_bouncedcontrol	= array(0,0,'part139327_discrepancy_report_display_bounced.php');
								$array_closedcontrol	= array(0,0,'part139327_discrepancy_report_display_closed.php');
								
								// Utilize our lies
								
								$grid_or_row = 'grid';
								include("includes/_template/_tp_blockform_workorder_report.binc.php");	
								
						}
						$disheight 	= ($disheight + 25);
						?>
						</td>
					</tr>
				</table>
			</div>
		<?php
		}
		// DISPLAY LOCATION POINTER
		//
		?>
		
		<div style="position:absolute; z-index:<?php echo $zpost;?>; left:<?php echo $tempX;?>px; top:<?php echo $tempY;?>px;" align="left" />
			<table border="0" cellpadding="0" cellspacing="0" id="AutoNumber1">
  				<tr>
					<form style="margin-bottom:0;" action="part139327_discrepancy_report_display.php" method="POST" name="dislookform<?php echo $disid;?>" id="dislookform<?php echo $disid;?>" target="ViewWorkOrder" />
						<input class="formsubmit"	type="hidden" name="recordid" 			id="recordid"			value="<?php echo $disid;?>">
					<td rowspan="2" width="31" height="31" align="left" valign="top" class="" onMouseover="ddrivetip('<?php echo $disid;?> : <?php echo $disremarks;?>')"; onMouseout="hideddrivetip()" onclick="javascript:open_new_report_window('','ViewWorkOrder');javascript:document.dislookform<?php echo $disid;?>.submit()">
						 <img border="0" src="images/part_139_327/discrepancywork3.gif" s="31" height="31" border="0" />
						</td>
						</form>
					</tr>
				</table>
			</div>			
			
		<?php
		if($txtdisplay <> "Targets Only") {
		// DISPLAY Line from Discrepancy Location to Description of Discrepancy
		//
		
		// Make Value Integers
		$tempX 				= intval($tempX);
		$tempY 				= intval($tempY);
		$tempX2				= intval($xpost);
		$tempY2				= intval($ypost);
		$disheight			= intval($disheight);
		$halfaddedoffset	= ($disheight / 3);
		$halfaddedoffset	= intval($halfaddedoffset);
		//echo "Disheight =".$disheight." / 2 ".$halfaddedoffset." ";
		
		// Add Custom Offsets (x1,y1)
		$tempX 				= ($disx + 22 );
		$tempY 				= ($disy + 22 );
		
		// Add Custom Offsets (x2,y2)
		$tempX2				= ($tempX2 - 1);
		$tempY2				= ($tempY2 - 50);

		$tempxpoints 		= $tempX.",".$tempX2;
		$tempypoints 		= $tempY.",".$tempY2;
		?>
		
		<div style="position:absolute; z-index:3;" id="myCanvas_<?php echo $disid;?>"></div>			
			<script type="text/javascript">
				<!--
				function myDrawFunction() {
					// Get The current Numbers from the Edit Table, and set them to the variable.
					var xpoints = "<?php echo $tempxpoints;?>";
					var ypoints = "<?php echo $tempypoints;?>";
					var xtotal = 0;
					var ytotal = 0;
					var xaverage = 0;
					var yaverage = 0;

					// Take apart the string values of the text fiel and put the strings into an array
					var xpoints=xpoints.split(",");
					var ypoints=ypoints.split(",");

					// In each array take the string and convert it into a number adjusting for mouse pointer error
					for (i=0; i<xpoints.length; ++i) {
					  xpoints[i] = xpoints[i] * 1 - 21;
					  xtotal = xtotal + xpoints[i];
					  } // for
					  xaverage = (xtotal/xpoints.length);
					for (i=0; i<ypoints.length; ++i) {
					  ypoints[i] = ypoints[i] * 1 + 60;  
					  ytotal = ytotal + ypoints[i];
					  } // for
					  yaverage = (ytotal/ypoints.length);

					// Draw the Pavement section
					jg.setPrintable(true);
					jg.setColor("#ff000f"); // red
					jg.setStroke(3); 
					jg.drawPolyline(xpoints, ypoints);
					jg.paint();
				}													

				var jg = new jsGraphics("myCanvas_<?php echo $disid;?>");

				myDrawFunction();													
				//-->
				</script>	
				<?php
		//echo "DisHeight ".$disheight." ".$halfaddedoffset."<br>";
		//$disheight = 140;
				}
				
		return $disheight;
		
		}
		?>