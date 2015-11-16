<?php
if ($_GET['id'] == '') {
    ?>
    <div id="contant">
        <h1 style="margin-bottom: 15px;">COURES  Chang Cooking & Restaurant</h1>

        <?php
        $sql2 = "SELECT * FROM " . $coures->getTbl() . " WHERE status='ใช้งาน' ORDER BY sort";
        $query2 = $db->Query($sql2);

        $cnt = 1;
        $cntChangBox = 0;
        while ($row2 = $db->FetchArray($query2)) {

            $pickup_Start = new DateTime($row2['pickup_time_start']);
            $pickup_End = new DateTime($row2['pickup_time_end']);

            $time_start = new DateTime($row2['time_start']);
            $time_End = new DateTime($row2['time_end']);

            if ($row2['cover_img'] == '') {
                $imgCover = 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_fV5SFcSSGvr76IAV2bMBgLvyR4P1PqMcG-3Pd0nSCuAsx3k2ZXtnH1k';
            } else {
                $imgCover = ADDRESS_COVER . $row2['cover_img'];
            }

            if ($cntChangBox == 0) {
                echo "<div class='boxcoures'><ul>";
            }
            ?> 
            <form action='<?= ADDRESS ?>course-confirm.html' method='POST'>

                <input type="hidden" name="course_id" value="<?= $row2['id'] ?>">
                <input type="hidden" name="payments" value="full">
                <input type="hidden" name="people" value="1">
                <input type="hidden" name="Reservations" value="<?= date('Y-m-d', strtotime(date('Y-m-d') . "+1 days")) ?>">

                <li>
                    <div class="boxcouresleft"><img src="<?= $imgCover ?>" style="max-width: 200px;"/></div>
                    <div class="boxcouresright">
                        <h2><?= $cnt++ . '. ' . $row2['coures_title'] ?></h2>
                        <p>Pick-up time: <?= $pickup_Start->format('H:i') . '-' . $pickup_End->format('H:i') ?></p>
                        <p>Time: <?= $time_start->format('H:i') . '-' . $time_End->format('H:i') ?></p>
                        <p style="word-wrap: break-word;">Detail: <?= $row2['short_coures'] ?></p>
                        <h3>Price : <?= $row2['price'] ?> Baht/Person</h3>
                        <button style="cursor: pointer;" type="submit" class="button_example" name="btn_st" value="btn_st">BOOK</button>
                    </div>
                </li>
            </form>
            <?php
            if ($cntChangBox == 1) {
                echo "</ul></div> <div class='clear'></div>";
                $cntChangBox = 0;
            } else {
                $cntChangBox++;
            }
            ?>      

        <?php } ?>
        <div class='clear'></div>
        <div style="color: #009900;">
            <p style="color:#FF6600; font-size:24px;"><strong>Term and condition of booking</strong></p>
            <p style="font-size:18px;">1. “Full” means paying at a full price of the course.</p>
            <p style="font-size:18px;">2. “Half” means paying at a half price of the course, or paying a deposit 50% of the course.</p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:18px;">2.1 Pay the rest of the course by “CASH ONLY” when arriving at the school.</span>
            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:18px;">2.2 Cash payment must be made prior to the booked class starts. </span>
            <p style="font-size:18px;">3. Bring the Receipt Number with you (from your email) and show to staff when checking in. </p>
            <p style="font-size:18px;">4. Booking cancellation or postpone must be made 7 days prior to the booking date starts. Otherwise, there will not be any refund.</p>

        </div>
    </div>

    </div>



<?php } ?>


<style>
    .boxcoures li{
        margin-bottom:15px;
    }
    a{
        text-decoration: none;
        color: black;
    }
</style>
