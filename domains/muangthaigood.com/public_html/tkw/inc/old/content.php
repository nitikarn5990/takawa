<td valign="top" align="center" width="100%"><table width="100%" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<td width="10" valign="top"><img src="images/fader.gif" border="0"></td>
				<td width="770" valign="top" align="left"><img src="images/topfader.gif" border="0"><br>
					
					<!-- Admin --> 
					&nbsp;&nbsp;
					<table width="100%" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
								<td><div>
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0" height="220">
															<tbody>
																<tr>
																	<td valign="top" align="center"><script type="text/javascript" src="modules/randomimg/contentslider.js"></script>
																		<link href="modules/randomimg/contentslider.css" type="text/css" rel="stylesheet">
																		
																		<!-- start slider-->
																		
																		<?php 
																 $sql = "SELECT * FROM " . $slides->getTbl() . " WHERE status = 'ใช้งาน' ORDER BY sort ASC";
																   $query = $db->Query($sql);
																	if($db->NumRows($query) > 0){ ?>
																		<div class="sliderwrapper" id="slider1" align="center">
																			<?php	while($row = $db->FetchArray($query)){  ?>
																			<div class="contentdiv" style="width: 520px; display: none;"> <a href="#"> <img style="width:522px; height:202px;" alt="" border="0" src="<?php echo ADDRESS_SLIDES . $slides_file->getDataDesc("file_name", "slides_id = '" .$row['id']. "' ORDER BY id DESC LIMIT 0,1");?>"> </a> </div>
																			<?php }?>
																		</div>
																		<div class="pagination" id="paginate-slider1"> <a href="#prev" class="prev">&lt;&lt;</a> <a href="#1" class="toc" rel="1">1</a> <a href="#2" class="toc" rel="2">2</a> <a href="#3" class="toc" rel="3">3</a> <a href="#4" class="toc" rel="4">4</a> <a href="#5" class="toc selected" rel="5">5</a> <a href="#next" class="next">&gt;&gt;</a> </div>
																		<?php }?>
																		<script type="text/javascript">
	featuredcontentslider.init({
		id: "slider1",
		contentsource: ["inline", ""],
		toc: "#increment",
		nextprev: ["<<", ">>"],
		revealtype: "click",
		enablefade: [true, 0.1],
		autorotate: [true, 10000],
		onChange: function(previndex, curindex){ 
		}
	})
