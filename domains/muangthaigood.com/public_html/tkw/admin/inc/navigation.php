<ul>
    <li class="<?php
    if (PAGE_CONTROLLERS == 'slides') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <i class="fa fa-picture-o fa-2x"></i>

            </span>

            Slide

        </a>

        <ul>

            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>slides">เพิ่มภาพสไลด์</a></li>
            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>home_title&action=edit&id=1">หัวข้อ</a></li>
               <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>menu">Sub Menu</a></li>
        </ul>

    </li>

     <li class="<?php
    if (PAGE_CONTROLLERS == 'about') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <i class="fa fa-group fa-2x"></i>

            </span>
            เกี่ยวกับเรา
        </a>

        <ul>

            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>about&action=edit&id=1">ABOUT US</a></li>


        </ul>

    </li>
    <li class="<?php
    if (PAGE_CONTROLLERS == 'takawa-international') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <i class="fa fa-group fa-2x"></i>

            </span>
            Takawa International
        </a>

        <ul>

            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>takawa-international&action=edit&id=1">Takawa International</a></li>


        </ul>

    </li>
     <li class="<?php
    if (PAGE_CONTROLLERS == 'takawa-design') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <i class="fa fa-group fa-2x"></i>

            </span>
            Takawa Design
        </a>

        <ul>

            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>takawa-design&action=edit&id=1">Takawa Design</a></li>


        </ul>

    </li>
       <li class="<?php
    if (PAGE_CONTROLLERS == 'takawa-management') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <i class="fa fa-group fa-2x"></i>

            </span>
            Takawa Management
        </a>

        <ul>

            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>takawa-management&action=edit&id=1">Management</a></li>


        </ul>

    </li>


   
    <li class="<?php
    if (PAGE_CONTROLLERS == 'contact') {
        echo 'active';
    }
    ?>">

        <a href="#">

            <!-- Icon Container -->

            <span class="da-nav-icon">

                <i class="fa fa-envelope fa-2x"></i>

            </span>

            CONTACT        </a>

        <ul>

            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>contact&action=edit&id=1">CONTACT</a></li>
            <li><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>contact_message">MESSAGE BOX</a></li>
            <li class="hidden"><a href="<?php echo ADDRESS_ADMIN_CONTROL ?>send_email">ส่งเมล์</a></li>

        </ul>

    </li>



</ul>