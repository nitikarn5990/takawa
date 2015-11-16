<?php

	// If they are saving the Information	

	if ($_POST['submit_bt'] == 'บันทึกข้อมูล'){

		$redirect = true;

		

		$arrConfirm = array(

			'status' => $_POST['status'],
			
			'text_sms' => $_POST['text_sms'],

			'updated_at' => DATE_TIME

		);

		$arrConID = array('id' => $_POST['id']);

		$confirm_payments->updateSQL($arrConfirm, $arrConID);
		

		if($_POST['status'] == "ยืนยันแล้ว"){

			$statusOrder = "ชำระเงินแล้ว";

		}elseif($_POST['status'] == "รอการยืนยัน"){

			$statusOrder = "รอชำระเงิน";

		}else{

			$statusOrder = "ยกเลิก";

		}

		$arrOrder = array(

			'status' => $statusOrder,
			
			'comment' => $_POST['comment'],

			'updated_at' => DATE_TIME

		);

		$arrOrderID = array('id' => $_POST['order_id']);

		$exchange_orders->updateSQL($arrOrder, $arrOrderID);
		
		if($_POST['text_sms'] != ""){
			$getUserID = $exchange_orders->getValueTable($_POST['order_id'],"user_id");	
			$getTel = $users->getValueTable($getUserID,"tel");	
			$functions->sentSMS($_POST['text_sms'],$getTel);
		}
				

		SetAlert('แก้ไข ข้อมูลสำเร็จ','success');		

		if ($redirect){

			header('location:' . ADDRESS_ADMIN_CONTROL . 'confirm_payments');

			die();

		}		

	}

	

	// If Deleting the Page

	if ($_GET['id'] != '' && $_GET['action'] == 'del'){

		// Get all the form data

		$arrDel = array('id' => $_GET['id']);

		$confirm_payments->SetValues($arrDel);

		

		// Remove the info from the DB

		if ($confirm_payments->Delete()){

			// Set alert and redirect

			SetAlert('Delete Data Success','success');

			header('location:' . ADDRESS_ADMIN_CONTROL . 'confirm_payments');

			die();

		}else{

			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');

		}

	}

	

	if ($_GET['id'] != '' && $_GET['action'] == 'edit'){

		// For Update

		$confirm_payments->SetPrimary((int)$_GET['id']);

		// Try to get the information

		if (!$confirm_payments->GetInfo()){

			SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');

			$confirm_payments->ResetValues();

		}

	}

	

?>



