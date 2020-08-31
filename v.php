<?php
//pre need pages
include_once __DIR__.'/config/config.php';
include_once __DIR__.'/includes/processing.php';
include_once __DIR__.'/themes/default/head.php';


if(isset($_GET["voucherapprovebylink"])) {
     $v_id=$_GET['voucherid'];
     $u_id=$_GET['uid'];
      if(empty($v_id) || empty($u_id)){
          AlertMsg("Voucher ID Required", BASE_URL."index.php?dashboard");
          //RedirectURL(BASE_URL."logout.php");
          exit();
      }
      //get voucher detail
      $v_detail=$main->getSingleRecord("vouchers", "id", $v_id);
      
    
} else {
    RedirectURL(BASE_URL."logout.php");
}


//working page
include_once __DIR__.'/themes/default/v_link_approve.php';
?>







<?php

include_once __DIR__.'/themes/default/footer.php';

?>