<?php

	// If they are saving the Information	

	if ($_POST['submit_bt'] == 'ส่ง SMS' || $_POST['submit_bt'] == 'ส่ง SMS และแก้ไขต่อ'){

		if($_POST['submit_bt'] == 'ส่ง SMS'){

			$redirect = true;

		}else{

			$redirect = false;

		}

		$arrData = array();

		$arrData = $functions->replaceQuote($_POST);
		
		if($arrData['groups_id'] != 0){
			$sqlsms = "SELECT tel FROM " . $users->getTbl() . " WHERE user_groups_id = '" . $arrData['groups_id'] . "'";
			$querysms = $db->Query($sqlsms);
			while($rowsms = $db->FetchArray($querysms)){
				$functions->sentSMS($arrData['news'],$rowsms['tel']);
				//echo $rowsms['tel'];
				//$tel[] = $rowsms['tel'];
			}
			//echo $tels = implode(",",$tel);
			//$functions->sentSMS($arrData['news'],$tels);
		}
		//exit();

		// Get all the Form Data

		$news_sms->SetValues($arrData);

		if($news_sms->GetPrimary() == ''){

			$news_sms->SetValue('created_at', DATE_TIME);

			$news_sms->SetValue('sent_at', DATE_TIME);

		}else{

			$news_sms->SetValue('sent_at', DATE_TIME);

		}

 

		$news_sms->Save();

		if($news_sms->Save()){			

			SetAlert('เพิ่ม แก้ไข ข้อมูลสำเร็จ','success');

			//Redirect if needed

			if ($redirect){

				header('location:' . ADDRESS_ADMIN_CONTROL . 'news_sms');

				die();

			}else{

				header('location:' . ADDRESS_ADMIN_CONTROL . 'news_sms&action=edit&id=' . $news_sms->GetPrimary());

				die();

			}

		}else{

			SetAlert('ไม่สามารถเพิ่ม แก้ไข ข้อมูลได้ กรุณาลองใหม่อีกครั้ง');

		}		

	}

	

	// If Deleting the Page

	if ($_GET['id'] != '' && $_GET['action'] == 'del'){

		// Get all the form data

		$arrDel = array('id' => $_GET['id']);

		$news_sms->SetValues($arrDel);

		

		// Remove the info from the DB

		if ($news_sms->Delete()){

			// Set alert and redirect

			SetAlert('Delete Data Success','success');

			header('location:' . ADDRESS_ADMIN_CONTROL . 'news_sms');

			die();

		}else{

			SetAlert('ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง');

		}

	}

	

	if ($_GET['id'] != '' && $_GET['action'] == 'edit'){

		// For Update

		$news_sms->SetPrimary((int)$_GET['id']);

		// Try to get the information

		if (!$news_sms->GetInfo()){

			SetAlert('ไม่สามารถค้นหาข้อมูลได้ กรุณาลองใหม่อีกครั้ง');

			$news_sms->ResetValues();

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

                    <i class="icol-<?php echo ($news_sms->GetPrimary() != '') ? 'application-edit' : 'add'?>"></i> <?php echo ($news_sms->GetPrimary() != '') ? 'แก้ไข' : 'เพิ่ม'?> ข่าวสาร

                </span>

            </div>

            <div class="da-panel-content da-form-container">

                <form id="validate" enctype="multipart/form-data" action="<?php echo ADDRESS_ADMIN_CONTROL?>news_sms<?php echo ($news_sms->GetPrimary() != '') ? '&id=' . $news_sms->GetPrimary() : ''; ?>" method="post" class="da-form">

                	<?php if($news_sms->GetPrimary() != ''):?>

                    	<input type="hidden" name="id" value="<?php echo $news_sms->GetPrimary()?>" />

                  		<input type="hidden" name="created_at" value="<?php echo $news_sms->GetValue('created_at')?>" />

               		<?php endif;?>

                    <div class="da-form-inline">

                        <div class="da-form-row">

                            <label class="da-form-label">ข้อความ SMS <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <textarea name="news" id="news" class="span12 required"><?php echo ($news_sms->GetPrimary() != '') ? $news_sms->GetValue('news') : ''; ?></textarea>

                            </div>

                        </div>

                        <div class="da-form-row">

                            <label class="da-form-label">กลุ่มลูกค้า <span class="required">*</span></label>

                            <div class="da-form-item large">

                                <select id="groups_id" name="groups_id" class="span12 select2 required">

                                    <option value=""></option>
                                    <option value="0" <?php ($news_sms->GetValue('groups_id') == 0) ? "selected=\"selected\"" : ""?> >ทั้งหมด</option>

                                    <?php $user_groups->CreateDataList("id","user_groups","",($news_sms->GetPrimary() != "") ? $news_sms->GetValue('groups_id') : "")?> 

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="btn-row">

                        <input type="submit" name="submit_bt" value="ส่ง SMS" class="btn btn-success" />

                        <input type="submit" name="submit_bt" value="ส่ง SMS และแก้ไขต่อ" class="btn btn-primary" />

                        <a href="<?php echo ADDRESS_ADMIN_CONTROL?>news_sms" class="btn btn-danger">ยกเลิก</a>

                    </div>

                </form>

            </div>

        </div>

  	</div>

</div>

<?php }else{?> 

<div class="row-fluid">

    <div class="span12">         

        <div class="da-panel collapsible">

            <div class="da-panel-header">

                <span class="da-panel-title">

                    <i class="icol-grid"></i> ข่าวสาร ทั้งหมด

                </span>

            </div>

            <div class="da-panel-toolbar">

                <div class="btn-toolbar">

                    <div class="btn-group">

                        <a class="btn" href="<?php echo ADDRESS_ADMIN_CONTROL?>news_sms&action=add"><i class="icol-add"></i> เพิ่มข้อมูล</a>

                    </div>

                </div>

            </div> 

            <div class="da-panel-content da-table-container">

                <table id="da-ex-datatable-numberpaging" class="da-table">

                    <thead>

                        <tr>

                            <th>รหัส</th>

                            <th>ข่าวสาร</th>

                            <th>ส่งไปหา</th>
                            
                            <th>วันที่ส่งล่าสุด</th>

                            <th>ตัวเลือก</th>

                        </tr>

                    </thead>

                    <tbody>

                    	<?php

							$sql = "SELECT * FROM " . $news_sms->getTbl();

							$query = $db->Query($sql);

							while ($row = $db->FetchArray($query)){

						?>

                        <tr>

                            <td class="center"><?php echo $row['id'];?></td>

                            <td><?php echo $row['news'];?></td>

                            <td><?php echo $user_groups->getDataDesc("user_groups","id = '" . $row['groups_id'] . "'")?></td>

                            <td class="center"><?php echo $functions->ShowDateThTime($row['sent_at'])?></td>

                            <td class="center">

								<a href="<?php echo ADDRESS_ADMIN_CONTROL?>news_sms&action=edit&id=<?php echo $row['id']?>" class="btn btn-primary btn-small">แก้ไข / ดู</a>

                                <a href="#" onclick="if(confirm('คุณต้องการลบข้อมูลนี้หรือใม่?')==true){document.location.href='<?php echo ADDRESS_ADMIN_CONTROL?>news_sms&action=del&id=<?php echo $row['id']?>'}" class="btn btn-danger btn-small">ลบ</a>

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