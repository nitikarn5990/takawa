<?php

	// If they are saving the Information	

	if ($_POST['submit_bt'] == 'บันทึกข้อมูล' || $_POST['submit_bt'] == 'บันทึกข้อมูล และแก้ไขต่อ'){

		if($_POST['submit_bt'] == 'บันทึกข้อมูล'){

			$redirect = true;

		}else{

			$redirect = false;

		}

		$arrData = array();

		$arrData = $functions->replaceQuote($_POST);

		

		// Get all the Form Data

		$webs_money->SetValues($arrData);		

		if($webs_money->GetPrimary() == ''){

			$webs_money->SetValue('created_at', DATE_TIME);

			$webs_money->SetValue('updated_at', DATE_TIME);

		}else{

			$webs_money->SetValue('updated_at', DATE_TIME);

		}

		// Upload Image

		if($_FILES['image']['name'] != ""){

			unset($arrData['webs_money_image']);

			$targetPath = DIR_ROOT_IMAGES . "/";

			$newImage = DATE_TIME_FILE . "_" . $_FILES['image']['name'];

			$cdir = getcwd(); // Save the current directory

			chdir($targetPath);

			copy($_FILES['image']['tmp_name'], $targetPath . $newImage);

			chdir($cdir); // Restore the old working directory   

			

			$webs_money->SetValue('webs_money_image', $newImage);

		}

		$webs_money->Save();	

		

		$arrData['webs_money_id'] = $webs_money->GetPrimary();

		unset($arrData['id']);

		$webs_money_rates->SetPrimary((int)$arrData['rates_id']);

		if($webs_money_rates->GetPrimary() == ''){

			$webs_money_rates->SetValue('created_at', DATE_TIME);

			$webs_money_rates->SetValue('updated_at', DATE_TIME);

		}else{

			$arrData['id'] = $webs_money_rates->GetPrimary();

			$webs_money_rates->SetValue('updated_at', DATE_TIME);

		}

		$webs_money_rates->SetValues($arrData);

		$webs_money_rates->Save();	

		

		//exit();

		

		if($webs_money->Save()){			

			SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');

			//Redirect if needed

			if ($redirect){

				header('location:' . ADDRESS_ADMIN_CONTROL . 'webs_money');

				die();

			}else{

				header('location:' . ADDRESS_ADMIN_CONTROL . 'webs_money&action=edit&id=' . $webs_money->GetPrimary());

				die();

			}

		}else{

			SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');

		}		

	}

	

	// If Deleting the Page

	if ($_GET['id'] != "" && $_GET['action'] == 'del'){

		// Get all the form data

		$arrDel = array('id' => $_GET['id']);

		$webs_money->SetValues($arrDel);

		

		// Remove the info from the DB

		if ($webs_money->Delete()){

			// Set alert and redirect

			SetAlert('Delete Data Success','success');

			header('location:' . ADDRESS_ADMIN_CONTROL . 'webs_money');

			die();

		}else{

			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');

		}

	}

	

	if ($_GET['id'] != "" && $_GET['action'] == 'edit'){

		// For Update

		$webs_money->SetPrimary((int)$_GET['id']);

		$webs_money->GetInfo();

		

		// Try to get the information

		if (!$webs_money->GetInfo()){

			SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');

			$webs_money->ResetValues();

		}

		

		$webs_money_rates_id = $webs_money_rates->getDataDesc("id", "webs_money_id = '" . $webs_money->GetPrimary() . "'");

		$webs_money_rates->SetPrimary((int)$webs_money_rates_id);

		$webs_money_rates->GetInfo();

	}

	

?>



