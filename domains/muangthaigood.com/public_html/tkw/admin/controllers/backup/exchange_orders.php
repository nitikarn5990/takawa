<?php

	

	// If Deleting the Page

	if ($_GET['id'] != '' && $_GET['action'] == 'del'){

		// Get all the form data

		$arrDel = array('id' => $_GET['id']);

		$exchange_orders->SetValues($arrDel);

		

		// Remove the info from the DB

		if ($exchange_orders->Delete()){

			// Set alert and redirect

			SetAlert('Delete Data Success','success');

			header('location:' . ADDRESS_ADMIN_CONTROL . 'exchange_orders');

			die();

		}else{

			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');

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

                    <i class="icol-<?php echo ($exchange_orders->GetPrimary() != '') ? 'application-edit' : 'add'?>"></i> <?php echo ($exchange_orders->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม'?> สมาชิก

                </span>

            </div>

            <div class="da-panel-content da-form-container">

                

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

                            <th>ชื่อ-นามสกุล</th>
                            
                            <th>เบอร์ SMS</th>

                            <th>บัญชีออนไลน์</th>
                            
                            <th>โอนเข้าที่</th> 
                            
                            <th>โอนไปที่</th> 

                            <th>เว็บไซต์</th> 

                            <th>จำนวน</th>

                            <th>อัตราแลกเปลี่ยน</th>

                            <th>จำนวนเงิน</th>  

                            <th>วันที่ทำรายการ</th>                     

                            <th>แก้ไขล่าสุด</th>

                            <th>ตัวเลือก</th>

                        </tr>

                    </thead>

                    <tbody>

                    	<?php

							$sql = "SELECT * FROM " . $exchange_orders->getTbl();

							$query = $db->Query($sql);

							while ($row = $db->FetchArray($query)){

								$getConStatus = $confirm_payments->getDataDesc("status", "order_id = '" . $row['id'] . "'");

						?>

                        <tr>

                            <td class="center"><?php echo $row['id'];?></td>

                            <td>
								<?php echo $row['status']?> <strong><?php echo ($getConStatus != "") ? "(" . $getConStatus . ")" : ""?></strong>
                           		<?php echo ($row['comment'] != "") ? "<br/><font color=\"red\">" . $row['comment'] . "</font>" : "" ?>
                            </td>

                            <td><?php echo $row['exchange_type'];?></td>

                            <td><?php echo $row['order_code'];?></td>

                            <td><?php echo $users->getValueTable($row['user_id'],"name")?></td>
                            
                            <td><?php echo $row['sms'];?></td>

                            <td><?php if($row['exchange_type'] == "ซื้อ"){?><?php echo $row['webs_money_acc'];?><?php }?></td>

                            <td><?php echo ($row['buy_banks_id'] != 0) ? "<strong>" . $banks->getValueTable($row['buy_banks_id'],"bank_name") . "</strong><br/>" . $banks->getValueTable($row['buy_banks_id'],"bank_acc") . "<br/>(" . $banks->getValueTable($row['buy_banks_id'],"bank_number") . ")" : ""?></td>
                            
                            <td>
                            	<?php if($row['exchange_type'] == "ขาย"){?>
                            	<strong>ธนาคาร: </strong><?php echo $row['bank_tranfer'];?><br/>
                           		<strong>หมายเลขบัญชี: </strong><?php echo $row['bank_number'];?><br/>
                                <strong>ชื่อบัญชี: </strong><?php echo $row['bank_acc'];?>
                                <?php }?>
                            </td>
                            
                            <td><?php echo $webs_money->getValueTable($row['webs_money_id'],"webs_money")?></td>

                            <td <?php echo ($row['exchange_type'] == "ขาย") ? "style=\"color:#F00\"" : ""?>><strong><?php echo $row['quantity']?> <?php echo $currencies->getValueTable($webs_money_rates->getDataDesc("currencies_id", "webs_money_id = '" . $row['webs_money_id'] . "'"),"currencies_code")?></strong></td>

                       		<td><?php echo number_format($row['current_rate'],2)?></td>

                        	<td <?php echo ($row['exchange_type'] == "ซื้อ") ? "style=\"color:#F00\"" : ""?>><strong><?php echo number_format($row['price'],2)?> THB</strong></td>

                            <td class="center"><?php echo $functions->ShowDateThTime($row['created_at'])?></td>

                            <td class="center"><?php echo $functions->ShowDateThTime($row['updated_at'])?></td>

                            <td class="center">

								<a style="display:none" href="<?php echo ADDRESS_ADMIN_CONTROL?>exchange_orders&action=edit&id=<?php echo $row['id']?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>

                                <?php if($getConStatus == ""){?>

                                	<a href="#" onclick="if(confirm('คุณต้องการลบข้อมูลนี้หรือใม่?')==true){document.location.href='<?php echo ADDRESS_ADMIN_CONTROL?>exchange_orders&action=del&id=<?php echo $row['id']?>'}" class="btn btn-danger btn-small">ลบ</a>

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