<?php if($_GET['action'] == "add" || $_GET['action'] == "edit"){?>

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

                    <i class="icol-<?php echo ($confirm_payments->GetPrimary() != '') ? 'application-edit' : 'add'?>"></i> <?php echo ($confirm_payments->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม'?> สถานะ

                </span>

            </div>

            <div class="da-panel-content da-form-container">

                <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL?>confirm_payments<?php echo ($confirm_payments->GetPrimary() != '') ? '&id=' . $confirm_payments->GetPrimary() : ''; ?>" method="post" class="da-form">

                	<?php if($confirm_payments->GetPrimary() != ''):?>

                    	<input type="hidden" name="id" value="<?php echo $confirm_payments->GetPrimary()?>" />

                  		<input type="hidden" name="order_id" value="<?php echo $confirm_payments->GetValue('order_id')?>" />

               		<?php endif;?>

                    <div class="da-form-inline">

                        <div class="da-form-row">

                            <label class="da-form-label">สถานะ <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <ul class="da-form-list">

                                	<?php

										$getStatus = $confirm_payments->get_enum_values('status');

										$i = 1;

										foreach ($getStatus as $status) {

									?>

                                    <li><input type="radio" name="status" id="status" value="<?php echo $status?>" <?php echo ($confirm_payments->GetPrimary() != "") ? ($confirm_payments->GetValue('status') == $status) ? "checked=\"checked\"" : "" : ($i == 1) ? "checked=\"checked\"" : ""?> class="required"/> <label><?php echo $status?></label></li>

                                    <?php $i++; }?>

                                </ul>

                                <label for="status" class="error" generated="true" style="display:none;"></label>

                            </div>

                        </div>
                        
                        <div class="da-form-row">

                            <label class="da-form-label">ข้อความ</label>

                            <div class="da-form-item large">

                                <textarea name="comment" id="comment" class="span12"><?php echo ($confirm_payments->GetPrimary() != '') ? $exchange_orders->getValueTable($confirm_payments->GetValue('order_id'),"comment") : ''; ?></textarea>

                            </div>

                        </div> 
                        
                        <!--<div class="da-form-row">

                            <label class="da-form-label">ข้อความ SMS <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <ul class="da-form-list">

                                    <li><input type="radio" name="text_sms" id="text_sms" value="" /> <label></label></li>


                                </ul>

                            </div>

                        </div>-->
                        
                        <div class="da-form-row">

                            <label class="da-form-label">ข้อความ SMS</label>

                            <div class="da-form-item large">

                                <textarea name="text_sms" id="text_sms" class="span12"><?php echo ($confirm_payments->GetPrimary() != '') ? $confirm_payments->GetValue('text_sms') : ''; ?></textarea>

                            </div>

                        </div>

                    </div>

                    <div class="btn-row">

                        <input type="submit" name="submit_bt" value="บันทึกข้อมูล" class="btn btn-success" />

                        <a href="<?php echo ADDRESS_ADMIN_CONTROL?>confirm_payments" class="btn btn-danger">ยกเลิก</a>

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

                    <i class="icol-grid"></i> คำสั่งซื้อ - ขายทั้งหมด

                </span>

            </div>

            <div class="da-panel-content da-table-container">

                <table id="da-ex-datatable-sort" class="da-table" sort="0" order="desc" width="2500">

                    <thead>

                        <tr>

                            <th>รหัส</th>

                            <th>สถานะ</th> 

                            <th>รูปแบบ</th>  

                            <th>หมายเลขรายการ</th>

                            <th>ชื่อผู้โอน</th>

                            <th>โอนเข้าธนาคาร</th> 

                            <th>โอนเข้าเว็บออนไลน์</th>

                            <th>จำนวนเงิน</th>

                            <th>วัน - เวลา</th>

                            <th>ข้อความ</th> 

                            <th>วันที่ทำรายการ</th>                     

                            <th>แก้ไขล่าสุด</th>

                            <th>ตัวเลือก</th>

                        </tr>

                    </thead>

                    <tbody>

                    	<?php

							$sql = "SELECT * FROM " . $confirm_payments->getTbl();

							$query = $db->Query($sql);

							while ($row = $db->FetchArray($query)){

						?>

                        <tr>

                            <td class="center"><?php echo $row['id'];?></td>

                            <td class="center"><strong><?php echo $row['status']?></strong></td>

                            <td><?php echo $row['exchange_type'];?></td>

                            <td><?php echo $exchange_orders->getValueTable($row['order_id'],"order_code")?></td>

                            <td><?php echo $row['name'];?></td>

                            <td>
								<?php echo ($row['bank_id'] != 0) ? "<strong>" . $banks->getValueTable($row['bank_id'],"bank_name") . "</strong> " . $banks->getValueTable($row['bank_id'],"bank_acc") . " (" . $banks->getValueTable($row['bank_id'],"bank_number") . ")" : ""?>
                        		<?php echo ($row['txid_topup_true'] != "") ? "<br/><font color=\"red\"><strong>TXID</strong>: " . $row['txid_topup_true'] . "</font>" : ""?>
                            </td>

                            <td>
								<?php echo ($row['webs_money_id'] != 0) ? $webs_money->getValueTable($row['webs_money_id'],"webs_money") : ""?>
                          		<?php echo ($exchange_orders->getValueTable($row['order_id'],"exchange_type") == "ขาย") ? "<br/><strong>" . $row['code_payment'] . "</strong>" : ""?>
                          	</td>

                            <td><?php echo number_format($row['price'],2);?> <?php echo ($row['bank_id'] != 0) ? "THB" : $currencies->getValueTable($webs_money_rates->getDataDesc("currencies_id", "webs_money_id = '" . $row['webs_money_id'] . "'"),"currencies_code")?></td>

                            <td><?php echo $row['datetime_pay'];?></td>

                            <td><?php echo $row['comment'];?></td>

                            <td class="center"><?php echo $functions->ShowDateThTime($row['created_at'])?></td>

                            <td class="center"><?php echo $functions->ShowDateThTime($row['updated_at'])?></td>

                            <td class="center">

								<a href="<?php echo ADDRESS_ADMIN_CONTROL?>confirm_payments&action=edit&id=<?php echo $row['id']?>" class="btn btn-primary btn-small">แก้ไขสถานะ</a>

                                <?php if($getConStatus == ""){?>

                                	<a href="#" onclick="if(confirm('คุณต้องการลบข้อมูลนี้หรือใม่?')==true){document.location.href='<?php echo ADDRESS_ADMIN_CONTROL?>confirm_payments&action=del&id=<?php echo $row['id']?>'}" class="btn btn-danger btn-small">ลบ</a>

								<?php }else{?>

                                	<button type="button" class="btn btn-small" disabled="disabled">ลบ</button>

								<?php }?>

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