<?php if($_GET['action'] == "add" || $_GET['action'] == "edit"){?>

<div class="row-fluid">	

    <div class="span12">        

        <div class="da-panel collapsible">

            <div class="da-panel-header">

                <span class="da-panel-title">

                    <i class="icol-<?php echo ($webs_money->GetPrimary() != "") ? 'application-edit' : 'add'?>"></i> <?php echo ($webs_money->GetPrimary() != "") ? 'แก้ไข' : 'เพิ่ม'?> บัญชีออนไลน์

                </span>

            </div>

            <div class="da-panel-content da-form-container">

                <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL?>webs_money<?php echo ($webs_money->GetPrimary() != "") ? '&id=' . $webs_money->GetPrimary() : ""; ?>" method="post" class="da-form">

                	<?php if($webs_money->GetPrimary() != ""):?>

                    	<input type="hidden" name="id" value="<?php echo $webs_money->GetPrimary()?>" />

                        <input type="hidden" name="rates_id" value="<?php echo $webs_money_rates->GetPrimary()?>" />

                        <input type="hidden" name="webs_money_image" value="<?php echo $webs_money->GetValue('webs_money_image')?>" />

                  		<input type="hidden" name="created_at" value="<?php echo $webs_money->GetValue('created_at')?>" />

               		<?php endif;?>

                    <div class="da-form-inline">

                        <div class="da-form-row">

                            <label class="da-form-label">ชื่อบัญชีออนไลน์ <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <input type="text" name="webs_money" id="webs_money" value="<?php echo ($webs_money->GetPrimary() != "") ? $webs_money->GetValue('webs_money') : ""; ?>" class="span12 required" />

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">รหัสบัญชีออนไลน์ <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <input type="text" name="webs_money_code" id="webs_money_code" value="<?php echo ($webs_money->GetPrimary() != "") ? $webs_money->GetValue('webs_money_code') : ""; ?>" class="span12 required" />

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">หมายเลขบัญชี <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <input type="text" name="webs_money_number" id="webs_money_number" value="<?php echo ($webs_money->GetPrimary() != "") ? $webs_money->GetValue('webs_money_number') : ""; ?>" class="span12 required" />

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">รูปภาพ</label>

                            <div class="da-form-item large">

                            	<?php if($webs_money->GetValue('webs_money_image') != ""){?>

                            		<div class="img-block" style="margin-bottom:10px"><img src="<?php echo DIR_ADMIN_IMAGES . $webs_money->GetValue('webs_money_image')?>" /></div>

                                <?php }?>

                                <input type="file" name="image" id="image" value="" class="span12 da-custom-file" />

                            	<label class="help-block">ขนาดแนะนำ 100 x 35px</label>

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">เพิ่ม ลดซื้อ %</label>

                            <div class="da-form-item large">

                                <input type="text" name="percent_buy" id="percent_buy" value="<?php echo ($webs_money->GetPrimary() != "") ? $webs_money->GetValue('percent_buy') : ""; ?>" class="span12" />

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">เพิ่ม ลดซื้อ</label>

                            <div class="da-form-item large">

                                <ul class="da-form-list">

                                	<?php

										$getAddDisBuy = $webs_money->get_enum_values('add_dis_buy');

										$m = 1;

										foreach ($getAddDisBuy as $adb) {

									?>

                                    <li><input type="radio" name="add_dis_buy" id="add_dis_buy" value="<?php echo $adb?>" <?php echo ($webs_money->GetPrimary() != "") ? ($webs_money->GetValue('add_dis_buy') == $adb) ? "checked=\"checked\"" : "" : ($m == 1) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $adb?></label></li>

                                    <?php $m++; }?>

                                </ul>

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">เพิ่ม ลดขาย %</label>

                            <div class="da-form-item large">

                                <input type="text" name="percent_sell" id="percent_sell" value="<?php echo ($webs_money->GetPrimary() != "") ? $webs_money->GetValue('percent_sell') : ""; ?>" class="span12" />

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">เพิ่ม ลดขาย</label>

                            <div class="da-form-item large">

                                <ul class="da-form-list">

                                	<?php

										$getAddDisSell = $webs_money->get_enum_values('add_dis_sell');

										$n = 1;

										foreach ($getAddDisSell as $ads) {

									?>

                                    <li><input type="radio" name="add_dis_sell" id="add_dis_sell" value="<?php echo $ads?>" <?php echo ($webs_money->GetPrimary() != "") ? ($webs_money->GetValue('add_dis_sell') == $ads) ? "checked=\"checked\"" : "" : ($n == 1) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $ads?></label></li>

                                    <?php $n++; }?>

                                </ul>

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">รูปแบบของเงิน <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <ul class="da-form-list">

                                	<?php

										$getType = $webs_money->get_enum_values('type');

										$t = 1;

										foreach ($getType as $type) {

									?>

                                    <li><input type="radio" name="type" id="type" value="<?php echo $type?>" <?php echo ($webs_money->GetPrimary() != "") ? ($webs_money->GetValue('type') == $type) ? "checked=\"checked\"" : "" : ($t == 1) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $type?></label></li>

                                    <?php $t++; }?>

                                </ul>

                                <label for="status" class="error" generated="true" style="display:none;"></label>

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">ลำดับการแสดงผล <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <input type="text" name="sort" id="sort" value="<?php echo ($webs_money->GetPrimary() != "") ? $webs_money->GetValue('sort') : "100"; ?>" class="span12 required" />

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">สถานะ <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <ul class="da-form-list">

                                	<?php

										$getStatus = $webs_money->get_enum_values('status');

										$i = 1;

										foreach ($getStatus as $status) {

									?>

                                    <li><input type="radio" name="status" id="status" value="<?php echo $status?>" <?php echo ($webs_money->GetPrimary() != "") ? ($webs_money->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $status?></label></li>

                                    <?php $i++; }?>

                                </ul>

                                <label for="status" class="error" generated="true" style="display:none;"></label>

                            </div>

                        </div>

                       	<?php

                        	if($webs_money->GetPrimary() != ""){

						?>

                        <fieldset class="da-form-inline">

                    	<legend>อัตราแลกเปลี่ยน</legend>

                        <div class="da-form-row">

                            <label class="da-form-label">สกุลเงิน <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <select id="currencies_id" name="currencies_id" class="span12 required select2">

                                    <option value=""></option>

                                    <?php $currencies->CreateDataList("id","currencies","",($webs_money->GetPrimary() != "") ? $webs_money_rates->GetValue('currencies_id') : "")?> 

                                </select>

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">จำนวนที่รับซื้อ <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <input type="text" name="can_buy" id="can_buy" value="<?php echo ($webs_money->GetPrimary() != "") ? $webs_money_rates->GetValue('can_buy') : ""; ?>" class="span12 required" />

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">อัตราแลกเปลี่ยน ซื้อ <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <input type="text" name="buy" id="buy" value="<?php echo ($webs_money->GetPrimary() != "") ? $webs_money_rates->GetValue('buy') : ""; ?>" class="span12 required" />

                                <label class="help-block">อัตราแลกเปลี่ยนต่อ $1/บาท</label>

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">จำนวนที่รับขาย <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <input type="text" name="can_sell" id="can_sell" value="<?php echo ($webs_money->GetPrimary() != "") ? $webs_money_rates->GetValue('can_sell') : ""; ?>" class="span12 required" />

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">อัตราแลกเปลี่ยน ขาย <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <input type="text" name="sell" id="sell" value="<?php echo ($webs_money->GetPrimary() != "") ? $webs_money_rates->GetValue('sell') : ""; ?>" class="span12 required" />

                                <label class="help-block">อัตราแลกเปลี่ยนต่อ $1/บาท</label>

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">ใช้งาน API <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <ul class="da-form-list">

                                	<?php

										$getApi = $webs_money_rates->get_enum_values('use_api');

										$k = 1;

										foreach ($getApi as $api) {

									?>

                                    <li><input type="radio" name="use_api" id="use_api" value="<?php echo $api?>" <?php echo ($webs_money->GetPrimary() != "") ? ($webs_money_rates->GetValue('use_api') == $api) ? "checked=\"checked\"" : "" : ($k == 2) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $api?></label></li>

                                    <?php $k++; }?>

                                </ul>

                            </div>

                        </div>

                        </fieldset>

                        <?php }?>

                    </div>

                    <div class="btn-row">

                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />

                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล และแก้ไขต่อ" class="btn btn-primary" />

                        <a href="<?php echo ADDRESS_ADMIN_CONTROL?>webs_money" class="btn btn-danger">ยกเลิก</a>

                    </div>

                </form>

            </div>

        </div>

  	</div>

</div>

<?php }else{?> 

<div class="row-fluid">	

    <div class="span12"> 

    	<?php

			// Report errors to the user

			Alert(GetAlert('error'));

			Alert(GetAlert('success'),'success');

		?>      

        <div class="da-panel collapsible">

            <div class="da-panel-header">

                <span class="da-panel-title">

                    <i class="icol-grid"></i> บัญชีออนไลน์ ทั้งหมด

                </span>

            </div>

            <div class="da-panel-toolbar">

                <div class="btn-toolbar">

                    <div class="btn-group">

                        <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL?>webs_money&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a>

                    </div>

                </div>

            </div> 

            <div class="da-panel-content da-table-container">

            	<?php

                	$getBTC = $BTCeAPI->getPairTicker('btc_usd');

					//print_r($getBTC);

				?>

                <table id="da-ex-datatable-sort" class="da-table" sort="9" order="asc" width="1800">

                    <thead>

                        <tr>

                            <th>รหัส</th>

                            <th>รูปภาพ</th>                            

                            <th>ชื่อบัญชี</th>

                            <th>รหัสบัญชี</th>

                            <th>หมายเลข</th>

                            <th>สถานะ</th>

                            <th>แก้ไขล่าสุด</th>

                            <th>อัตราแลกเปลี่ยน</th>

                            <th>รูปแบบ</th>

                            <th>ลำดับ</th>

                            <th>ตัวเลือก</th>

                        </tr>

                    </thead>

                    <tbody>

                    	<?php

							$sql = "SELECT * FROM " . $webs_money->getTbl();

							$query = $db->Query($sql);

							while ($row = $db->FetchArray($query)){

								$cRates = $webs_money_rates->getDataDesc("id","webs_money_id = '" .$row['id'] . "'");

						?>

                        <tr>

                            <td class="center"><?php echo $row['id'];?></td>

                            <td class="center">

                            	<?php if($row['webs_money_image'] != ""){?>

                            		<img src="<?php echo DIR_ADMIN_IMAGES . $row['webs_money_image']?>" />

                                <?php }?>

                            </td>

                            <td><?php echo $row['webs_money'];?></td>

                            <td><?php echo $row['webs_money_code'];?></td>

                            <td><?php echo $row['webs_money_number'];?></td>                          

                            <td class="center"><i class="icol-<?php echo ($row['status'] == 'ใช้งาน') ? 'accept' : 'cross'?>" title="<?php echo $row['status']?>"></i><span style="overflow:hidden; display:none"><?php echo $row['status']?></span></td>

                            <td class="center"><?php echo $functions->ShowDateThTime($row['updated_at'])?></td>

                            <td>

                            	<?php if($cRates > 0){?>

                                    <?php										

										if($row['id'] != 5){

											$buy = $webs_money_rates->getDataDesc("buy","webs_money_id = '" .$row['id'] . "'");

											$sell = $webs_money_rates->getDataDesc("sell","webs_money_id = '" .$row['id'] . "'");

											$buy_rate = $webs_money_rates->getDataDesc("buy","webs_money_id = '" .$row['id'] . "'");

											$sell_rate = $webs_money_rates->getDataDesc("sell","webs_money_id = '" .$row['id'] . "'");

											$type = "THB";

										}else{

											$buy = $getBTC['buy'];

											$sell = $getBTC['sell'];

											$buy_rate = $webs_money_rates->getDataDesc("buy","webs_money_id = '" .$row['id'] . "'");

											$sell_rate = $webs_money_rates->getDataDesc("sell","webs_money_id = '" .$row['id'] . "'");

											$type = "USD";

										}

									?>

                                   	<strong>รับซื้อ</strong> <?php echo number_format($webs_money_rates->getDataDesc("can_buy","webs_money_id = '" .$row['id'] . "'"),2)?>&nbsp;&nbsp;&nbsp;

                                    <strong>ราคา</strong> <?php echo $functions->getRatePercent($buy, $buy_rate, $row['percent_buy'], $row['add_dis_buy'],$type);?> <?php echo ($row['id'] != 5) ? "" : "(" . $functions->getRatePercent($buy, $buy_rate, $row['percent_buy'], $row['add_dis_buy'],"THB") . " USD)"?>

                                    <br />

                                    <strong>ขายออก</strong> <?php echo number_format($webs_money_rates->getDataDesc("can_sell","webs_money_id = '" .$row['id'] . "'"),2)?>&nbsp;&nbsp;&nbsp;

                                    <strong>ราคา</strong> <?php echo $functions->getRatePercent($sell, $sell_rate, $row['percent_sell'], $row['add_dis_sell'],$type);?> <?php echo ($row['id'] != 5) ? "" : "(" . $functions->getRatePercent($sell, $sell_rate, $row['percent_sell'], $row['add_dis_sell'],"THB") . " USD)"?>

                           		<?php }?>

                            </td>

                            <td class="center"><?php echo $row['type'];?></td> 

                            <td class="center"><?php echo $row['sort'];?></td> 

                            <td class="center">

								<a href="<?php echo ADDRESS_ADMIN_CONTROL?>webs_money&action=edit&id=<?php echo $row['id']?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>

                                <a href="#" onclick="if(confirm('คุณต้องการลบข้อมูลนี้หรือใม่?')==true){document.location.href='<?php echo ADDRESS_ADMIN_CONTROL?>webs_money&action=del&id=<?php echo $row['id']?>'}" class="btn btn-danger btn-small">ลบ</a>

							</td>

                        </tr>  

                        <?php }?>                      

                    </tbody>

                </table>

            </div>

        </div>        

    </div>                           	

</div>

<?php }?>