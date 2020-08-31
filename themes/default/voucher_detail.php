<!-- Begin Page Content -->
        <div class="container-fluid">

         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Voucher Detail</h1>
            <a type="button" onclick="PrintElem('.print_voucher')" class="btn btn-primary text-white" ><i class="fa fa-print"></i> Print</a>
            
                    <?php
                      if((isManager() || isSuperAdmin()) && $voucher_detail['status']=="Pending"):
                      ?>
                      <a href="<?php BASE_URL?>index.php?voucherapprove&voucherId=<?php echo $voucher_detail['id'];?>" class="btn btn-danger"><i class="fa fa-check"></i> Approve</a>
                      <a href="<?php BASE_URL?>index.php?voucherdecline&voucherId=<?php echo $voucher_detail['id'];?>" class="btn btn-info"><i class="fa fa-times"></i> Decline</a>
                    <?php
                      endif;
                      ?>
          </div>
          <!-- DataTales coupon -->
          <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive print_voucher" id="print_voucher">
                <table class="" id="" width="100%" cellspacing="0">
                  <tr>
                  <td colspan="1"><img src="<?php echo BASE_URL ?>uploads/<?php echo $view->app_config("APP_VOUCHER_HEADER_BANNER");?>" width="180px"  height="180px" alt="banner" style="margin-right:5%;"></td>
                  <td colspan="4" style="text-align:center;">
                      <h3 style=""><?php echo $view->app_config("APP_NAME");?></h3><br>
                      <p style="font-size:10px"><?php echo $view->app_config("APP_COMPANY_ADDRESS");?></p><br>
                   
                   </td>    
                  
                    <td width="" colspan="3" style="text-align:left;margin-left:2%;font-size:12px;">
                            
                            <b>Voucher Type:</b> <?php echo $voucher_detail['type']." voucher";?><br>
                            <b>TRN:</b> <?php echo $view->app_config("APP_TRN");?><br>
                            <b>Date:</b> <?php echo db_date_output($voucher_detail['v_date']);?><br>
                            <b>Voucher No:</b> <?php echo $voucher_detail['id'];?><br>
                            <b>Ref No:</b> <?php echo $voucher_detail['ref_num'];?><br>
                            <b>Method of Payment :</b> <?php echo $voucher_detail['payment_method'];?><br>
                            <b style="color:green;">Status : <?php echo $voucher_detail['status'];?></b><br>
                        </td>
                    </tr>
                   <tr style="border: 2px solid #000;text-align:center;font-size:12px;">
                        <td colspan="2" style=""><b>Party:</b><br> <?php echo $get_voucher_party['name'];?></td>
                        <td colspan="2" style=""><b>Party Name:</b><br> (<?php echo $get_voucher_party_name['id'].") -".$get_voucher_party_name['party_name'];?></td>
                        <td colspan="2" style=""><b>Building:</b><br> <?php echo  $building['name'];?></td>
                        <td colspan="2" style=""><b>Apartment:</b><br> <?php echo $apartment['name'];?></td>
                    </tr>
                  <tr>
                     <td colspan="6"> <br></td>
                 </tr>
<!--                  <tr> 
                      <td colspan="6"> <center><h3 class="text-uppercase"> Amount Detail </h3></center></td>
                  </tr>-->
                  
                 <tr  style="border: 1px solid #000;margin-top:5%;background-color:#bcbaba;text-align:center; font-size:12px; ">
                      <td colspan=""><b>Sr No</b></td>
                      <td colspan=""><b>On Account of</b></td>
                      <td colspan="2"><b>Description</b></td>
                      <td colspan=""><b>Amount <span style="font-size:10px">(<?php echo $view->app_config("APP_CURRENCY_SYMBOL");?>)</span></b></td>
                      <td colspan=""><b>VAT @<?php echo $view->app_config("APP_VAT_PERCENT");?>% Amount <span style="font-size:10px">(<?php echo $view->app_config("APP_CURRENCY_SYMBOL");?>)</span></b></td>
                      <td colspan="2"><b>Total <span style="font-size:10px">(<?php echo $view->app_config("APP_CURRENCY_SYMBOL");?>)</span></b></td>
                 </tr>
                 
                 
                 
                 <?php
                 if($voucher_amount_detail!="NO_DATA"):
                     $vat_total=0;
                     $i=1;
                     foreach($voucher_amount_detail as $row):
                         //get amount type
                         $amount_type=$main->getSingleRecord("amount_type","id",$row['amount_type_id']);
                         $vat_total+=$row['vat_amount'];
                    ?> 
                  
                 <tr style="border-left:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;text-align:center;font-size:12px; ">
                     <td colspan=""><?php echo $i;?></td>
                      <td colspan=""><?php echo $amount_type['name'];?></td>
                      <td colspan="2"><?php echo $row['note'];?></td>
                      <td colspan="" ><?php echo number_format($row['amount'],2);?></td>
                      <td colspan="" ><?php echo number_format($row['vat_amount'],2);?></td>
                      <td colspan="2" ><?php echo number_format($row['vat_amount']+$row['amount'],2) ;?></td>
                 </tr>
                 
                             <?php
                             $i++;
                    endforeach;
                  endif;
                 ?>
                 
                     
                 <tr>
                     <td colspan="8" style="text-align:right; margin-right:100px;font-size:12px;">
                      <br>
                     <b>Sub Total:<span style="font-size:10px">(<?php echo $view->app_config("APP_CURRENCY_SYMBOL");?>)</span>&nbsp; &nbsp;  <?php echo number_format($voucher_detail['sub_total'],2); ; ?> <br></b>
                     <b>VAT @<?php echo $view->app_config("APP_VAT_PERCENT");?>% Summary Total:<span style="font-size:10px">(<?php echo $view->app_config("APP_CURRENCY_SYMBOL");?>)</span>&nbsp; &nbsp;  <?php echo number_format($vat_total,2); ?> <br></b>
                     <b>Total Amount:<span style="font-size:10px">(<?php echo $view->app_config("APP_CURRENCY_SYMBOL");?>)</span>&nbsp; &nbsp;  <?php echo number_format($voucher_detail['sub_total']+$vat_total,2); ?> <br></b>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="8"> <hr/></td>
                 </tr>
                 
                 <?php
                 if($voucher_cheque_detail!="NO_DATA"):
                 ?>
                 <tr> 
                     <td colspan="6"> <b class="" style="font-size:10px;"> Cheque Details: </b></td>
                  </tr>
                  
                 <tr  style="border: 1px solid #000;margin-top:5%;background-color:#bcbaba;text-align:center;font-size:10px; ">
                      <td colspan=""><b>Sr No</b></td>
                      <td colspan="2"><b>Cheque No</b></td>
                      <td colspan=""><b>Due Date</b></td>
                      <td colspan=""><b>Amount</b></td>
                      <td colspan="2"><b>Bank</b></td>
                      
                 </tr>
                 <?php
                 if($voucher_cheque_detail!="NO_DATA"):
                     $i=1;
                     foreach($voucher_cheque_detail as $row):
                    ?> 
                  
                 <tr style="border-left:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;text-align:center;font-size:12px;">
                     <td colspan=""><?php echo $i;?></td>
                      <td colspan="2"><?php echo $row['cheque_no'];?></td>
                      <td colspan=""><?php echo db_date_output($row['due_date']);?></td>
                      <td colspan="" ><?php echo number_format($row['amount'],2) ;?></td>
                      <td colspan="2"><?php echo $row['bank'];?></td>
                 </tr>
                
                             <?php
                             $i++;
                    endforeach;
                  endif;
                 ?>
                <tr>
                     <td colspan="8"> <hr/></td>
                 </tr>
                <tr style="font-size:12px;">
                     <td colspan="8" style="border: 2px solid #000;"> <b>Note:</b> <?php echo $voucher_detail['note'];?></td>
                 </tr
                 <?php
                 endif;
                 ?>
                <!--End cheque detail--> 
                
                <tr class="text-center" style="font-size:12px;">
                     <td colspan="2"><br><br><br>__________________<br><b>Created By: <br><?php echo $get_voucher_create_by['admin_id']."-".$get_voucher_create_by['full_name'];?> </b></br></td>
                     <td colspan="1"></td>
                     <td colspan="2"><br><br><br>__________________<br><b>Approved By: <br><?php if($voucher_detail['verified_by']!=null){echo $get_voucher_verified_by['admin_id']."-".$get_voucher_verified_by['full_name'];}else{ echo "Status still pending";} ?> </b></br></td>
                     
                     <td colspan="2"><br><br><br>__________________<br><b>Received By:</b></br></br></td>
                </tr>
                <tr>
                     <td colspan="8"> <hr/></td>
                </tr>
                <tr class="text-center" style="font-size:10px;">
                    <td colspan="2" >Create Date <br><?php echo db_date_time_output($voucher_detail['create_on']);?> </br></td>
                    <td colspan=""></td>
                    <td colspan="2">Update Date <br><?php echo db_date_time_output($voucher_detail['update_on']);?> </br></td>
                   
                    <td colspan="2">Print Date <br><?php echo date('d-m-Y');?> </br></td>
                </tr>
                
               </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        