</script><!-- end slider --></td>
																</tr>
															</tbody>
														</table></td>
												</tr>
											</tbody>
										</table>
										﻿
										<table id="Table_01" width="530" border="0" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td colspan="3" class="titlecenter" background="templates/cli3/images/menu/center.png" width="530" height="39" alt=""></td>
												</tr>
												<tr>
													<td background="templates/cli3/images/menu/ict_02.png" width="5" height="100%" alt=""></td>
													<td width="521"> ﻿
														<link rel="stylesheet" href="css/backbox.css" type="text/css">
														<script type="text/javascript" src="js/prototype.compressed.js"></script> 
														<script type="text/javascript" src="js/scriptaculous.js?load=effects"></script><script type="text/javascript" src="http://scphpl.ac.th/main/js/effects.js"></script> 
														<script type="text/javascript" src="js/lightbox.js"></script> 
														<script type="text/javascript" src="js/dhtmlHistory.js"></script> 
														<script type="text/javascript" src="js/customsignsheader.js"></script>
														<table cellspacing="0" cellpadding="0" width="520" border="0">
															<tbody>
																<tr>
																	<td width="10" valign="top"></td>
																	<td width="520" valign="top"><!-- Admin -->
																		
																		<table width="520" align="center" cellspacing="0" cellpadding="0" border="0">
																			<tbody>
																				<tr>
																					<td align="center"><a href=""><b><font color="#0033FF" size="3"> ข่าวสารความเคลื่อนไหว </font></b></a><b><font color="#0033FF" size="2"> &nbsp;&nbsp;&nbsp;</font></b></td>
																				</tr>
																				<tr>
																					<td height="20" class=""></td>
																				</tr>
																				<tr>
																					<td height="1" class="dotline"></td>
																				</tr>
																				<?php       
																				 $strSQL = "SELECT * FROM " . $gallery->getTbl() . " WHERE status = 'ใช้งาน' LIMIT 0,5"; 
																			
																				  $objQuery = mysql_query($strSQL);
																				  if($db->NumRows($objQuery) > 0) {
																						while ($row = $db->FetchArray($objQuery)) {
                                                                  			?>
																				<tr>
																					<td><table width="100%" cellspacing="2" cellpadding="1">
																							<tbody>
																								<tr>
																									<td width="30%" valign="top"><table>
																											<tbody>
																												<tr>
																													<td width="235" valign="top"><table cellspacing="0" cellpadding="0" border="0">
																															<tbody>
																																<tr>
																																	<td height="14" border="0" background="images/border/TL.gif"></td>
																																	<td height="14" border="0" background="images/border/TT.gif"></td>
																																	<td height="14" border="0" background="images/border/TR.gif"></td>
																																</tr>
																																<tr>
																																	<td width="30" border="0" background="images/border/LL.gif"></td>
																																	<td border="0"><a href="<?php echo ADDRESS_CONTROL . "gallery_content&id=". $row['id']?>"> <img width="200" src="<?php echo ADDRESS_GALLERY . $row['gallery_file_name_cover'];?>"> </a></td>
																																	<td width="14" border="0" background="images/border/RR.gif"></td>
																																</tr>
																																<tr>
																																	<td height="15" border="0" background="images/border/BL.gif"></td>
																																	<td height="15" border="0" background="images/border/BB.gif"></td>
																																	<td height="15" border="0" background="images/border/BR.gif"></td>
																																</tr>
																															</tbody>
																														</table></td>
																													<td valign="top"><font color="#990000"><b><a href="<?php echo ADDRESS_CONTROL . "gallery_content&id=". $row['id']?>"><?php echo $row['gallery_title'] . " ( " . $functions->ShowDateTh($row['activity_date']) . " )";?> <br>
																														&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['short_gallery']?></td>
																												</tr>
																											</tbody>
																										</table></td>
																								</tr>
																							</tbody>
																						</table>
																						<br>
																						<br>
																						<br></td>
																				</tr>
																				<?php }?>
																				<tr>
																					<td colspan="2" align="right"><a href="<?php echo ADDRESS_CONTROL . "gallery"?>"><img src="images/admin/2_15.gif"></a></td>
																				</tr>
																				<?php }?>
																			</tbody>
																		</table></td>
																</tr>
															</tbody>
														</table></td>
													<td background="templates/cli3/images/menu/ict_03.png" width="4" height="100%" alt=""></td>
												</tr>
												<tr>
													<td><img src="templates/cli3/images/menu/ict_04.png" width="5" height="15" alt=""></td>
													<td><img src="templates/cli3/images/menu/ict_05.png" width="100%" height="15" alt=""></td>
													<td><img src="templates/cli3/images/menu/ict_06.png" width="4" height="15" alt=""></td>
												</tr>
											</tbody>
										</table>
										<!--ประชาสัมพัน-->
										<table class="iconframe" cellpadding="0" cellspacing="0" width="530" border="0">
											<tbody>
												<tr>
													<td class="iconframe" width="530"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td width="10" height="10"><img src="images/pic/news-tl.gif"></td>
																	<td height="10" background="images/pic/news-tbg.png"></td>
																	<td width="10" height="10"><img src="images/pic/news-tr.gif"></td>
																</tr>
																<tr>
																	<td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
																	<td width="100%" valign="top"><img src="templates/cli3/images/menu/cli3_news1.png" border="0"><br>
																		<table width="510" cellspacing="0" cellpadding="0" border="0">
																			<tbody>
																	    <?php 
																		    $strSQL = "SELECT * FROM " . $contents->getTbl() . " WHERE status = 'ใช้งาน'" ;
																			 $query = $db->Query($strSQL);
																				if($db->NumRows($query) > 0){
																					while($row = $db->FetchArray($query)){ ?>
																			
																						<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'" style="background-color: rgb(255, 255, 255);">
																							<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="<?php echo ADDRESS_CONTROL . 'news_content&id=' . $row['id'] ?>" target="_parent" name="<?php echo $row['short_contents']?>"><font color="#990066"><b>[ <?php echo $functions->ShowDateTh($row['activity_date'])?> ] </b></font><b><?php echo $row['short_contents']?></b></a></div></td>
																						</tr>
																				<?php }?>
																		<?php }?>
																						
																				<tr>
																					<td colspan="2" align="right"><a href="<?php echo ADDRESS_CONTROL . 'news'?>"><img src="images/admin/2_15.gif"></a></td>
																				</tr>
																			</tbody>
																		</table></td>
																	<td width="10" align="center" height="100%" background="images/pic/news-right.png"></td>
																</tr>
																<tr>
																	<td width="10" height="10"><img src="images/pic/news-bl.gif"></td>
																	<td height="10" background="images/pic/news-bbg.png"></td>
																	<td width="10" height="10"><img src="images/pic/news-br.gif"></td>
																</tr>
															</tbody>
														</table></td>
												</tr>
											</tbody>
										</table>
										
										<!--<center>
											<table class="iconframe" cellpadding="0" cellspacing="0" width="530" border="0">
												<tbody>
													<tr>
														<td class="iconframe" width="530"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
																<tbody>
																	<tr>
																		<td width="10" height="10"><img src="images/pic/news-tl.gif"></td>
																		<td height="10" background="images/pic/news-tbg.png"></td>
																		<td width="10" height="10"><img src="images/pic/news-tr.gif"></td>
																	</tr>
																	<tr>
																		<td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
																		<td width="100%" valign="top"><img src="templates/cli3/images/menu/cli3_news1.png" border="0"><br>
																			<table width="510" cellspacing="0" cellpadding="0" border="0">
																				<tbody>
																					<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'">
																						<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="index2254.html?name=news&amp;file=readnews&amp;id=171" target="_parent" name="แจ้งกำหนดการใหม่ในการรับสมัครและคัดเลือกบุคคลเข้ารับการอบรมหลักสูตรการแพทย์แผนไทยรุ่นที่15ปี58"><font color="#990066"><b>[ 31/ต.ค../2557 ] </b></font><b>แจ้งกำหนดการใหม่ในการรับสมัครและคัดเลือกบุคคลเข้ารับการอบรมหลักสูตรการแพทย์แผนไทยรุ่นที่15ปี58</b></a> ( 155 /  ) โดย admin </div></td>
																					</tr>
																					<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'">
																						<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="index271c.html?name=news&amp;file=readnews&amp;id=170" target="_parent" name="ประกาศรับสมัครคัดเลือกข้าราชการเพื่อรับย้าย โอน ให้ดำรงตำแหน่งประเภทวิชาการ"><font color="#990066"><b>[ 31/ต.ค../2557 ] </b></font><b>ประกาศรับสมัครคัดเลือกข้าราชการเพื่อรับย้าย โอน ให้ดำรงตำแหน่งประเภทวิชาการ</b></a> ( 52 /  ) โดย admin </div></td>
																					</tr>
																					<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'">
																						<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="indexa2cc.html?name=news&amp;file=readnews&amp;id=168" target="_parent" name="หนังสือแจ้งผู้เข้ารับการอบรมแพทย์แผนไทยรุ่นที่ 11 ชำระค่าลงทะเบียน"><font color="#990066"><b>[ 14/ต.ค../2557 ] </b></font><b>หนังสือแจ้งผู้เข้ารับการอบรมแพทย์แผนไทยรุ่นที่ 11 ชำระค่าลงทะเบียน</b></a> ( 119 /  ) โดย admin </div></td>
																					</tr>
																					<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'">
																						<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="index45d6.html?name=news&amp;file=readnews&amp;id=167" target="_parent" name="หนังสือแจ้งการอบรมหลักสูตรแพทย์แผนไทยรุ่นที่ 13"><font color="#990066"><b>[ 14/ต.ค../2557 ] </b></font><b>หนังสือแจ้งการอบรมหลักสูตรแพทย์แผนไทยรุ่นที่ 13</b></a> ( 125 /  ) โดย admin </div></td>
																					</tr>
																					<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'">
																						<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="index01b6.html?name=news&amp;file=readnews&amp;id=166" target="_parent" name="หนังสือแจ้งการอบรมหลักสูตรแพทย์แผนไทยรุ่นที่ 12"><font color="#990066"><b>[ 14/ต.ค../2557 ] </b></font><b>หนังสือแจ้งการอบรมหลักสูตรแพทย์แผนไทยรุ่นที่ 12</b></a> ( 99 /  ) โดย admin </div></td>
																					</tr>
																					<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'">
																						<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="indexfe20.html?name=news&amp;file=readnews&amp;id=164" target="_parent" name="ประชาสัมพันธ์โครงการฝึกอบรมหลักสูตร นักสาธารณสุขชุมชนปฏิบัติการ(นสช.)รุ่นที่ 3"><font color="#990066"><b>[ 26/ก.ย./2557 ] </b></font><b>ประชาสัมพันธ์โครงการฝึกอบรมหลักสูตร นักสาธารณสุขชุมชนปฏิบัติการ(นสช.)รุ่นที่ 3</b></a> ( 271 /  ) โดย admin </div></td>
																					</tr>
																					<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'">
																						<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="indexc6b0.html?name=news&amp;file=readnews&amp;id=163" target="_parent" name="ขอเชิญเข้ารับการอบรมเตรียมความพร้อมสอบขึ้นทะเบียนภาคปฏิบัติแพทย์แผนไทย"><font color="#990066"><b>[ 17/ก.ย./2557 ] </b></font><b>ขอเชิญเข้ารับการอบรมเตรียมความพร้อมสอบขึ้นทะเบียนภาคปฏิบัติแพทย์แผนไทย</b></a> ( 260 /  ) โดย admin </div></td>
																					</tr>
																					<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'">
																						<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="index514c.html?name=news&amp;file=readnews&amp;id=161" target="_parent" name="ขอเชิญเข้าร่วมโครงการ การประชุมวิชาการศิษย์เก่าเรื่องการให้บริการด้วยหัวใจความเป็นมนุษย์"><font color="#990066"><b>[ 2/ก.ย./2557 ] </b></font><b>ขอเชิญเข้าร่วมโครงการ การประชุมวิชาการศิษย์เก่าเรื่องการให้บริการด้วยหัวใจความเป็นมนุษย์</b></a> ( 799 /  ) โดย admin </div></td>
																					</tr>
																					<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'">
																						<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="indexca83.html?name=news&amp;file=readnews&amp;id=160" target="_parent" name="การอบรมหลักสูตรการแพทย์แผนไทยรุ่นที่ 15"><font color="#990066"><b>[ 28/ส.ค./2557 ] </b></font><b>การอบรมหลักสูตรการแพทย์แผนไทยรุ่นที่ 15</b></a> ( 974 /  ) โดย admin </div></td>
																					</tr>
																					<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#FFFFFF'">
																						<td valign="top" height="20" align="left"><div class=""> <img src="images/17.png" border="0" align="absmiddle"> <a href="index96bd.html?name=news&amp;file=readnews&amp;id=159" target="_parent" name="การอบรมหลักสูตรแพทย์แผนไทยรุ่นที่ 13"><font color="#990066"><b>[ 28/ส.ค./2557 ] </b></font><b>การอบรมหลักสูตรแพทย์แผนไทยรุ่นที่ 13</b></a> ( 263 /  ) โดย admin </div></td>
																					</tr>
																					<tr>
																						<td colspan="2" align="right"><a href="index60b8.html?name=news&amp;category=1"><img src="images/admin/2_15.gif"></a></td>
																					</tr>
																				</tbody>
																			</table></td>
																		<td width="10" align="center" height="100%" background="images/pic/news-right.png"></td>
																	</tr>
																	<tr>
																		<td width="10" height="10"><img src="images/pic/news-bl.gif"></td>
																		<td height="10" background="images/pic/news-bbg.png"></td>
																		<td width="10" height="10"><img src="images/pic/news-br.gif"></td>
																	</tr>
																</tbody>
															</table></td>
													</tr>
												</tbody>
											</table>
										</center>--> 
									</div></td>
							</tr>
						</tbody>
					</table>
					<br>
					<table cellspacing="0" cellpadding="0" width="100%">
						<tbody>
							<tr>
								<td><div>
									<center>
									<div> 
										
										<!--<center>
												<table id="Table_01" width="530" border="0" cellpadding="0" cellspacing="0">
													<tbody>
														<tr>
															<td colspan="3" class="titlecenter" background="templates/cli3/images/menu/center.png" width="530" height="39" alt=""></td>
														</tr>
														<tr>
															<td background="templates/cli3/images/menu/ict_02.png" width="5" height="100%" alt=""></td>
															<td width="521"> ﻿
																<link rel="stylesheet" href="css/backbox.css" type="text/css">
																<script type="text/javascript" src="js/prototype.compressed.js"></script> 
																<script type="text/javascript" src="js/scriptaculous9f06.js?load=effects"></script> 
																<script type="text/javascript" src="js/lightbox.js"></script> 
																<script type="text/javascript" src="js/dhtmlHistory.js"></script> 
																<script type="text/javascript" src="js/customsignsheader.js"></script>
																<table cellspacing="0" cellpadding="0" width="520" border="0">
																	<tbody>
																		<tr>
																			<td width="10" valign="top"></td>
																			<td width="520" valign="top"><br>
																				
																				<!-- Admin 
																				&nbsp;&nbsp;<img src="images/menu/textmenu_gallery.gif" border="0"><br>
																			<!--	<table width="520" align="center" cellspacing="0" cellpadding="0" border="0">
																					<tbody>
																						<tr>
																							<td><a href="index5114-2.html?name=gallery"><img src="images/admin/open.gif" border="0" align="absmiddle"><b><font color="#0033FF" size="2"> รายการ Gallery หน้าหลัก</font></b></a><b><font color="#0033FF" size="2"> &nbsp;&nbsp;&nbsp;</font></b></td>
																						</tr>
																						<tr>
																							<td height="1" class="dotline"></td>
																						</tr>
																						<tr>
																							<td><table width="100%" cellspacing="2" cellpadding="1">
																									<tbody>
																										<tr>
																											<td width="30%" valign="top"><table>
																													<tbody>
																														<tr>
																															<td width="235" valign="top"><table cellspacing="0" cellpadding="0" border="0">
																																	<tbody>
																																		<tr>
																																			<td height="14" border="0" background="images/border/TL.gif"></td>
																																			<td height="14" border="0" background="images/border/TT.gif"></td>
																																			<td height="14" border="0" background="images/border/TR.gif"></td>
																																		</tr>
																																		<tr>
																																			<td width="30" border="0" background="images/border/LL.gif"></td>
																																			<td border="0"><a href="index5f6c-2.html?name=gallery&amp;op=gallery_detail&amp;id=160"> <img width="200" src="images/gallery/gal_1414747773/thb_DSC06963.jpg"> </a></td>
																																			<td width="14" border="0" background="images/border/RR.gif"></td>
																																		</tr>
																																		<tr>
																																			<td height="15" border="0" background="images/border/BL.gif"></td>
																																			<td height="15" border="0" background="images/border/BB.gif"></td>
																																			<td height="15" border="0" background="images/border/BR.gif"></td>
																																		</tr>
																																	</tbody>
																																</table></td>
																															<td valign="top"><font color="#990000"><b><a href="index5f6c-2.html?name=gallery&amp;op=gallery_detail&amp;id=160">โครงการฝึกอบรมหลักสูตรนักสาธารณสุขชุมชนปฏิบัติการ(นสช.)รุ่นที่ 3</a></b></font> ( 31/ต.ค../2557 ) <br>
																																&nbsp;&nbsp;&nbsp;&nbsp;เมื่อวันที่ 30 ตุลาคม 2557&nbsp;<span style="color: rgb(20, 24, 35); font-family: Helvetica, Arial, 'lucida grande', tahoma, verdana, arial, sans-serif; font-size: 16px; line-height: 22.079999923706055px;">ทพ.สันติ ศิริวัฒนไพศาล รองผู้อำนวยการ สปสช. เขต2 พิษณุโลก เป็นประธานเปิดการอบรมหลักสูตร</span>นักสาธารณสุขชุมชนปฏิบัติการ(นสช.)รุ่นที่ 3 ณ วิทยาลัยการสาธารณสุขสิรินธร จังหวัดพิษณุโลก และให้เกียรติบรรยายในหัวข้อ&nbsp;บทบาทของ สปสช.ในการพัฒนาหลักประกันสุขภาพของประชาชน</td>
																														</tr>
																													</tbody>
																												</table></td>
																										</tr>
																										<tr>
																											<td colspan="2" height="1" class="dotline"></td>
																										</tr>
																										<tr>
																											<td width="30%" valign="top"><table>
																													<tbody>
																														<tr>
																															<td width="235" valign="top"><table cellspacing="0" cellpadding="0" border="0">
																																	<tbody>
																																		<tr>
																																			<td height="14" border="0" background="images/border/TL.gif"></td>
																																			<td height="14" border="0" background="images/border/TT.gif"></td>
																																			<td height="14" border="0" background="images/border/TR.gif"></td>
																																		</tr>
																																		<tr>
																																			<td width="30" border="0" background="images/border/LL.gif"></td>
																																			<td border="0"><a href="index617e-2.html?name=gallery&amp;op=gallery_detail&amp;id=159"> <img width="200" src="images/gallery/gal_1414551775/thb_DSC06834.jpg"> </a></td>
																																			<td width="14" border="0" background="images/border/RR.gif"></td>
																																		</tr>
																																		<tr>
																																			<td height="15" border="0" background="images/border/BL.gif"></td>
																																			<td height="15" border="0" background="images/border/BB.gif"></td>
																																			<td height="15" border="0" background="images/border/BR.gif"></td>
																																		</tr>
																																	</tbody>
																																</table></td>
																															<td valign="top"><font color="#990000"><b><a href="index617e-2.html?name=gallery&amp;op=gallery_detail&amp;id=159">นักศึกษาเข้ารับการตรวจสุขภาพประจำปี 2557</a></b></font> ( 29/ต.ค../2557 ) <br>
																																&nbsp;&nbsp;&nbsp;&nbsp;
																																<div> กลุ่มงานกิจการนักศึกษา วิทยาลัยการสาธารณสุขสิรินธร จังหวัดพิษณุโลก จัดให้มีการตรวจสุขภาพนักศึกษาประจำปี 2557 ทุกหลักสูตรและทุกชั้นปี โดยแบ่งนักศึกษาเข้ารับการตรวจจำนวน 2 วันคือวันที่ 22 ตุลาคม และวันที่ 5 พฤศจิกายน 257 เนื่องจากวิิทยาลัยได้เล็งเห็นความสำคัญของปัญหาสุขภาพ ซึ่งอาจก่อให้เกิดผลกระทบต่อตัวนักศึกษาเองทั้งทางตรงและทางอ้อม การตรวจสุขภาพพื้นฐานเป็นการส่งเสริมและป้องกันการเจ็บป่วยและเป็นการค้นหาความผิดปกติเบื้องต้นก่อนเกิดการเจ็บป่วยที่รุนแรงของนักศึกษาได้</div></td>
																														</tr>
																													</tbody>
																												</table></td>
																										</tr>
																										<tr>
																											<td colspan="2" height="1" class="dotline"></td>
																										</tr>
																										<tr>
																											<td width="30%" valign="top"><table>
																													<tbody>
																														<tr>
																															<td width="235" valign="top"><table cellspacing="0" cellpadding="0" border="0">
																																	<tbody>
																																		<tr>
																																			<td height="14" border="0" background="images/border/TL.gif"></td>
																																			<td height="14" border="0" background="images/border/TT.gif"></td>
																																			<td height="14" border="0" background="images/border/TR.gif"></td>
																																		</tr>
																																		<tr>
																																			<td width="30" border="0" background="images/border/LL.gif"></td>
																																			<td border="0"><a href="index4925-2.html?name=gallery&amp;op=gallery_detail&amp;id=158"> <img width="200" src="images/gallery/gal_1414550928/thb_DSC06746.jpg"> </a></td>
																																			<td width="14" border="0" background="images/border/RR.gif"></td>
																																		</tr>
																																		<tr>
																																			<td height="15" border="0" background="images/border/BL.gif"></td>
																																			<td height="15" border="0" background="images/border/BB.gif"></td>
																																			<td height="15" border="0" background="images/border/BR.gif"></td>
																																		</tr>
																																	</tbody>
																																</table></td>
																															<td valign="top"><font color="#990000"><b><a href="index4925-2.html?name=gallery&amp;op=gallery_detail&amp;id=158">โครงการทันตกรรมเฉลิมพระเกียรติสมเด็จย่าและวันทันตสาธารณสุขแห่งชาติ</a></b></font> ( 29/ต.ค../2557 ) <br>
																																&nbsp;&nbsp;&nbsp;&nbsp;เมื่อวันที่ 21 ตุลาคม 2557 ภาควิชาทันตสาธารณสุข จัดโครงการทันตกรรมเฉลิมพระเกียรติสมเด็จย่าและวันทันตสาธารณสุขแห่งชาติ มีการให้บริการตรวจฟัน ขูดหินปูน ถอนฟัน และอุดฟันฟรี ระหว่างเวลา 8.30-16.00 น. ณ คลินิกปฏิบัติการทันตกรรม วิทยาลัยการสาธารณสุขสิรินธร จังหวัดพิษณุโลก ซึ่งโครงการดังกล่าวได้รับความสนใจส่งผลให้มีผู้มาใช้บริการเป็นจำนวนมาก</td>
																														</tr>
																													</tbody>
																												</table></td>
																										</tr>
																										<tr>
																											<td colspan="2" height="1" class="dotline"></td>
																										</tr>
																										<tr>
																											<td width="30%" valign="top"><table>
																													<tbody>
																														<tr>
																															<td width="235" valign="top"><table cellspacing="0" cellpadding="0" border="0">
																																	<tbody>
																																		<tr>
																																			<td height="14" border="0" background="images/border/TL.gif"></td>
																																			<td height="14" border="0" background="images/border/TT.gif"></td>
																																			<td height="14" border="0" background="images/border/TR.gif"></td>
																																		</tr>
																																		<tr>
																																			<td width="30" border="0" background="images/border/LL.gif"></td>
																																			<td border="0"><a href="index8f24-2.html?name=gallery&amp;op=gallery_detail&amp;id=157"> <img width="200" src="images/gallery/gal_1414549810/thb_DSC06664.jpg"> </a></td>
																																			<td width="14" border="0" background="images/border/RR.gif"></td>
																																		</tr>
																																		<tr>
																																			<td height="15" border="0" background="images/border/BL.gif"></td>
																																			<td height="15" border="0" background="images/border/BB.gif"></td>
																																			<td height="15" border="0" background="images/border/BR.gif"></td>
																																		</tr>
																																	</tbody>
																																</table></td>
																															<td valign="top"><font color="#990000"><b><a href="index8f24-2.html?name=gallery&amp;op=gallery_detail&amp;id=157">รับการตรวจประเมินการประกันคุณภาพการศึกษาภายในประจำปีการศึกษา 2556</a></b></font> ( 29/ต.ค../2557 ) <br>
																																&nbsp;&nbsp;&nbsp;&nbsp;เมื่อวันที่ 12-14 ตุลาคม 2557 วิทยาลัยการสาธารณสุขสิรินธร จังหวัดพิษณุโลก รับการตรวจประเมินคุณภาพการศึกษาภายในประจำปีการศึกษา 2556 จากคณะกรรมการประเมินคุณภาพภายในของสถาบันพระบรมราชชนก โดยมีอาจารย์วิภา เพ็งเสงี่ยม เป็นประธานคณะกรรมการประเมิน และนางเพชรีย์ กุลณาสิริ รองผู้อำนวยการด้านวิชาการ รักษาการผู้อำนวยการวิทยาลัยกล่าวต้อนรับและเสนอความพร้อมในการตรวจประเมิน</td>
																														</tr>
																													</tbody>
																												</table></td>
																										</tr>
																										<tr>
																											<td colspan="2" height="1" class="dotline"></td>
																										</tr>
																										<tr>
																											<td width="30%" valign="top"><table>
																													<tbody>
																														<tr>
																															<td width="235" valign="top"><table cellspacing="0" cellpadding="0" border="0">
																																	<tbody>
																																		<tr>
																																			<td height="14" border="0" background="images/border/TL.gif"></td>
																																			<td height="14" border="0" background="images/border/TT.gif"></td>
																																			<td height="14" border="0" background="images/border/TR.gif"></td>
																																		</tr>
																																		<tr>
																																			<td width="30" border="0" background="images/border/LL.gif"></td>
																																			<td border="0"><a href="index5e68-2.html?name=gallery&amp;op=gallery_detail&amp;id=156"> <img width="200" src="images/gallery/gal_1414476393/thb_DSC06520.jpg"> </a></td>
																																			<td width="14" border="0" background="images/border/RR.gif"></td>
																																		</tr>
																																		<tr>
																																			<td height="15" border="0" background="images/border/BL.gif"></td>
																																			<td height="15" border="0" background="images/border/BB.gif"></td>
																																			<td height="15" border="0" background="images/border/BR.gif"></td>
																																		</tr>
																																	</tbody>
																																</table></td>
																															<td valign="top"><font color="#990000"><b><a href="index5e68-2.html?name=gallery&amp;op=gallery_detail&amp;id=156">กัลพฤกษ์รวมใจบริจาคโลหิต</a></b></font> ( 28/ต.ค../2557 ) <br>
																																&nbsp;&nbsp;&nbsp;&nbsp;เมื่อวันที่ 8 ตุลาคม 2557 อาจารย์ นักศึกษา และเจ้าหน้าที่ ร่วมกันบริจาคโลหิตในโครงการกัลพฤกษ์รวมใจบริจาคโลหิต ณ หอประชุมอาคารอเนกประสงค์ วิทยาลัยการสาธารณสุขสิรินธร จังหวัดพิษณุโลก การบำเพ็ญประโยชน์ในครั้งนี้ แสดงว่าทุกคนมีจิตใจเป็นกุศลถือตนว่าเป็นเพื่อน เกิดแก่เจ็บ ตายด้วยกันมีหน้าที่ที่จะอนุเคราะห์กันและกัน เพราะฉะนั้นผู้บริจาคโลหิตทุกท่านจึงถือเป็นผู้ที่เสียสละควรแก่การยกย่องและสรรเสริญ</td>
																														</tr>
																													</tbody>
																												</table></td>
																										</tr>
																										<tr>
																											<td colspan="2" height="1" class="dotline"></td>
																										</tr>
																									</tbody>
																								</table>
																								[จำนวน  158 อัลบัม]<br>
																								<br>
																								<br></td>
																						</tr>
																					</tbody>
																				</table></td>
																		</tr>
																	</tbody>
																</table></td>
															<td background="templates/cli3/images/menu/ict_03.png" width="4" height="100%" alt=""></td>
														</tr>
														<tr>
															<td><img src="templates/cli3/images/menu/ict_04.png" width="5" height="15" alt=""></td>
															<td><img src="templates/cli3/images/menu/ict_05.png" width="100%" height="15" alt=""></td>
															<td><img src="templates/cli3/images/menu/ict_06.png" width="4" height="15" alt=""></td>
														</tr>
													</tbody>
												</table> --> 
										<!--<center>
													<table id="Table_01" width="530" border="0" cellpadding="0" cellspacing="0">
														<tbody>
															<tr>
																<td colspan="3" class="titlecenter" background="templates/cli3/images/menu/center.png" width="530" height="39" alt="">ข่าวเผยแพร่ บริการวิชาการ</td>
															</tr>
															<tr>
																<td background="templates/cli3/images/menu/ict_02.png" width="5" height="100%" alt=""></td>
																<td width="521"> ﻿
																	<table width="521" cellpadding="0" cellspacing="0">
																		<tbody>
																			<tr>
																				<td><table width="100%" cellpadding="5" cellspacing="0" border="0">
																						<tbody>
																							<tr>
																								<td><table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="grids">
																										<tbody>
																											<tr class="odd">
																												<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="indexa6c6-2.html?name=news&amp;file=readnews&amp;id=79" target="_parent"><font color="#990066"><b>[ 29/พ.ค./2556 ] </b></font><b><font color="#0066FF">รายงานการประเมินคุณภาพการศึกษาระดับเครือข่าย วิทยาลัยเครือข่ายภาคเหนือ</font></b></a> ( 861 /  ) โดย admin </td>
																											</tr>
																											<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																												<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index66d4-2.html?name=news&amp;file=readnews&amp;id=78" target="_parent"><font color="#990066"><b>[ 29/พ.ค./2556 ] </b></font><b><font color="#0066FF">สมศ.รายงานผลการประเมินผลการประเมินคุณภาพภายนอกรอบสาม สถาบันอุดมศึกษา</font></b></a> ( 445 /  ) โดย admin </td>
																											</tr>
																											<tr class="odd">
																												<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index6532-2.html?name=news&amp;file=readnews&amp;id=77" target="_parent"><font color="#990066"><b>[ 29/พ.ค./2556 ] </b></font><b><font color="#0066FF">หนังสือสำคัญจากสมศ.เพื่อแสดงว่าวิทยาลัยได้รับรองมาตรฐานการศึกษารอบ 3 (พ.ศ.2554-พ.ศ.2558)</font></b></a> ( 941 /  ) โดย admin </td>
																											</tr>
																											<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																												<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index2c2a-2.html?name=news&amp;file=readnews&amp;id=50" target="_parent"><font color="#990066"><b>[ 19/เม.ย./2556 ] </b></font><b><font color="#0066FF">โครงการส่งเสริมสุขภาพแบบแผนไทยด้วยการนวดเท้า ปีการศึกษา 2555</font></b></a> ( 692 /  ) โดย admin </td>
																											</tr>
																											<tr class="odd">
																												<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index2f28-2.html?name=news&amp;file=readnews&amp;id=40" target="_parent"><font color="#990066"><b>[ 27/ก.พ./2556 ] </b></font><b><font color="#0066FF">โครงการบูรณาการบริการวิชาการแก่สังคมกับการเรียนการสอนรายวิชาการนวดไทย ๒  และการนวดไทย ๓ ปีการศึกษา ๒๕๕๕</font></b></a> ( 585 /  ) โดย admin </td>
																											</tr>
																										</tbody>
																									</table></td>
																								<td></td>
																							</tr>
																							<tr>
																								<td align="right"><a href="index4d55.html?name=news&amp;category=3"><img src="images/admin/2_15.gif"></a></td>
																							</tr>
																						</tbody>
																					</table></td>
																			</tr>
																		</tbody>
																	</table></td>
																<td background="templates/cli3/images/menu/ict_03.png" width="4" height="100%" alt=""></td>
															</tr>
															<tr>
																<td><img src="templates/cli3/images/menu/ict_04.png" width="5" height="15" alt=""></td>
																<td><img src="templates/cli3/images/menu/ict_05.png" width="100%" height="15" alt=""></td>
																<td><img src="templates/cli3/images/menu/ict_06.png" width="4" height="15" alt=""></td>
															</tr>
														</tbody>
													</table>--> 
										<!--<center>
														<table id="Table_01" width="530" border="0" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td colspan="3" class="titlecenter" background="templates/cli3/images/menu/center.png" width="530" height="39" alt="">ข่าวอาจารย์-เจ้าหน้าที่</td>
																</tr>
																<tr>
																	<td background="templates/cli3/images/menu/ict_02.png" width="5" height="100%" alt=""></td>
																	<td width="521"> ﻿
																		<table width="521" cellpadding="0" cellspacing="0">
																			<tbody>
																				<tr>
																					<td><table width="100%" cellpadding="5" cellspacing="0" border="0">
																							<tbody>
																								<tr>
																									<td><table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="grids">
																											<tbody>
																												<tr class="odd">
																													<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index01d6-2.html?name=news&amp;file=readnews&amp;id=157" target="_parent"><font color="#990066"><b>[ 1/ส.ค./2557 ] </b></font><b><font color="#0066FF">ข้อมูลการจัดการเรียนการสอน ปีการศึกษา 2557</font></b></a> ( 400 /  ) โดย admin </td>
																												</tr>
																												<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																													<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index2d36-2.html?name=news&amp;file=readnews&amp;id=95" target="_parent"><font color="#990066"><b>[ 28/มิ.ย./2556 ] </b></font><b><font color="#0066FF">ข้อมูลการจัดการเรียนการสอนปีการศึกษา 2556</font></b></a> ( 4076 /  ) โดย admin </td>
																												</tr>
																												<tr class="odd">
																													<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index4ccf-2.html?name=news&amp;file=readnews&amp;id=91" target="_parent"><font color="#990066"><b>[ 8/มิ.ย./2556 ] </b></font><b><font color="#0066FF">การจัดอาจารย์ผู้สอนปีการศึกษา 2556</font></b></a> ( 969 /  ) โดย admin </td>
																												</tr>
																												<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																													<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index8168-2.html?name=news&amp;file=readnews&amp;id=55" target="_parent"><font color="#990066"><b>[ 26/เม.ย./2556 ] </b></font><b><font color="#0066FF">เชิญตรวจสุขภาพประจำปี 2556 วันที่ 26 เมษายน 2556</font></b></a> ( 716 /  ) โดย admin </td>
																												</tr>
																												<tr class="odd">
																													<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index6476-2.html?name=news&amp;file=readnews&amp;id=14" target="_parent"><font color="#990066"><b>[ 15/พ.ย./2555 ] </b></font><b><font color="#0066FF">ขอเชิญคณะกรรมการประกันคุณภาพการศึกษาประชุม 27 พ.ย.55</font></b></a> ( 816 /  ) โดย admin </td>
																												</tr>
																												<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																													<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index889a-2.html?name=news&amp;file=readnews&amp;id=13" target="_parent"><font color="#990066"><b>[ 12/พ.ย./2555 ] </b></font><b><font color="#0066FF">ขอเชิญประชุมประจำเดือน วันที่ 28 พ.ย.55</font></b></a> ( 760 /  ) โดย admin </td>
																												</tr>
																											</tbody>
																										</table></td>
																									<td></td>
																								</tr>
																								<tr>
																									<td align="right"><a href="index512a.html?name=news&amp;category=4"><img src="images/admin/2_15.gif"></a></td>
																								</tr>
																							</tbody>
																						</table></td>
																				</tr>
																			</tbody>
																		</table></td>
																	<td background="templates/cli3/images/menu/ict_03.png" width="4" height="100%" alt=""></td>
																</tr>
																<tr>
																	<td><img src="templates/cli3/images/menu/ict_04.png" width="5" height="15" alt=""></td>
																	<td><img src="templates/cli3/images/menu/ict_05.png" width="100%" height="15" alt=""></td>
																	<td><img src="templates/cli3/images/menu/ict_06.png" width="4" height="15" alt=""></td>
																</tr>
															</tbody>
														</table>--> 
										<!--<center>
															<table id="Table_01" width="530" border="0" cellpadding="0" cellspacing="0">
																<tbody>
																	<tr>
																		<td colspan="3" class="titlecenter" background="templates/cli3/images/menu/center.png" width="530" height="39" alt="">ข่าวนักศึกษา</td>
																	</tr>
																	<tr>
																		<td background="templates/cli3/images/menu/ict_02.png" width="5" height="100%" alt=""></td>
																		<td width="521"> ﻿
																			<table width="521" cellpadding="0" cellspacing="0">
																				<tbody>
																					<tr>
																						<td><table width="100%" cellpadding="5" cellspacing="0" border="0">
																								<tbody>
																									<tr>
																										<td><table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="grids">
																												<tbody>
																													<tr class="odd">
																														<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index534f-2.html?name=news&amp;file=readnews&amp;id=156" target="_parent"><font color="#990066"><b>[ 29/ก.ค./2557 ] </b></font><b><font color="#0066FF">กำหนดการรับนักศึกษาใหม่ (เข้าหอพักและปฐมนิทศ) ๔-๑๕ สิงหาคม  ๒๕๕๗ </font></b></a> ( 916 /  ) โดย admin </td>
																													</tr>
																													<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																														<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index903f-2.html?name=news&amp;file=readnews&amp;id=154" target="_parent"><font color="#990066"><b>[ 18/ก.ค./2557 ] </b></font><b><font color="#0066FF">คำแนะนำสำหรับนักศึกษาใหม่ปีการศึกษา 2557 วิทยาลัยการสาธารณสุขสิรินธร จังหวัดพิษณุโลก</font></b></a> ( 4583 /  ) โดย admin </td>
																													</tr>
																													<tr class="odd">
																														<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index599a-2.html?name=news&amp;file=readnews&amp;id=153" target="_parent"><font color="#990066"><b>[ 18/ก.ค./2557 ] </b></font><b><font color="#0066FF">ปฏิทินการจัดการเรียนการสอนปีการศึกษา 2557 วิทยาลัยการสาธารณสุขสิรินธร จังหวัดพิษณุโลก</font></b></a> ( 2587 /  ) โดย admin </td>
																													</tr>
																													<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																														<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="indexec08-2.html?name=news&amp;file=readnews&amp;id=140" target="_parent"><font color="#990066"><b>[ 8/พ.ค./2557 ] </b></font><b><font color="#0066FF">กำหนดการให้กู้ยืมกองทุนเงินให้กู้ยืมเพื่อการศึกษาประจำปีการศึกษา  2557 ภาคเรียนที่ 1 </font></b></a> ( 812 /  ) โดย admin </td>
																													</tr>
																													<tr class="odd">
																														<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index046e-2.html?name=news&amp;file=readnews&amp;id=111" target="_parent"><font color="#990066"><b>[ 11/ต.ค../2556 ] </b></font><b><font color="#0066FF">ตารางสอบปลายภาคการศึกษา 1/2556 ของนักศึกษาทุกหลักสูตร</font></b></a> ( 1132 /  ) โดย admin </td>
																													</tr>
																													<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																														<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="indexdf9c-2.html?name=news&amp;file=readnews&amp;id=102" target="_parent"><font color="#990066"><b>[ 30/ส.ค./2556 ] </b></font><b><font color="#0066FF">ตารางสอบภาคการศึกษาที่1/2556</font></b></a> ( 650 /  ) โดย admin </td>
																													</tr>
																													<tr class="odd">
																														<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index3d85-2.html?name=news&amp;file=readnews&amp;id=97" target="_parent"><font color="#990066"><b>[ 11/ก.ค./2556 ] </b></font><b><font color="#0066FF">ตารางการเรียนการสอนภาคการศึกษาที่1/2556 (ฉบับปรับปรุง)</font></b></a> ( 717 /  ) โดย admin </td>
																													</tr>
																													<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																														<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="indexac67-2.html?name=news&amp;file=readnews&amp;id=46" target="_parent"><font color="#990066"><b>[ 7/เม.ย./2556 ] </b></font><b><font color="#0066FF">11-17 เมษายน 56 แจ้งปิดระบบเครือข่ายอินเตอร์เน็ตและเครื่องแม่ข่ายฐานข้อมูล</font></b></a> ( 536 /  ) โดย admin </td>
																													</tr>
																												</tbody>
																											</table></td>
																										<td></td>
																									</tr>
																									<tr>
																										<td align="right"><a href="index1724.html?name=news&amp;category=6"><img src="images/admin/2_15.gif"></a></td>
																									</tr>
																								</tbody>
																							</table></td>
																					</tr>
																				</tbody>
																			</table></td>
																		<td background="templates/cli3/images/menu/ict_03.png" width="4" height="100%" alt=""></td>
																	</tr>
																	<tr>
																		<td><img src="templates/cli3/images/menu/ict_04.png" width="5" height="15" alt=""></td>
																		<td><img src="templates/cli3/images/menu/ict_05.png" width="100%" height="15" alt=""></td>
																		<td><img src="templates/cli3/images/menu/ict_06.png" width="4" height="15" alt=""></td>
																	</tr>
																</tbody>
															</table>--> 
										
										<!--<center>
																	<table id="Table_01" width="530" border="0" cellpadding="0" cellspacing="0">
																		<tbody>
																			<tr>
																				<td colspan="3" class="titlecenter" background="templates/cli3/images/menu/center.png" width="530" height="39" alt="">ข่าวการจัดซื้อจัดจ้าง</td>
																			</tr>
																			<tr>
																				<td background="templates/cli3/images/menu/ict_02.png" width="5" height="100%" alt=""></td>
																				<td width="521"> ﻿
																					<table width="521" cellpadding="0" cellspacing="0">
																						<tbody>
																							<tr>
																								<td><table width="100%" cellpadding="5" cellspacing="0" border="0">
																										<tbody>
																											<tr>
																												<td><table width="100%" align="center" cellspacing="0" cellpadding="0" border="0" class="grids">
																														<tbody>
																															<tr class="odd">
																																<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="indexb6fd-2.html?name=news&amp;file=readnews&amp;id=162" target="_parent"><font color="#990066"><b>[ 11/ก.ย./2557 ] </b></font><b><font color="#0066FF">ประกาศสอบราคาจ้างเหมาทำความสะอาดอาคาร</font></b></a> ( 67 /  ) โดย Phatsadu </td>
																															</tr>
																															<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																																<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="indexc858-2.html?name=news&amp;file=readnews&amp;id=158" target="_parent"><font color="#990066"><b>[ 25/ส.ค./2557 ] </b></font><b><font color="#0066FF">สอบราคาจ้างเหมาทำความสะอาดอาคาร</font></b></a> ( 122 /  ) โดย phatsadu </td>
																															</tr>
																															<tr class="odd">
																																<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index4d8a-2.html?name=news&amp;file=readnews&amp;id=147" target="_parent"><font color="#990066"><b>[ 27/มิ.ย./2557 ] </b></font><b><font color="#0066FF">ประกาศสอบราคาซื้อครุภัณฑ์วิทยาศาสตร์หรือการแพทย์</font></b></a> ( 181 /  ) โดย phatsadu </td>
																															</tr>
																															<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																																<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="indexe4eb-2.html?name=news&amp;file=readnews&amp;id=141" target="_parent"><font color="#990066"><b>[ 14/พ.ค./2557 ] </b></font><b><font color="#0066FF">สอบราคาจ้างเหมาก่อสร้างอาคารเอนกประสงค์</font></b></a> ( 353 /  ) โดย phatsadu </td>
																															</tr>
																															<tr class="odd">
																																<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index07e9-2.html?name=news&amp;file=readnews&amp;id=112" target="_parent"><font color="#990066"><b>[ 22/ต.ค../2556 ] </b></font><b><font color="#0066FF">สอบราคาซื้อครุภัณฑ์ยานพาหนะและขนส่ง</font></b></a> ( 481 /  ) โดย phatsadu </td>
																															</tr>
																															<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																																<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="indexbab5-2.html?name=news&amp;file=readnews&amp;id=108" target="_parent"><font color="#990066"><b>[ 10/ก.ย./2556 ] </b></font><b><font color="#0066FF">สอบราคาเช่าใช้บริการอินเทอร์เน็ต</font></b></a> ( 670 /  ) โดย phatsadu </td>
																															</tr>
																															<tr class="odd">
																																<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="indexa619-2.html?name=news&amp;file=readnews&amp;id=107" target="_parent"><font color="#990066"><b>[ 10/ก.ย./2556 ] </b></font><b><font color="#0066FF">สอบราคาจ้างเหมาจัดทำเครือข่ายคอมพิวเตอร์และอินเทอร์เน็ต</font></b></a> ( 436 /  ) โดย phatsadu </td>
																															</tr>
																															<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																																<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index8a33-2.html?name=news&amp;file=readnews&amp;id=106" target="_parent"><font color="#990066"><b>[ 6/ก.ย./2556 ] </b></font><b><font color="#0066FF">สอบราคาซื้อครุภัณฑ์โฆษณาและเผยแพร่</font></b></a> ( 1430 /  ) โดย admin </td>
																															</tr>
																															<tr class="odd">
																																<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index231e-2.html?name=news&amp;file=readnews&amp;id=105" target="_parent"><font color="#990066"><b>[ 4/ก.ย./2556 ] </b></font><b><font color="#0066FF">ประกาศสอบราคาจ้างเหมาทำความสะอาด</font></b></a> ( 592 /  ) โดย phatsadu </td>
																															</tr>
																															<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																																<td width="100%" align="left"><img src="images/icon_folder.gif" border="0" align="absmiddle"> <a href="index0952-2.html?name=news&amp;file=readnews&amp;id=104" target="_parent"><font color="#990066"><b>[ 4/ก.ย./2556 ] </b></font><b><font color="#0066FF">สอบราคาซื้อครุภัณฑ์คอมพิวเตอร์ </font></b></a> ( 491 /  ) โดย phatsadu </td>
																															</tr>
																														</tbody>
																													</table></td>
																												<td></td>
																											</tr>
																											<tr>
																												<td align="right"><a href="index878a.html?name=news&amp;category=5"><img src="images/admin/2_15.gif"></a></td>
																											</tr>
																										</tbody>
																									</table></td>
																							</tr>
																						</tbody>
																					</table></td>
																				<td background="templates/cli3/images/menu/ict_03.png" width="4" height="100%" alt=""></td>
																			</tr>
																			<tr>
																				<td><img src="templates/cli3/images/menu/ict_04.png" width="5" height="15" alt=""></td>
																				<td><img src="templates/cli3/images/menu/ict_05.png" width="100%" height="15" alt=""></td>
																				<td><img src="templates/cli3/images/menu/ict_06.png" width="4" height="15" alt=""></td>
																			</tr>
																		</tbody>
																	</table>--> 
										<!--<center>
																		<table id="Table_01" width="530" border="0" cellpadding="0" cellspacing="0">
																			<tbody>
																				<tr>
																					<td colspan="3" class="titlecenter" background="templates/cli3/images/menu/center.png" width="530" height="39" alt="">ดาวน์โหลดเอกสาร</td>
																				</tr>
																				<tr>
																					<td background="templates/cli3/images/menu/ict_02.png" width="5" height="100%" alt=""></td>
																					<td width="521"><table width="521" align="center" cellspacing="0" cellpadding="0" border="0">
																							<tbody>
																								<tr>
																									<td><table width="100%" cellspacing="0" cellpadding="5">
																											<tbody>
																												<tr>
																													<td><table width="100%" cellspacing="0" cellpadding="0" class="grids">
																															<tbody>
																																<tr class="odd">
																																	<td width="100%" align="left"><img src="images/admin/open.gif" border="0" align="absmiddle"><a href="indexbe15-2.html?name=download&amp;file=readdownload&amp;id=20"><font color="#990066"><b>[ 2/ต.ค../2557 ] </b></font><b><font color="#0066FF">power pointเรื่องมนุษย์สัมพันธ์อาจารย์สุจิตรา</font></b></a> (อ่าน : 39 / ดาวน์โหลด : 0 ) โดย admin </td>
																																</tr>
																																<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																																	<td width="100%" align="left"><img src="images/admin/open.gif" border="0" align="absmiddle"><a href="index575a-2.html?name=download&amp;file=readdownload&amp;id=19"><font color="#990066"><b>[ 2/ต.ค../2557 ] </b></font><b><font color="#0066FF">powerpointจิตวิทยาการบริการอาจารย์สุจิตรา</font></b></a> (อ่าน : 45 / ดาวน์โหลด : 0 ) โดย admin </td>
																																</tr>
																																<tr class="odd">
																																	<td width="100%" align="left"><img src="images/admin/open.gif" border="0" align="absmiddle"><a href="index8077-2.html?name=download&amp;file=readdownload&amp;id=18"><font color="#990066"><b>[ 8/พ.ค./2556 ] </b></font><b><font color="#0066FF">แบบฟอร์มการเก็บ case นวด ของผู้อบรมแพทย์แผนไทยรุ่นที่ 11</font></b></a> (อ่าน : 1269 / ดาวน์โหลด : 0 ) โดย admin </td>
																																</tr>
																																<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																																	<td width="100%" align="left"><img src="images/admin/open.gif" border="0" align="absmiddle"><a href="index2480-2.html?name=download&amp;file=readdownload&amp;id=17"><font color="#990066"><b>[ 21/มี.ค./2556 ] </b></font><b><font color="#0066FF">ตารางสอนภาคฤดูร้อนเทอม3/2555</font></b></a> (อ่าน : 511 / ดาวน์โหลด : 0 ) โดย admin </td>
																																</tr>
																																<tr class="odd">
																																	<td width="100%" align="left"><img src="images/admin/open.gif" border="0" align="absmiddle"><a href="index5817-2.html?name=download&amp;file=readdownload&amp;id=16"><font color="#990066"><b>[ 19/ก.พ./2556 ] </b></font><b><font color="#0066FF">3VICHI 7 COLOR MODEL(นพ.วิชัย เทียนถาวร)</font></b></a> (อ่าน : 490 / ดาวน์โหลด : 0 ) โดย admin </td>
																																</tr>
																																<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																																	<td width="100%" align="left"><img src="images/admin/open.gif" border="0" align="absmiddle"><a href="indexca12-2.html?name=download&amp;file=readdownload&amp;id=15"><font color="#990066"><b>[ 19/ก.พ./2556 ] </b></font><b><font color="#0066FF">การทำงานอย่างมีความสุข(ผอ.วีระพันธุ์ อนันตพงศ์)</font></b></a> (อ่าน : 366 / ดาวน์โหลด : 0 ) โดย admin </td>
																																</tr>
																																<tr class="odd">
																																	<td width="100%" align="left"><img src="images/admin/open.gif" border="0" align="absmiddle"><a href="index6880-2.html?name=download&amp;file=readdownload&amp;id=14"><font color="#990066"><b>[ 19/ก.พ./2556 ] </b></font><b><font color="#0066FF">อนาคตการสาธารณสุขไทยในอาเซียน (นพ.วิชัย เทียนถาวร)</font></b></a> (อ่าน : 1038 / ดาวน์โหลด : 0 ) โดย admin </td>
																																</tr>
																																<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																																	<td width="100%" align="left"><img src="images/admin/open.gif" border="0" align="absmiddle"><a href="index21d3-2.html?name=download&amp;file=readdownload&amp;id=13"><font color="#990066"><b>[ 3/ม.ค./2556 ] </b></font><b><font color="#0066FF">ตารางสอบกลางภาคที่2/2555</font></b></a> (อ่าน : 700 / ดาวน์โหลด : 0 ) โดย admin </td>
																																</tr>
																																<tr class="odd">
																																	<td width="100%" align="left"><img src="images/admin/open.gif" border="0" align="absmiddle"><a href="indexa9d1-2.html?name=download&amp;file=readdownload&amp;id=7"><font color="#990066"><b>[ 11/พ.ย./2555 ] </b></font><b><font color="#0066FF">ตราสัญลักษณ์ของวิทยาลัยแบบขาวดำ</font></b></a> (อ่าน : 1398 / ดาวน์โหลด : 0 ) โดย admin </td>
																																</tr>
																																<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																																	<td width="100%" align="left"><img src="images/admin/open.gif" border="0" align="absmiddle"><a href="index918a-2.html?name=download&amp;file=readdownload&amp;id=6"><font color="#990066"><b>[ 11/พ.ย./2555 ] </b></font><b><font color="#0066FF">ตราสัญลักษณ์ของวิทยาลัยแบบสี</font></b></a> (อ่าน : 942 / ดาวน์โหลด : 0 ) โดย admin </td>
																																</tr>
																															</tbody>
																														</table></td>
																													<td></td>
																												</tr>
																												<tr>
																													<td align="right"><a href="indexf8e1.html?name=download"><img src="images/admin/2_15.gif"></a></td>
																												</tr>
																											</tbody>
																										</table></td>
																								</tr>
																							</tbody>
																						</table></td>
																					<td background="templates/cli3/images/menu/ict_03.png" width="4" height="100%" alt=""></td>
																				</tr>
																				<tr>
																					<td><img src="templates/cli3/images/menu/ict_04.png" width="5" height="15" alt=""></td>
																					<td><img src="templates/cli3/images/menu/ict_05.png" width="100%" height="15" alt=""></td>
																					<td><img src="templates/cli3/images/menu/ict_06.png" width="4" height="15" alt=""></td>
																				</tr>
																			</tbody>
																		</table>
																		<div> </div>
																	</center>-->
										</center>
										</center>
										</center>
										</center>
										</center>
										</center>
										</center>
									</div></td>
							</tr>
						</tbody>
					</table>
					<br>
					
					<!--<center>
						<table width="100%" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td><div id="main_top_wrape">
											<center>
												<table id="Table_01" width="530" border="0" cellpadding="0" cellspacing="0">
													<tbody>
														<tr>
															<td colspan="3" class="titlecenter" background="templates/cli3/images/menu/center.png" width="530" height="39" alt="">กระดานถามตอบ</td>
														</tr>
														<tr>
															<td background="templates/cli3/images/menu/ict_02.png" width="5" height="100%" alt=""></td>
															<td width="521"> ﻿
																<center>
																	<table cellspacing="0" cellpadding="5" width="521" border="0">
																		<tbody>
																			<tr>
																				<td width="521" valign="top" align="center"><br>
																					<div align="right"><b><img src="images/icon/icon_folder.gif" width="16" height="16" border="0" align="absmiddle"> <a href="index7df3-2.html?name=webboard">รายการกระทู้ทั้งหมด</a> &nbsp;&nbsp;&nbsp; <img src="images/icon/icon_add.gif" width="16" height="16" border="0" align="absmiddle"> <a href="indexbcc4-2.html?name=webboard&amp;file=post_cat">ตั้งกระทู้ใหม่ </a></b>&nbsp;&nbsp;</div>
																					<br>
																					<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" class="grids">
																						<tbody>
																							<tr class="odd">
																								<td width="60%"><center>
																										<b>หัวข้อ (อ่าน/ตอบ)</b>
																									</center></td>
																								<td width="15%"><center>
																										<b>โดย</b>
																									</center></td>
																								<td width="25%"><center>
																										<b>วันที่</b>
																									</center></td>
																							</tr>
																							<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																								<td align="left"><img src="images/icon/topichot.gif" border="0" hspace="5" align="absmiddle"><b>00077 : </b> <a href="index40af-2.html?name=webboard&amp;file=read&amp;id=77" target="_parent">ข่าวปฏิทินรับตรง 57</a> &nbsp;<font face="tahoma" color="#808080">(16,784/19)</font></td>
																								<td width="120"><center>
																										<b><font color="#6600FF">น้ององุ่น</font></b>
																									</center></td>
																								<td width="120"><center>
																										<font color="#339900">27 พ.ค. 2556 : 09:07</font>
																									</center></td>
																							</tr>
																							<tr class="odd">
																								<td align="left"><img src="images/icon/topichot.gif" border="0" hspace="5" align="absmiddle"><b>00334 : </b> <a href="index7793-2.html?name=webboard&amp;file=read&amp;id=334" target="_parent">มีวุฒิ กศน. ม.6 เรียน ทันตา ได้มั้ย คะ</a> &nbsp;<font face="tahoma" color="#808080">(52/1)</font></td>
																								<td width="120"><center>
																										<b><font color="#6600FF">ภัสราภรณ์ dent</font></b>
																									</center></td>
																								<td width="120"><center>
																										<font color="#339900">17 ต.ค.. 2557 : 21:48</font>
																									</center></td>
																							</tr>
																							<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																								<td align="left"><img src="images/icon/topichot.gif" border="0" hspace="5" align="absmiddle"><b>00336 : </b> <a href="index8b18-2.html?name=webboard&amp;file=read&amp;id=336" target="_parent">แนะนำเว็บไซต์เกี่ยวกับครู ครับ</a> &nbsp;<font face="tahoma" color="#808080">(66/1)</font></td>
																								<td width="120"><center>
																										<b><font color="#6600FF">SS</font></b>
																									</center></td>
																								<td width="120"><center>
																										<font color="#339900">21 ต.ค.. 2557 : 11:17</font>
																									</center></td>
																							</tr>
																							<tr class="odd">
																								<td align="left"><img src="images/icon/dok.gif" border="0" hspace="5" align="absmiddle"><b>00337 : </b> <a href="indexd433-2.html?name=webboard&amp;file=read&amp;id=337" target="_parent">sbobet วิธีเล่น  เอ็ดบ่นเลวทรามบดลำแข้งใหม่แมนเชสเตอร์ ยูไนเต็ด"ลงเล่นไม่เท่าทุนค่าตอบแทน</a> &nbsp;<font face="tahoma" color="#808080">(29/1)</font></td>
																								<td width="120"><center>
																										<b><font color="#6600FF">ฤฒญพ</font></b>
																									</center></td>
																								<td width="120"><center>
																										<font color="#339900">21 ต.ค.. 2557 : 16:31</font>
																									</center></td>
																							</tr>
																							<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																								<td align="left"><img src="images/icon/topichot.gif" border="0" hspace="5" align="absmiddle"><b>00338 : </b> <a href="index1652-2.html?name=webboard&amp;file=read&amp;id=338" target="_parent">ทันตาภิบาล</a> &nbsp;<font face="tahoma" color="#808080">(52/1)</font></td>
																								<td width="120"><center>
																										<b><font color="#6600FF">ข้าวฟ่าง</font></b>
																									</center></td>
																								<td width="120"><center>
																										<font color="#339900">22 ต.ค.. 2557 : 18:40</font>
																									</center></td>
																							</tr>
																							<tr class="odd">
																								<td align="left"><img src="images/icon/dok.gif" border="0" hspace="5" align="absmiddle"><b>00339 : </b> <a href="index9232-2.html?name=webboard&amp;file=read&amp;id=339" target="_parent">sbobet agent เคราะห์ร้ายซ้ำทับกัน! เวย์นเดี้ยงทวีคูณส่อเค้าทวดแมนเชสเตอร์ดาร์บี้</a> &nbsp;<font face="tahoma" color="#808080">(21/1)</font></td>
																								<td width="120"><center>
																										<b><font color="#6600FF">หวมน</font></b>
																									</center></td>
																								<td width="120"><center>
																										<font color="#339900">28 ต.ค.. 2557 : 16:32</font>
																									</center></td>
																							</tr>
																							<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																								<td align="left"><img src="images/icon/topichot.gif" border="0" hspace="5" align="absmiddle"><b>00335 : </b> <a href="index45ca-3.html?name=webboard&amp;file=read&amp;id=335" target="_parent">ปีการศึกษา 2557</a> &nbsp;<font face="tahoma" color="#808080">(60/2)</font></td>
																								<td width="120"><center>
																										<b><font color="#6600FF">อลิษา</font></b>
																									</center></td>
																								<td width="120"><center>
																										<font color="#339900">18 ต.ค.. 2557 : 11:23</font>
																									</center></td>
																							</tr>
																							<tr class="odd">
																								<td align="left"><img src="images/icon/topichot.gif" border="0" hspace="5" align="absmiddle"><b>00303 : </b> <a href="index4634-2.html?name=webboard&amp;file=read&amp;id=303" target="_parent">ทำแบบขอกู้ยืมไม่ได้</a> &nbsp;<font face="tahoma" color="#808080">(273/6)</font></td>
																								<td width="120"><center>
																										<b><font color="#6600FF">นักศึกษาใหม่</font></b>
																									</center></td>
																								<td width="120"><center>
																										<font color="#339900">20 ก.ค. 2557 : 10:22</font>
																									</center></td>
																							</tr>
																							<tr onmouseover="this.style.backgroundColor='#FFF0DF'" onmouseout="this.style.backgroundColor='#ffffff'">
																								<td align="left"><img src="images/icon/topichot.gif" border="0" hspace="5" align="absmiddle"><b>00318 : </b> <a href="indexf840-2.html?name=webboard&amp;file=read&amp;id=318" target="_parent">อบรมแพทย์แผนไทย</a> &nbsp;<font face="tahoma" color="#808080">(135/1)</font></td>
																								<td width="120"><center>
																										<b><font color="#6600FF">สา</font></b>
																									</center></td>
																								<td width="120"><center>
																										<font color="#339900">8 ก.ย. 2557 : 16:36</font>
																									</center></td>
																							</tr>
																							<tr class="odd">
																								<td align="left"><img src="images/icon/topichot.gif" border="0" hspace="5" align="absmiddle"><b>00327 : </b> <a href="index111a-2.html?name=webboard&amp;file=read&amp;id=327" target="_parent">การรับนักศึกษาปีการศึกษา2558</a> &nbsp;<font face="tahoma" color="#808080">(216/0)</font></td>
																								<td width="120"><center>
																										<b><font color="#6600FF">LP999G</font></b>
																									</center></td>
																								<td width="120"><center>
																										<font color="#339900">27 ก.ย. 2557 : 22:02</font>
																									</center></td>
																							</tr>
																						</tbody>
																					</table>
																					<br></td>
																			</tr>
																		</tbody>
																	</table>
																</center></td>
															<td background="templates/cli3/images/menu/ict_03.png" width="4" height="100%" alt=""></td>
														</tr>
														<tr>
															<td><img src="templates/cli3/images/menu/ict_04.png" width="5" height="15" alt=""></td>
															<td><img src="templates/cli3/images/menu/ict_05.png" width="100%" height="15" alt=""></td>
															<td><img src="templates/cli3/images/menu/ict_06.png" width="4" height="15" alt=""></td>
														</tr>
													</tbody>
												</table>
											</center>
										</div></td>
								</tr>
							</tbody>
						</table>
						<br>
					</center>--></td>
				<td width="10" valign="top"></td>
				<td width="220" valign="top" align="left"><table cellspacing="0" cellpadding="0" width="220">
						<tbody>
							<tr>
								<td width="220" valign="top" align="center"><center>
										<table id="Table_01" width="220" border="0" cellpadding="0" cellspacing="0">
											<tbody>
												<tr>
													<td colspan="3" class="titleleft" width="220" alt="">บุคลากร</td>
												</tr>
												<tr>
													<td background="templates/cli3/images/menu/ict_02.png" width="5" height="100%" alt=""></td>
													<td><table width="211" border="0" cellpadding="0" cellspacing="0">
															<tbody>
																<tr>
																	<td align="center"><table class="iconframe" cellpadding="0" cellspacing="0">
																			<tbody>
																				<tr>
																					<td class="imageframe" align="center"><img src="<?php echo ADDRESS_PERSONNEL . "ดร.นะรงษ์ _ชาวเพ็ชร.jpg"?>" style="height:151px; width:120px;"></td>
																					<td class="shadow_right"><div class="shadow_top_right"></div></td>
																				</tr>
																				<tr>
																					<td class="shadow_bottom"><div class="shadow_bottom_left"></div></td>
																					<td class="shadow_bottom_right"></td>
																				</tr>
																			</tbody>
																		</table></td>
																</tr>
																<tr>
																	<td align="center">ดร.นะรงษ์  ชาวเพ็ชร<br>
																		<b><font color="#CC0000">ผู้อำนวยการ</font></b><font color="#CC0000"><br>
																		โรงเรียนโสตศึกษาจังหวัดปราจีนบุรี </font><br>
																		<b><font color="#0000FF">ประธานกรรมการ กลุ่ม 2</font></b></td>
																</tr>
																<tr>
																	<td><table cellspacing="0" cellpadding="0" width="211" border="0">
																			<tbody>
																				<!--	<tr class="off" onmouseover="this.className=&quot;on&quot;" onmouseout="this.className=&quot;off&quot;">
																					<td><ul id="menu" style="list-style:none; padding:0;height:24px;">
																							<li><a href="indexc0b7-2.html?name=personnel&amp;file=gdetail&amp;id=5&amp;op=gdetail&amp;gr=%e0%b8%9c%e0%b8%b9%e0%b9%89%e0%b8%ad%e0%b8%b3%e0%b8%99%e0%b8%a7%e0%b8%a2%e0%b8%81%e0%b8%b2%e0%b8%a3%e0%b8%a7%e0%b8%b4%e0%b8%97%e0%b8%a2%e0%b8%b2%e0%b8%a5%e0%b8%b1%e0%b8%a2"><b>ผู้อำนวยการวิทยาลัย</b></a></li>
																						</ul></td>
																				</tr>
																				<tr class="off" onmouseover="this.className=&quot;on&quot;" onmouseout="this.className=&quot;off&quot;">
																					<td><ul id="menu" style="list-style:none; padding:0;height:24px;">
																							<li><a href="index5b2b-2.html?name=personnel&amp;file=gdetail&amp;id=6&amp;op=gdetail&amp;gr=%e0%b8%a3%e0%b8%ad%e0%b8%87%e0%b8%9c%e0%b8%ad.%e0%b8%94%e0%b9%89%e0%b8%b2%e0%b8%99%e0%b8%ad%e0%b8%b3%e0%b8%99%e0%b8%a7%e0%b8%a2%e0%b8%81%e0%b8%b2%e0%b8%a3"><b>รองผอ.ด้านอำนวยการ</b></a></li>
																						</ul></td>
																				</tr>
																				--> 
																				<!--<tr bgcolor="#ffffff">
																					<td align="right" bgcolor="#ffffff"><a href="index45ca.html?name=personnel&amp;file=detail"><img src="images/admin/2_15.gif"></a></td>
																				</tr>-->
																			</tbody>
																		</table></td>
																</tr>
															</tbody>
														</table></td>
													<td background="templates/cli3/images/menu/ict_03.png" width="4" height="100%" alt=""></td>
												</tr>
												<tr>
													<td><img src="templates/cli3/images/menu/ict_04.png" width="5" height="15" alt=""></td>
													<td><img src="templates/cli3/images/menu/ict_05.png" width="211" height="15" alt=""></td>
													<td><img src="templates/cli3/images/menu/ict_06.png" width="4" height="15" alt=""></td>
												</tr>
											</tbody>
										</table>
										<center>
											<center>
												<table id="Table_01" width="220" border="0" cellpadding="0" cellspacing="0">
													<tbody>
														<tr>
															<td colspan="3" class="titleleft" width="220" alt="">ขณะนี้เวลา</td>
														</tr>
														<tr>
															<td background="templates/cli3/images/menu/ict_02.png" width="5" height="100%" alt=""></td>
															<td><center>
																	<link rel="stylesheet" href="css/calendar.css" type="text/css" media="screen">
																	<style type="text/css">
