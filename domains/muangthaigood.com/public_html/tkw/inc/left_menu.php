<div id="left">
                                            <div id="menuleft">
                                                <ul class="v_menu">
                                                    <li><a href="<?=ADDRESS?>">หน้าหลัก</a></li>
                                                    <li><a href="<?=ADDRESS . 'about'?>.html">เกี่ยวกับเรา</a></li>
                                                    <li><a href="<?=ADDRESS . 'structure'?>.html">โครงสร้างองค์กร</a>
                                                        <ul>
                                                      <?php
                                                            $strSQL = "SELECT * FROM " . $manager->getTbl() . " WHERE status = 'ใช้งาน'";

													$objQuery = $db->Query($strSQL);
													$Num_Rows = $db->NumRows($objQuery);
													$objQuery = mysql_query($strSQL);
														
														 while ($row = $db->FetchArray($objQuery)) {
															?>
														
														
                                                             <li><a href="<?=ADDRESS?>detail-manager/<?=$row['id']?>.html"><?= $manager_categories->getDataDesc('manager_categories','id='.$row['manager_categories_id']) ?></a></li>
                                                       
														
														<?php } ?>
																												
                                                        
                                                        </ul>
                                                    </li>
                                                    <li><a href="<?=ADDRESS . 'announce'?>.html">ประกาศ</a></li>
                                                    <li><a href="<?=ADDRESS . 'activity'?>.html">กิจกรรม</a></li>
                                                    <li><a href="<?=ADDRESS . 'news'?>.html">ข่าวสาร</a></li>
                                                    <li><a href="<?=ADDRESS . 'contact'?>.html">ติดต่อเรา</a></li>
                                                </ul>
                                                <div align="center">
                                                    <p>
                                                        <iframe src="http://www.tmd.go.th/daily_forecast_forweb.php" width="180" height="260" scrolling="no" frameborder="0"></iframe>
                                                    </p>
                                                    <p>
                                                        <iframe marginWidth=0 marginHeight=0 src="http://www.pttplc.com/th/GetOilPrice.aspx" frameBorder=0 width=173 scrolling=no height=305></iframe>
                                                    </p>
                                                    <p>
                                                        <iframe src="http://namchiang.com/ncgp2-1.swf" width="172" height="165" frameborder="0" marginheight=0 marginwidth=0 scrolling="no"></iframe>
                                                    </p>
                                                    <p class="clear"></p>
                                                </div>
                                                <div><img src="<?=ADDRESS?>images/bottommenuleft.jpg" width="229" height="81" /></div>
                                            </div>
                                        </div>