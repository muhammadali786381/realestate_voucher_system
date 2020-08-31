<!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Vouchers Summery</h1>
            <a type="button" onclick="PrintElem('.print_summery')" class="btn btn-primary text-white" ><i class="fa fa-print"></i> Print</a>
           </div>
            
           <!-- DataTales coupon -->
          <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive print_summery" id="print_summery" >
                <div style="border:1px solid #000; ">
              <table class="" id="" width="100%" cellspacing="0">
                  <tr>
                  <td colspan="2"><img src="<?php echo BASE_URL ?>uploads/<?php echo $view->app_config("APP_VOUCHER_HEADER_BANNER");?>" width="80px"  height="80px" alt="banner" style="margin-right:5%;"></td>
                  <td colspan="8" style="text-align:center;">
                      <h3 style=""><?php echo $view->app_config("APP_NAME");?></h3><br>
                      <p style="font-size:10px"><?php echo $view->app_config("APP_COMPANY_ADDRESS");?></p>
                   </td>    
                  </tr>
                 <tr>
                     <td colspan="10" style="border-bottom: 1px solid black;"></td>
                 </tr>
                 <tr style="text-align:center; background-color:#bcbaba;">
                     <td colspan="2"></td>
                     <td colspan="8"> <h4 >Funds Inflow and Outlflow Statement</h4></td>
                 </tr>
                 <tr style="border: 1px solid #000;text-align:center; font-size:12px;">
                     <td colspan="2">Account Type: <?php echo $_GET['method'];?> </td>
                     <td colspan="2">Voucher Account: <?php echo $_GET['v_account'];?> </td>
                     <td colspan="2">Report Type: <?php echo $_GET['summery_type'];?> </td>
                     <td colspan="2">From: <?php echo db_date_output($_GET['from_date']);?></td>
                     <td colspan="2">To: <?php echo db_date_output($_GET['to_date']);?> </td>
                 </tr>
                <td colspan="10"><br></td>
                
                <tr style="border: 1px solid #000;background-color:#bcbaba;text-align:center; font-size:12px;">
                     <td colspan="" width="5%">Date</td>
                     <td colspan="">Tran. Type</td>
                      <td colspan="">Voucher ID</td>
                     <td colspan="">Party Type</td>
                     <td colspan="">Party Name</td>
                     <td colspan="">Building</td>
                     <td colspan="">Appartment</td>
                     <td colspan="">Receipts</td>
                     <td colspan="">Payments</td>
                     <td colspan="">Balance</td>
                 </tr>
                 
                  <tr style="border: 1px solid #000;text-align:center;color:green;font-size:14px;">
                     <td colspan="" width="5%"></td>
                     <td colspan="">Opening Balance</td>
                      <td colspan=""></td>
                     <td colspan=""></td>
                     <td colspan=""></td>
                     <td colspan=""></td>
                     <td colspan=""></td>
                     <td colspan=""></td>
                     <td colspan=""></td>
                     <td colspan=""><?php echo $balance;?></td>
                 </tr>
                <?php
                if($voucher_summery!="NO_DATA"):
                    $total_amount=0;
                    $vat_amount=0;
                    foreach ($voucher_summery as $row):
                        if(($row['status']=="Pending" || $row['status']=="Verified By Manager") && ($row['payment_method']==$_GET['method'])):
                            
                        
                    //get party
                    $party=$main->getSingleRecord("party_list","id",$row['party_list_id']);
                    //get party name
                    $party_name=$main->getSingleRecord("party_name","id",$row['party_name_id']);
                    //apartment
                    $apartment=$main->getSingleRecord("appartment_list","id",$row['apartment_id']);
                    //get building
                    $building=$main->getSingleRecord("building_list","id",$apartment['building_id']);
                    //vat total
                    $amount=$main->getAllConditionRecords("voucher_amount_detail","voucher_id",$row['id'],"id");
                    $total_amount=0;
                    $vat_amount=0;
                        foreach ($amount as $amt){
                        $total_amount+=$amt['amount'];
                        $vat_amount+=$amt['vat_amount'];
                      }
                   if($row['type']=="Receipt"){
                       $balance+=$total_amount+$vat_amount;
                   } else {
                       $balance-=$total_amount+$vat_amount;
                   }   
                  
                   ?>
                 <tr style="border: 1px solid #000;text-align:center; font-size:12px;">
                     <td colspan="" ><?php echo db_date_output($row['v_date']);?></td>
                     <td colspan=""><?php echo $row['type'];?></td>
                     <td colspan=""><?php echo $row['id'];?></td>
                     <td colspan=""><?php echo $party['name'];?></td>
                     <td colspan=""><?php echo $party_name['party_name'];?></td>
                     <td colspan=""><?php echo $building['name'];?></td>
                     <td colspan=""><?php echo $apartment['name'];?></td>
                     <td colspan=""><?php echo  ($row['type']=="Receipt")?number_format($total_amount+$vat_amount,2):"-";?></td>
                     <td colspan=""><?php echo ($row['type']=="Payment")?number_format($total_amount+$vat_amount,2):"-";?></td>
                     <td colspan=""><?php echo number_format($balance,2);  ?></td>
                 </tr>
                
                 <?php if($_GET['summery_type']=="DetailSummery"){
                 ?>
                 
                 <tr style="text-align:center; font-size:12px;">
                     <td colspan="3"></td>
                     <td colspan="" style="border:1px solid black; text-align:center;background-color:#bcbaba;">Sr No</td>
                     <td colspan="" style="border:1px solid black; text-align:center;background-color:#bcbaba;">On Account</td>
                     <td colspan="" style="border:1px solid black; text-align:center;background-color:#bcbaba;">Amount</td>
                     <td colspan=""style="border:1px solid black; text-align:center;background-color:#bcbaba;">VAT</td>
                     <td colspan="3"></td>
                 </tr>
                 <?php
                    $i=1;
                    foreach ($amount as $a):
                   if($a['voucher_id']==$row['id']):
                       //on account type
                       $on_account=$main->getSingleRecord("amount_type","id",$a['amount_type_id']);
                  ?>
                    <tr style="text-align:center; font-size:12px;">
                      <td colspan="3"></td>
                     <td colspan="" style="border:1px solid black; text-align:center;"><?php echo $i;?></td>
                     <td colspan="" style="border:1px solid black; text-align:center;"><?php echo $on_account['name'];?></td>
                     <td colspan="" style="border:1px solid black; text-align:center;"><?php echo number_format($a['amount'],2); ?></td>
                     <td colspan=""style="border:1px solid black; text-align:center;"><?php echo number_format($a['vat_amount'],2);?></td>
                     <td colspan="3"></td>
                    </tr>
                    
                  <?php  
                        //inner table
                            $i++;
                            endif;
                    endforeach;
                    
                      echo "<tr><td colspan='10'><br></td></tr>";  
                      echo "<tr><td colspan='10'><br></td></tr>";  
                   //inner table
                 }  
                 
                 
                        endif; 
                    endforeach;
                 endif;
                ?>
            </table>
                        
                 </div> 
              </div>
            </div>
          </div>
            
      </div>
        <!-- /.container-fluid -->
        