<!--
.calendar { 
    width:190;
    background-color: #FFFFFF;
}
-->
</style>
																	<table width="211" border="0" cellpadding="0" cellspacing="0">
																		<tbody>
																			<tr>
																				<td width="211" border="1" align="center"><br>
																					<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="120" height="120" align="center">
																						<param name="movie" value="UserFiles/Flash/watch1.swf">
																						<param name="quality" value="high">
																						<param name="bgcolor" value="#FFFFFF">
																						<param name="wmode" value="transparent">
																						<param name="menu" value="false">
																						<embed src="UserFiles/Flash/watch1.swf" quality="high" width="120" height="120" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
																					</object></td>
																			</tr>
																			
																		</tbody>
																	</table>
																</center></td>
															<td background="templates/cli3/images/menu/ict_03.png" width="4" height="100%" alt=""></td>
														</tr>
														<tr>
															<td><img src="templates/cli3/images/menu/ict_04.png" width="5" height="15" alt=""></td>
															<td><img src="templates/cli3/images/menu/ict_05.png" width="211" height="15" alt=""></td>
															<td><img src="templates/cli3/images/menu/ict_06.png" width="4" height="15" alt=""></td>
														</tr>
													</tbody>
												</table>
												<center>
													<center>
													</center>
												</center>
											</center>
										</center>
									</center></td>
							</tr>
						</tbody>
					</table>
					<br>
					<br></td>
			</tr>
		</tbody>
	</table></td>
