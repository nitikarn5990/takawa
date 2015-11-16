<?php
@session_start();
if ($_POST ["submit_bt"] == 'Send') {
    $chk = 0;
    $cpt = $_POST['capt'];
    if ($cpt != $_SESSION['CAPTCHA']) {
        ?>
        <script>
            $(document).ready(function () {
                alert('Error code');
            });
        </script>
    <?php
    } else {

        $chk = 1;
        $arrData = array();

        $arrData = $functions->replaceQuote($_POST);

        $contact_message->SetValues($arrData);

        if ($contact_message->GetPrimary() == '') {

            $contact_message->SetValue('created_at', DATE_TIME);

            $contact_message->SetValue('updated_at', DATE_TIME);
        } else {

            $contact_message->SetValue('updated_at', DATE_TIME);
        }

        $contact_message->SetValue('status', 'no read');

        // $contact_message->Save();

        if ($contact_message->Save()) {

            echo "<script> $(document).ready(function () { alert('Send Success');    });</script>";
        } else {
            echo "<script>$(document).ready(function () { alert('Error');   });</script>";
        }
    }
}
?>
<div id="contant">
    <h1><?= $contact->getDataDesc('contact_title', 'id = 1') ?></h1>
<?= $contact->getDataDesc('contact_detail', 'id = 1') ?>
</div>
<div id="contant">
    <form action="<?php echo ADDRESS ?>contact.html" method="post" class="form-send-msg">

        <p> Name<br />
            <span>
                <input type="text" name="txt_name" value="<?= $chk == 0 ? $_POST['txt_name'] : '' ?>"

                       class="input" required="required" />
            </span> </p>
        <p> Email.<br />
            <span>
                <input type="email" name="txt_email" class="input" value="<?= $chk == 0 ? $_POST['txt_email'] : '' ?>"

                       required="required" />
            </span> </p>
        <p> Tel<br />
            <span>
                <input type="text" name="txt_tel" value="<?= $chk == 0 ? $_POST['txt_tel'] : '' ?>"

                       class="input" required="required" />
            </span> </p>
        <p> Subject<br />
            <span>
                <input type="text" name="txt_subject" value="<?= $chk == 0 ? $_POST['txt_subject'] : '' ?>" 

                       class="input" required="required" />
            </span> </p>
        <p> Message<br />
            <span>
                <textarea name="txt_message" class="area" 
                          required="required" rows="7" cols="50"><?= $chk == 0 ? $_POST['txt_message'] : '' ?></textarea>
            </span> </p>
        <p>
            Enter Code
            <input type="text" name="capt" id="capt" required=""/> <img src="image_capt.php" id="mycapt"  align="absmiddle" />

            <img id="changeCpt" src="https://www.e-cnhsp.sp.gov.br/GFR/imagens/refresh.png" style="vertical-align: middle;cursor: pointer;">
        </p>
        <p>
            <input id="submit_bt" name="submit_bt" type="submit" value="Send"

                   style="width: 80px; height: 30px;" />
            <input name="reset"

                   type="reset" value="Reset" style="width: 80px; height: 30px;" />
        </p>
    </form>
</div>

<div id="contant">
   <?= $contact->getDataDesc('google_map', 'id = 1') ?>

</div>
<style>
    .form-send-msg p{
        margin-bottom: 10px;
    }
    #contant input{
        height: 20px;
        width: 300px;
    }
    #capt{
        width: 100px;
    }
</style>

<script type="text/javascript">



    $('#changeCpt').click(function (e) {
        var v = Math.random();
        $('#mycapt').attr('src', 'image_capt.php?v=' + v);
    });

</script>